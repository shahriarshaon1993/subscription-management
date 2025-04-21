<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\Plan;
use App\Models\Role;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Stripe\Exception\SignatureVerificationException;
use Stripe\StripeClient;
use Stripe\Webhook;

class PlanController
{
    /**
     * Display the specified plan details.
     *
     * @param  Plan  $plan
     * @return View
     */
    public function show(Plan $plan): View
    {
        // Return the plan details view with the specified plan
        return view('plans.show', compact('plan'));
    }

    /**
     * Process the purchase of a plan and initiate Stripe checkout.
     *
     * @param  UserRegisterRequest  $request
     * @param  Plan  $plan
     * @return RedirectResponse
     */
    public function buyPlan(UserRegisterRequest $request, Plan $plan): RedirectResponse
    {
        // Validate incoming request data
        $attributes = $request->validated();

        // Initialize Stripe client with secret key
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));

        // Retrieve the subscriber role
        $role = Role::query()
            ->where('name', 'subscriber')
            ->first();

        // Execute database operations within a transaction
        return DB::transaction(function () use ($attributes, $plan, $role, $stripe) {
            // Create a new subscriber user
            $user = User::query()->create($attributes);

            // Attach role to user
            $user->roles()->attach($role->id);

            // Log in the newly created user
            Auth::login($user);

            // Create a Stripe checkout session
            $checkout_session = $stripe->checkout->sessions->create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $plan->name . ' - ' . $plan->billing_cycle,
                            ],
                            'unit_amount' => $plan->price * 100
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('plan.success', [], true), // true for passing absolute url
                'cancel_url' => route('plan.cancel', [], true),
            ]);

            // Create a new subscription record
            $subscription = Subscription::query()->create([
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'session_id' => $checkout_session->id,
                'status' => 'pending',
                'starts_at' => now(),
                'ends_at' => $this->setEndDate($plan->billing_cycle),
            ]);

            // Create a new transaction record
            Transaction::query()->create([
                'status' => 'pending',
                'price' => $plan->price,
                'billing_cycle' => $plan->billing_cycle,
                'session_id' => $checkout_session->id,
                'user_id' => $user->id,
                'plan_id' => $plan->id,
                'subscription_id' => $subscription->id,
            ]);

            return redirect($checkout_session->url);
        });
    }

    /**
     * Handle successful payment redirect.
     *
     * @return RedirectResponse
     */
    public function success(): RedirectResponse
    {
        return redirect()->route('home')
            ->with('success', 'You have successfully bought a new plan.');
    }

    /**
     * Handle cancelled payment redirect.
     *
     * @return RedirectResponse
     */
    public function cancel(): RedirectResponse
    {
        return redirect()->route('home')
            ->with('error', 'There was an error in payment process. Please try again.');
    }

    /**
     * Handle Stripe webhook events.
     *
     * @return ResponseFactory|Application|Response|object
     */
    public function webhook()
    {
        // Retrieve the Stripe webhook secret
        $endpoint_secret = env('STRIPE_WEBHOOK_KEY');

        // Get the raw payload and signature header
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        // Verify the webhook signature
        try {
            $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
        } catch (SignatureVerificationException $e) {
            return response('', 404);
        }

        // Handle checkout.session.completed event
        if ($event->type == 'checkout.session.completed') {
            $session = $event->data->object;

            // Retrieve the subscription by session ID
            $subscription = Subscription::query()
                ->where('session_id', $session->id)
                ->first();

            // Retrieve the transaction by session ID
            $transaction = Transaction::query()
                ->where('session_id', $session->id)
                ->first();

            // Retrieve the transaction by session ID
            if ($subscription->status === 'pending') {
                $subscription->status = 'paid';
                $subscription->save();
            }

            // Update transaction status to paid if pending
            if ($transaction->status === 'pending') {
                $transaction->status = 'paid';
                $transaction->save();
            }

            return response('', 200);
        }

        return response('Received unknown event type', 404);
    }

    /**
     * Calculate subscription end date based on billing cycle.
     *
     * @param  string  $billing_cycle
     * @return Carbon
     */
    private function setEndDate(string $billing_cycle): Carbon
    {
        // Set end date for monthly billing cycle
        if ($billing_cycle === 'monthly') {
            return now()->addMonths(1);
        }

        // Set end date for yearly billing cycle
        if ($billing_cycle === 'yearly') {
            return now()->addYears(1);
        }

        // Set end date for lifetime billing cycle (default: 10 years)
        return now()->addYears(10);
    }
}
