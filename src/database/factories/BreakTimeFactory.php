<?php

namespace Database\Factories;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Factories\Factory;

class BreakTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $attendanceId = Attendance::query()->inRandomOrder()->value('id');
        $breakStart = $this->faker->time('H:i:s', '15:00:00');

        return [
            'attendance_id' => $attendanceId,
            'break_start' => $breakStart,
            'break_end' => $this->faker->boolean(80)
                ? $this->faker->dateTimeBetween($breakStart, '18:00:00')->format('H:i:s')
                : null,
        ];
    }
}
