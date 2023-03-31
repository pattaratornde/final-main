<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use App\Models\User;
use App\Models\FileUpload;

class TaRequest extends Model
{
    use HasFactory;
    protected $table = 'requests';
    protected $primaryKey = 'request_id';
    protected $guarded = [];
    //protected $fillable = ['request_id', 'user_id', 'course_id', 'status', 'comment', 'file_id'];
    
    public function student_user()
    {
        return $this->belongsTo('App\Models\User','student_user_id');
    }
    public function created_user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
    public function course()
    {
        return $this->belongsTo('App\Models\Course','course_id');
    }
    public function fileupload()
    {
        return $this->belongsTo('App\Models\FileUpload','file_id')->orderBy('filename');;
    }
}
