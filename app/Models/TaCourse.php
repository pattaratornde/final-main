<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaCourse extends Model
{
    protected $primaryKey = 'id';
    protected $table = "course_tas";
    protected $casts = [
        'course_id' => 'string'
    ];
    protected $guarded = [];

    public function ta()
    {
        return $this->belongsTo('App\Models\TA','ta_id');
    }
    public function student_user()
    {
        return $this->belongsTo('App\Models\User','student_user_id');
        
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
        
    }
    public function course()
    {
        return $this->belongsTo('App\Models\Course','course_id');
    }
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher','teacher_id');
    }
    public function semester()
    {
        return $this->belongsTo('App\Models\Semester','semester_id');
    }
    public function teaching()
    {
        return $this->belongsTo('App\Models\Teaching','teaching_id');
    }

    public function classattendance()
    {
        return $this->belongsTo('App\Models\ClassTypeAttendance','aact_no');
    }
}