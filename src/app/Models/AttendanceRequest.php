<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'user_id',
        'requested_clock_in',
        'requested_clock_out',
        'requested_break_start',
        'requested_break_end',
        'requested_type',
        'reason',
        'status',
    ];

    protected $casts = [
        'attendance_id' => 'integer',
        'user_id' => 'integer',
        'requested_type' => 'integer',
        'status' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }

    public function getRequestedTypeLabelAttribute(): string
    {
        return match ($this->requested_type) {
            1 => '出勤',
            2 => '有給',
            3 => '欠勤',
            4 => '遅刻',
            5 => '早退',
            6 => '休日出勤',
            default => '出勤',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            1 => '承認待ち',
            2 => '承認済み',
            3 => '却下ずみ',
            default => '承認待ち',
        };
    }

    public function clock_in_formatted()
    {
        return substr($this->requested_clock_in, 0, 5);
    }

    public function clock_out_formatted()
    {
        return substr($this->requested_clock_out, 0, 5);
    }

    public function break_start_formatted()
    {
        return substr($this->requested_break_start, 0, 5);
    }

    public function break_end_formatted()
    {
        return substr($this->requested_break_end, 0, 5);
    }
}
