<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'director',
        'genre',
        'release_year',
        'duration',
        'synopsis',
    ];

    protected function casts(): array
    {
        return [
            'release_year' => 'integer',
            'duration' => 'integer',
        ];
    }
}