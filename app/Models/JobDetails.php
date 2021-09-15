<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDetails extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_details';

    protected $fillable = [
                            'job_id', 
                            'running_no', 
                            'job_type', 
                            'job_status', 
                            'created_at', 
                            'updated_at'
                        ];
}
