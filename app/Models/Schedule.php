<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    protected $primaryKey = "schedule_id";
    protected $guarded = [];


    public function classType()
    {
        return $this->belongsTo('App\Models\ClassType','class_type');
    }

    public function stdClass()
    {
        return $this->belongsTo('App\Models\StudentClass','class_id');
    }

    //
    public function getThaiDay(){
        $day_map=['จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์','อาทิตย์','WBA'];
        //$day_map=[1=>'จ้นทร์',2=>'อังคาร',3=>'พุธ',4=>'พฤหัสบดี',5=>'ศุกร์',6=>'เสาร์',7=>'อาทิตย์'];
        $en_day = ["MON","TUE","WED","THU","FRI","SAT","SUN","WBA"];


        $day_id = array_search(strtoupper($this->class_day),$en_day);

        return $day_map[$day_id];

    }

    public function getDateIndex(){
        $en_day = ["MON","TUE","WED","THU","FRI","SAT","SUN","WBA"];

        $day_id = array_search(strtoupper($this->class_day),$en_day);

        return $day_id+1;
    }


}
