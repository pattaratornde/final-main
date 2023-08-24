<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookbank extends Model
{
    use HasFactory;
    protected $table = "disbursements";
    protected $primaryKey = "disbursement_id";
    protected $fillable = ['bookbank_id','bookbank_name','bank_name','created_at','updated_at','ta_id'];

    public function ta()
    {
        return $this->belongsTo('App\Models\TA','ta_id');
    }
}
