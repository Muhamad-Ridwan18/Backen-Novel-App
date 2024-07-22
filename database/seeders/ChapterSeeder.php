<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chapter;
use App\Models\Novel;
use App\Models\Tag;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ambil semua novel yang sudah ada
        $novels = Novel::all();

        foreach ($novels as $novel) {
            // Inisialisasi nomor bab (chapter_number)
            $chapterNumber = 1;

            // Membuat 10 bab (chapter) untuk setiap novel
            for ($i = 0; $i < 10; $i++) {
                Chapter::factory()->create([
                    'novel_id' => $novel->id,
                    'chapter_number' => $chapterNumber++,
                ]);
            }
        }
    }
}
