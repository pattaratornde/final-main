<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseTeacher extends Model
{
    protected $primaryKey = 'id';
    protected $table = "course_teachers";
    protected $casts = [
        'course_id' => 'string'
    ];
    protected $guarded = [];

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher','teacher_id');
    }

}
