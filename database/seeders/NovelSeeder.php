<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Novel;
use App\Models\Tag;
use Database\Factories\NovelFactory;

class NovelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Novel::factory()
            ->count(10) 
            ->create()
            ->each(function ($novel) {
                $tags = Tag::inRandomOrder()->limit(3)->get();
                $novel->tags()->attach($tags->pluck('id'));
            });
    }
}