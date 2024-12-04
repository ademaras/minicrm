<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['pending', 'in_progress', 'completed'];

        foreach (range(1, 20) as $index) {
            DB::table('tasks')->insert([
                'employee_id' => fake()->numberBetween(1, 10),
                'title' => fake()->sentence(3),
                'status' => $statuses[array_rand($statuses)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
