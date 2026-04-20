<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $attendance = Attendance::query()->inRandomOrder()->first();
        $requestedClockIn = $this->faker->time('H:i:s', '10:00:00');

        return [
            'attendance_id' => $attendance->id,
            'user_id' => $attendance->user_id,
            'requested_clock_in' => $requestedClockIn,
            'requested_clock_out' => $this->faker->boolean(80)
                ? $this->faker->dateTimeBetween($requestedClockIn, '19:00:00')->format('H:i:s')
                : null,
            'requested_break_start' => $this->faker->boolean(50)
                ? $this->faker->time('H:i:s', '15:00:00')
                : null,
            'requested_break_end' => null,
            'requested_type' => $this->faker->numberBetween(1, 6),
            'reason' => $this->faker->realText(),
            'status' => $this->faker->numberBetween(1, 3),
        ];
    }
}
