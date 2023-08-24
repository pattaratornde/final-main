<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teaching extends Model
{
    //
    protected $table = "teaching";
    protected $primaryKey = "teaching_id";
    protected $guarded = [];


    public function classType()
    {
        return $this->belongsTo('App\Models\ClassType','class_type');
    }

    public function class()
    {
        return $this->belongsTo('App\Models\StudentClass','class_id');
    }

    public function extraTeaching()
    {
        return $this->hasMany('App\Models\ExtraTeaching','teaching_id')->where('opt_status','A');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher','teacher_id');
    }

    public function getDuration(){
        return intval((strtotime($this->end_time) - strtotime($this->start_time))/60);
    }
    public function attendanceTa()
    {
        return $this->hasMany('App\Models\Attendance','teaching_id');
    }
    

}
