<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    // Method untuk mendapatkan daftar chapter
    public function index()
    {
        $chapters = Chapter::all();
        return response()->json(['chapters' => $chapters], 200);
    }

    public function fetchChaptersByNovelId($novel_id)
    {
        $chapters = Chapter::where('novel_id', $novel_id)->get();

        return response()->json($chapters);
    }

    // Method untuk membuat chapter baru
    public function store(Request $request)
    {
        // Validasi request
        $validatedData = $request->validate([
            'novel_id' => 'required|exists:novels,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'chapter_number' => 'required|integer',
            'published_date' => 'required|date_format:Y-m-d',
        ]);

        // Simpan chapter baru
        $chapter = Chapter::create($validatedData);

        return response()->json(['message' => 'Chapter created successfully', 'chapter' => $chapter], 201);
    }

    // Method untuk mendapatkan detail chapter berdasarkan ID
    public function show($id)
    {
        $chapter = Chapter::findOrFail($id);
        return response()->json(['chapter' => $chapter], 200);
    }

    // Method untuk memperbarui chapter
    public function update(Request $request, $id)
    {
        // Validasi request
        $validatedData = $request->validate([
            'novel_id' => 'required|exists:novels,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'chapter_number' => 'required|integer',
            'published_date' => 'required|date_format:Y-m-d',
        ]);

        // Temukan chapter berdasarkan ID
        $chapter = Chapter::findOrFail($id);

        // Update chapter
        $chapter->update($validatedData);

        return response()->json(['message' => 'Chapter updated successfully', 'chapter' => $chapter], 200);
    }

    // Method untuk menghapus chapter
    public function destroy($id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->delete();

        return response()->json(['message' => 'Chapter deleted successfully'], 200);
    }
}
