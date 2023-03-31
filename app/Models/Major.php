<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'majors';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'major_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name_th', 'name_en', 'major_type', 'cur_id','created_user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function majorTypeLabel(){
        if($this->major_type=='N'){
            return "ภาคปกติ";
        }else if($this->major_type=='S'){
            return "โครงการพิเศษ";
        }
        return "";
    }

    public function curriculum()
    {
        return $this->belongsTo('App\Models\Curriculum','cur_id');
    }



}
