<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'dateOfBirth' => 'date:Y-m-d',
        'dateOfDeath' => 'date:Y-m-d',
    ];

    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
