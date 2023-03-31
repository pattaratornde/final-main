<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'name',
        'email',
        'password',
        'user_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ta(){
        return $this->belongsTo('App\Models\TA','ta_user_id');
    }


    public function isAdmin(){  //ฟังก์ชั่นตรวจสอบว่าเป็นแอดมินหรือไม่ ถ้าuser_type =1 แสดงว่าเป็นแอดมิน//
        if ($this->user_type == 1 ){
            return true;  //จริง
        }
        return false;   //ไม่จริง
    
    }
    public function isUser(){  //ฟังก์ชั่นตรวจสอบว่าเป็นแอดมินหรือไม่ ถ้าuser_type =1 แสดงว่าเป็นแอดมิน//
        if ($this->user_type == 0 ){
            return true;  //จริง
        }
        return false;   //ไม่จริง
    }


}
