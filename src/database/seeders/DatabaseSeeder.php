<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\AttendanceRequest;
use App\Models\BreakTime;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'login_id' => 1,
            'name' => 'yumi',
            'email' => 'admin@example.com',
            'password' => Hash::make('qqqqqqqq'),
            'is_admin' => true,
        ]);

        $user = User::factory()->create([
            'login_id' => 2,
            'name' => 'tiko',
            'email' => 'tiko@example.com',
            'password' => Hash::make('qqqqqqqq'),
            'is_admin' => false,
        ]);

        $attendances = Attendance::factory()->count(10)->create([
            'user_id' => $user->id,
        ]);

        foreach ($attendances->random(2) as $attendance) {
            BreakTime::factory()->create([
                'attendance_id' => $attendance->id,
            ]);
        }

        foreach ($attendances->random(1) as $attendance) {
            AttendanceRequest::factory()->create([
                'attendance_id' => $attendance->id,
                'user_id' => $user->id,
            ]);
        }

        $users = User::factory()->count(5)->create();

        foreach ($users as $user) {
            $attendances = Attendance::factory()->count(10)->create([
                'user_id' => $user->id,
            ]);

            // 10件の中からランダムに2件取り出す
            foreach ($attendances->random(2) as $attendance) {
                BreakTime::factory()->create([
                    'attendance_id' => $attendance->id,
                ]);
            }

            foreach ($attendances->random(1) as $attendance) {
                AttendanceRequest::factory()->create([
                    'attendance_id' => $attendance->id,
                    'user_id' => $user->id,
                ]);
            }
        }


    }
}
