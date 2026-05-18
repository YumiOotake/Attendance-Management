<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'break_start',
        'break_end',
    ];

    protected $casts = [
        'attendance_id' => 'integer',
    ];

    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }

    public function break_start_formatted()
    {
        if (!empty($this->break_start)) {
            return substr($this->break_start, 0, 5);
        } else {
            return collect();
        }

    }

    public function break_end_formatted()
    {
        if (!empty($this->break_end)) {
            return substr($this->break_end, 0, 5);
        } else {
            return collect();
        }

    }
}
