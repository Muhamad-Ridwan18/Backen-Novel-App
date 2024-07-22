<?php

// app/Models/Novel.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Novel extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author',
        'category_id',
        'cover_image',
        'published_date',
        'synopsis',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'novel_tag');
    }

    public function lastReadings()
    {
        return $this->hasMany(LastReading::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
