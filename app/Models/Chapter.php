<?php

// app/Models/Chapter.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'novel_id',
        'title',
        'content',
        'chapter_number',
        'published_date',
    ];

    public function novel()
    {
        return $this->belongsTo(Novel::class);
    }

    public function lastReadings()
    {
        return $this->hasMany(LastReading::class);
    }
}

