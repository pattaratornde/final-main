<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'classes';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'class_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
   // protected $fillable = ['section_num', 'subject_id', 'owner_teacher_id', 'created_user_id', 'ref_course_id'];
    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher','teacher_id');
    }

    public function major()
    {
        return $this->belongsTo('App\Models\Major','major_id');
    }

    public function schedules()
    {
        return $this->hasMany('App\Models\Schedule','class_id','class_id');
    }

    public function teaching(){
        return $this->hasMany('App\Models\Teaching','class_id')->orderBy('start_time');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course','course_id');
    }

    public function classes()
    {
        return $this->belongsTo('App\Models\StudentClass','class_id')->orderBy('section_num');
    }
}
