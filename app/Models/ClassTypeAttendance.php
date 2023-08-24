<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassTypeAttendance extends Model
{
    use HasFactory;
    protected $table = "class_type_attendances";
    protected $primaryKey = "acct_no";
    protected $fillable = [
        'acct_no',
        'acct_detail',
        'start_work',
        'duration',
        'created_at',
        'updated_at',
        'class_type_id',
        'ta_id',
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
    public function attendance()
    {
        return $this->belongsTo('App\Models\Attendance','attend_id');
    }
    public function classType()
    {
        return $this->belongsTo('App\Models\ClassType','class_type_id');
    }
    public function tacourse()
    {
        return $this->belongsTo('App\Models\TaCourse','ta_id');
    }

}