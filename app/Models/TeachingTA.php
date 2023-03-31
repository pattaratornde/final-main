<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Teaching;

class TeachingTA extends Model
{
    use HasFactory;
    protected $table = "teaching_tas";
    protected $primaryKey = "id";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function teaching()
    {
        return $this->belongsTo('App\Models\Teaching','teaching_id');
    }
    public function class()
    {
        return $this->belongsTo('App\Models\StudentClass','class_id');
    }

}
