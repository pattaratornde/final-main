<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = "attendances";
    protected $primaryKey = "attend_id";
    protected $fillable = [
        'attend_id',
        'attend_data',
        'status',
        'created_at',
        'updated_at',
        'user_id',
        'course_id',
        'ta_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function teaching()
    {
        return $this->belongsTo('App\Models\Teaching','teaching_id');
    }
    public function class()
    {
        return $this->belongsTo('App\Models\StudentClass','class_id');
    }
    public function course()
    {
        return $this->belongsTo('App\Models\Course','course_id');
    }
    public function semester()
    {
        return $this->belongsTo('App\Models\Semester','semester_id');
    }
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher','teacher_id');
    }
}
