<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //
    protected $table = "teachers";
    protected $primaryKey = "teacher_id";

    protected $guarded = [];


    public function getName($position=true,$degree=true,$prefix=false){
        return ($position ? $this->position:"").($degree ? $this->degree." ":"").($prefix ? $this->prefix."":"").$this->name;
    }

    public function getFirstName(){
        $tmp = explode($this->name," ");
        if(count($tmp)==2)
            return $this->$tmp[0];
        else
            return $this->name;
    }

    public function getFullPosition(){
        if($this->position=="ผศ.")
            return "ผู้ช่วยศาสตรจารย์";
        else if($this->position=="รศ.")
            return "รองศาสตราจารย์";
        else if($this->position=="ศ.")
            return "ศาสตราจารย์";
        else
            return $this->position;

    }

    public function user(){
        return $this->belongsTo('App\Models\User','account_user_id','id');
    }

    public function courseTeachers()
    {
        return $this->hasMany('App\Models\CourseTeacher','teacher_id');
    }

    public function curriculums(){
        return $this->hasMany('App\Models\Curriculum','head_teacher_id','teacher_id');
    }
}
