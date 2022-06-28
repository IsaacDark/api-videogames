<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGame extends Model
{
    use HasFactory;

    protected $table = 'videogames';

    protected $fillable = [
        'name',
        'publication_date',
        'created_by',
        'updated_by',
        'user_id'
    ];

    protected $attributes = [
        'created_by' => null,
        'updated_by' => null,
    ];

}
