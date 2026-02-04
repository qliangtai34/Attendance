<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceBreakFactory extends Factory
{
    public function definition(): array
    {
        return [
            'break_start' => now()->setTime(12, 0),
            'break_end' => now()->setTime(13, 0),
        ];
    }
}