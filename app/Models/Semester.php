<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'semesters';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'semester_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */

    //dean_position_name

    protected $fillable = ['year', 'semester', 'manager_teacher_id', 'user_id','dean_position_name'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','created_user_id');
    }

    public function managerTeacher()
    {
        return $this->belongsTo('App\Models\Teacher','manager_teacher_id','teacher_id');
    }

    public function getSemesterLabel(){
        if($this->semester==1){
            return "ภาคต้น";
        }elseif ($this->semester==2){
            return "ภาคปลาย";
        }elseif ($this->semester==3){
            return "ภาคฤดูร้อน";
        }
    }





}
