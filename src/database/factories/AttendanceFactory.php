<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'clock_in' => '09:00:00',
            'clock_out' => '18:00:00',
            'status' => '勤務中',
            'note' => null,
        ];
    }
}