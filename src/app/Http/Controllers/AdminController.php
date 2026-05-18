<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceRequest;
use App\Models\BreakTime;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function usersIndex()
    {
        $users = User::orderBy('id')->get();

        return view('admin.users', compact('users'));
    }

    public function userRequests(User $user)
    {
        $requests = AttendanceRequest::where('user_id', $user->id)->get();

        return response()->json($requests);
    }

    public function requestsIndex()
    {
        $attendanceRequests = AttendanceRequest::all();

        return view('admin.requests', compact('attendanceRequests'));
    }

    public function edit(AttendanceRequest $attendanceRequest)
    {
        // $attendance = Attendance::where('id', $attendanceRequest->attendance_id)->first();
        // $breakTimes = BreakTime::where('attendance_id', $attendance->id)->get();
        $attendance = $attendanceRequest->attendance;
        $breakTimes = $attendanceRequest->attendance->breakTimes;


        return view('admin.request_edit', compact('attendanceRequest', 'breakTimes'));
    }

    public function update(AttendanceRequest $attendanceRequest, Request $request)
    {
        // $attendance = Attendance::where('id', $attendanceRequest->attendance_id)->first();
        $attendance = $attendanceRequest->attendance;

        // $breakTimes = BreakTime::where('attendance_id', $attendance->id)->get();
        $breakTimes = $attendanceRequest->attendance->breakTimes;

        foreach ($request->break_start ?? [] as $id => $value) {

            if ($id == BreakTime::where('attendance_id', $attendance->id)->first()) {
                return view('admin.request_edit', compact('attendanceRequest', 'breakTimes'));
            }

            $breakTime = $attendance->breakTimes()->find($id);
            if ($breakTime) {
                $breakTime->update([
                    'break_start' => $value ?? null,
                    'break_end' => $request->break_end[$id] ?? null,
                ]);
            }
        }

        $attendance->update([
            'clock_in' => $request->clock_in ?? null,
            'clock_out' => $request->clock_out ?? null,
            'type' => $request->type,
        ]);

        $attendanceRequest->update([
            'status' => 2,
        ]);

        return redirect()->route('admin.users.index');
    }
}
