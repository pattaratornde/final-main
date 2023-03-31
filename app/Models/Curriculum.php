<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'curriculums';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'cur_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     * @var array
     */
    protected $fillable = ['name_th', 'name_en','curr_type','head_teacher_id','list_subject_id', 'created_user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','created_user_id');
    }

    public function head_teacher()
    {
        return $this->belongsTo('App\Models\Teacher','head_teacher_id');
    }

    public function subjects()
    {
        return $this->hasMany('App\Models\Subject','cur_id');
    }

    public function majors()
    {
        return $this->hasMany('App\Models\Major','cur_id');
    }

    public function getCurTypeLabel(){
        if($this->cur_type=='G'){
            return "บัณฑิตศึกษา";
        }else{
            return "ปริญญาตรี";
        }
    }

    public function allSubjects(){
        return $this->belongsToMany(Subject::class, 'curriculum_subject','cur_id','subject_id');
    }



}
