<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaCourseClass extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = "course_ta_class";

    protected $guarded = [];

    public function classta()
    {
        return $this->belongsTo('App\Models\StudentClass','class_id');
    }

    public function courseta()
    {
        return $this->belongsTo('App\Models\TaCourse','id');
    }

    

}
