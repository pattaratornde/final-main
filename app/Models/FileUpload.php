<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TaRequest;

class FileUpload extends Model
{
    use HasFactory;
    protected $table = 'file_uploads';
    public $timestamps = true;

    public $primaryKey="file_id";
    protected $guarded = [];
    protected $dates = [
        'created_at',
        'updated_at'
    ];
    
    //protected $fillable = ['file_id','filename','created_at','updated_at','request_id'];
    public function request()
    {
        return $this->belongsTo('App\Models\TaRequest','request_id');
    }
}


