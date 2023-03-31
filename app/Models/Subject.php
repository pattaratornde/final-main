<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $primaryKey = "subject_id";
    protected $guarded = [];

    protected $casts = [
        'subject_id' => 'string'
    ];

    protected $keyType = 'string';

    public function curriculum()
    {
        return $this->belongsTo('App\Models\Curriculum','cur_id');
    }

    public function courses()
    {
        return $this->hasMany('App\Models\Course','subject_id');
    }
    public function getTitle(){
        return $this->subject_id." ".$this->name_th;
    }

    public function hasLec(){
        $w_text = str_replace("(","",trim($this->weight));
        $w_text = str_replace(")","",$w_text);

        $w_arr = explode("-",$w_text);

        if($w_arr[0]!="0"){
            return true;
        }

        return false;
    }
    public function hasLab(){
        $w_text = str_replace("(","",trim($this->weight));
        $w_text = str_replace(")","",$w_text);

        $w_arr = explode("-",$w_text);

        if($w_arr[1]!="0"){
            return true;
        }

        return false;
    }
}
