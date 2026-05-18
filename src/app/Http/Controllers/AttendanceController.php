<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceRequest;
use App\Models\BreakTime;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PhpParser\Node\Stmt\Break_;

class AttendanceController extends Controller
{
    public function index()
    {

        //getだと複数になるかも→firstでとる
        $attendance = Attendance::where('user_id', auth()->id())
            ->whereDate('date', Carbon::today())
            ->first();

        if ($attendance === null) {
            $attendance = Attendance::create([
                'user_id' => auth()->id(),
                'date' => Carbon::today(),
                'clock_in' => null,
                'clock_out' => null,
                'type' => 1,
            ]);
        }

        return view('attendances.index', compact('attendance'));
    }

    public function clockIn(Attendance $attendance)
    {
        $this->authorize('restore', $attendance);

        $now = Carbon::now();

        $attendance->update([
            'clock_in' => $now->toTimeString(),
        ]);

        return redirect()->route('attendance.index');
    }

    public function clockOut(Attendance $attendance)
    {
        $this->authorize('restore', $attendance);

        $now = Carbon::now();

        $attendance->update([
            'clock_out' => $now->toTimeString(),
        ]);

        return redirect()->route('attendance.index');
    }

    public function breakStart(Attendance $attendance)
    {
        $this->authorize('restore', $attendance);

        $breakTime = BreakTime::create([
            'attendance_id' => $attendance->id,
            'break_start' => null,
            'break_end' => null,
        ]);

        $now = Carbon::now();

        $breakTime->update([
            'break_start' => $now->toTimeString(),
        ]);

        return redirect()->route('attendance.index');
    }

    public function breakEnd(Attendance $attendance)
    {
        $this->authorize('restore', $attendance);

        $breakTime = BreakTime::where('attendance_id', $attendance->id)
            ->latest()->first();

        $now = Carbon::now();

        $breakTime->update([
            'break_end' => $now->toTimeString(),
        ]);

        return redirect()->route('attendance.index');
    }

    public function detail(Request $request)
    {
        $start = Carbon::now()->startOfYear(); //その年の初日が始まった瞬間が取得できる
        $end = Carbon::now();
        $period = CarbonPeriod::create($start->format('Y-m'), $end->format('Y-m'), '1 month');

        $months = [];
        foreach ($period as $dt) {
            $months[] = $dt->format('m');
        }

        $attendances = Attendance::where('user_id', auth()->id())
            ->with('breakTimes')
            ->when(!empty($request->month), function ($query) use ($request) {
                $query->whereMonth('date', $request->month);
            })
            ->get();

        // if (!empty($request->month)) {
        //     $attendances = Attendance::where('user_id', auth()->id())
        //         ->whereMonth('date', $request->month);
        // }
        // $attendances = $attendances->get(); ↑に省略


        return view('attendances.detail', compact('months', 'attendances'));
    }

    public function requestForm(Attendance $attendance)
    {
        $breakTime = $attendance->breakTimes()->latest()->first();

        return view('attendances.request', compact('attendance', 'breakTime'));
    }

    public function request(Request $request, Attendance $attendance)
    {//バリデーション
        $clock_in = $request->requested_clock_in ? Carbon::createFromFormat('H:i', $request->requested_clock_in) : null;
        $clock_out = $request->requested_clock_out ? Carbon::createFromFormat('H:i', $request->requested_clock_out) : null;
        $break_start = $request->requested_break_start ? Carbon::createFromFormat('H:i', $request->requested_break_start) : null;
        $break_end = $request->requested_break_end ? Carbon::createFromFormat('H:i', $request->requested_break_end) : null;

        AttendanceRequest::create([
            'attendance_id' => $attendance->id,
            'user_id' => auth()->id(),
            'requested_clock_in' => $clock_in,
            'requested_clock_out' => $clock_out,
            'requested_break_start' => $break_start,
            'requested_break_end' => $break_end,
            'requested_type' => $request->requested_type,
            'reason' => $request->requested_reason,
            'status' => 1,
        ]);

        return redirect()->route('attendance.detail')->with('success', '申請を送信しました');
    }

}
