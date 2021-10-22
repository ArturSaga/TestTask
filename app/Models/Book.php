<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;


    protected $table = 'books';

    protected $fillable = ['name', 'price'];

    public function getAuthors()
    {
        return $this->belongsToMany(Author::class);
    }
}
