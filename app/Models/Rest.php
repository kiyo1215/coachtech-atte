<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Attendance;

class Rest extends Model
{
    use HasFactory;
     protected $fillable = [
        'user_id',
        'attendance_id',
        'start_time',
        'end_time',
        'all_time'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}