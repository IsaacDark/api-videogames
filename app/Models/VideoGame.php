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
        'updated_by'
    ];

    protected $attributes = [
        'created_by' => null,
        'updated_by' => null,
    ];

}
