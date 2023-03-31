<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;

class Course extends Model
{
    use HasFactory;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'courses';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'course_id';

    protected $casts = [
        'course_id' => 'string'
    ];
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    //protected $fillable = ['semester_id', 'subject_id', 'owner_teacher_id', 'created_user_id', 'ref_course_id'];
    protected $guarded =[];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher','owner_teacher_id');
    }

    public function allTeachers() //อาจารย์ทั้หมด
    {
        return $this->hasMany('App\Models\CourseTeacher','course_id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\Subject','subject_id');
    }

    public function curriculum()
    {
        return $this->belongsTo('App\Models\Curriculum','cur_id');
    }

    public function classes()
    {
        return $this->hasMany('App\Models\StudentClass','course_id')->orderBy('section_num');
    }

    public function major()
    {
        return $this->belongsTo('App\Models\Major','major_id');
    }
    
    public function semester()
    {
        return $this->belongsTo('App\Models\Semester','semester_id');
    }
    public function tas()
    {
        return $this->belongsTo('App\Models\Subject','ta_id');
    }

    





}
