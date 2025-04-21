<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::query()->create(['name' => 'Basic', 'slug' => 'basic', 'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'price' => 100, 'billing_cycle' => 'monthly', 'is_active' => true]);
        Plan::query()->create(['name' => 'Pro', 'slug' => 'pro', 'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'price' => 300, 'billing_cycle' => 'yearly', 'is_active' => true]);
        Plan::query()->create(['name' => 'Premium', 'slug' => 'premium', 'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'price' => 600, 'billing_cycle' => 'unlimited', 'is_active' => true]);
    }
}
