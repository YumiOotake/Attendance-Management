<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //10:00:00 を上限としたランダムな時刻　第2引数は上限
        $clockIn = $this->faker->time('H:i:s', '10:00:00');

        return [
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'date' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'clock_in' => $clockIn,
            //80%の確率で退勤時刻あり、20%の確率でnull（打刻漏れを再現）。退勤時刻は $clockIn〜19:00:00 の間でランダム生成
            'clock_out' => $this->faker->boolean(80) ? $this->faker->dateTimeBetween($clockIn, '19:00:00')->format('H:i:s') : null,
            'type' => $this->faker->numberBetween(1, 6),
        ];
    }
}
