<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'clock_in',
        'clock_out',
        'note',
        'status',
    ];

    protected $casts = [
        'date'      => 'date',
        'clock_in'  => 'datetime',
        'clock_out' => 'datetime',
    ];

    /* =========================
     | リレーション
     ========================= */

    // 休憩
    public function breaks()
    {
        return $this->hasMany(AttendanceBreak::class);
    }

    // 修正申請
    public function corrections()
    {
        return $this->hasMany(AttendanceCorrection::class);
    }

    // ユーザー
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* =========================
     | アクセサ
     ========================= */

    /**
     * 合計勤務時間（休憩時間を除外）
     * 表示形式：HH:MM
     */
    public function getTotalWorkHoursAttribute()
    {
        // 出勤・退勤が揃っていない場合
        if (!$this->clock_in || !$this->clock_out) {
            return null;
        }

        // 勤務時間（分）
        $workMinutes = $this->clock_in->diffInMinutes($this->clock_out);

        // 休憩時間合計（分）
        $breakMinutes = $this->breaks->sum(function ($break) {
            if ($break->break_start && $break->break_end) {
                return $break->break_start->diffInMinutes($break->break_end);
            }
            return 0;
        });

        $totalMinutes = $workMinutes - $breakMinutes;

        if ($totalMinutes <= 0) {
            return null;
        }

        $hours   = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        return sprintf('%02d:%02d', $hours, $minutes);
    }
}
