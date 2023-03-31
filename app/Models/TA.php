<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\User;

class TA extends Model
{
    use HasFactory;
    protected $table = 'tas';
    protected $primaryKey = "ta_id";
    protected $fillable = ['ta_id', 'student_id', 'name', 'address', 'email', 'user_id', 'course_id'];
    protected $guarded =[];
    
    public function user()
    {
        return $this->belongsTo('App\Models\User','ta_user_id');
    }
    public function course()
    {
        return $this->belongsTo('App\Models\Course','course_id');
    }
    public function tacourses()
    {
        return $this->hasMany('App\Models\TaCourse','ta_id');
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
    
}
