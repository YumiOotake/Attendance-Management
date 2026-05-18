<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'clock_in',
        'clock_out',
        'type',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function breakTimes()
    {
        return $this->hasMany(BreakTime::class);
    }

    public function attendanceRequests()
    {
        return $this->hasMany(AttendanceRequest::class);
    }

    public function getTypeLabelAttribute(): string
    {
        return match ($this->type) {
            1 => '出勤',
            2 => '有給',
            3 => '欠勤',
            4 => '遅刻',
            5 => '早退',
            6 => '休日出勤',
            default => '出勤',
        };
    }

    public function getStatusAttribute(): string
    {
        if ($this->clock_out) return 'done';
        if ($this->breakTimes->whereNull('break_end')->count() > 0) return 'break';
        if ($this->clock_in) return 'working';
        return 'none';
    }

    public function clock_in_formatted()
    {
        return substr($this->clock_in, 0, 5);
    }

    public function clock_out_formatted()
    {
        return substr($this->clock_out, 0, 5);
    }

}
