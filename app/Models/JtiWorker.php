<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JtiWorker extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id', 
        'asset_id', 
        'asset_name', 
        'asset_type', 
        'active', 
        'created_at', 
        'updated_at'
    ];
}
