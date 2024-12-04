<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 10) as $index) {
            DB::table('employees')->insert([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
