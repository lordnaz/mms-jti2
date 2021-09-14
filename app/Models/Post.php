<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;


class Post extends Model
{
    use HasFactory;

    use HasTrixRichText;

    protected $guarded = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // protected $table = 'posts';

    // protected $fillable = [
    //                         'id', 
    //                         'poster_name', 
    //                         'role', 
    //                         'ticket_id', 
    //                         'created_by',
    //                         'created_at',
    //                         'updated_at'
    //                     ];

    // protected $casts = [
    //     'created_at' => 'datetime',
    //     'updated_at' => 'datetime',
    // ];
    // protected $dates = ['created_at', 'updated_at'];
}
