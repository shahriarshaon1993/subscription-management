<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\View\View;

class HomeController
{
    /**
     * Handles the homepage functionality of the application.
     *
     * @return View
     */
    public function index(): View
    {
        // Fetch all plans where is_active is true
        $plans = Plan::query()
            ->where('is_active', true)
            ->get();

        return view('index', compact('plans'));
    }
}
