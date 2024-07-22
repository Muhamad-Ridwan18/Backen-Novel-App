<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use App\Models\Tag;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NovelController extends Controller
{
    public function index()
    {
        $novels = Novel::with(['category', 'tags', 'author'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Novels retrieved successfully',
            'novels' => $novels
        ], 200);
    }

    public function store(Request $request)
    {
        Log::info('Request Headers: ', $request->headers->all());
        Log::info('Request Body: ', $request->all());
        // Validasi request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author.id' => 'nullable|integer',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'required|string',
            'published_date' => 'required|date_format:Y-m-d',
            'synopsis' => 'required|string',
            'tags' => 'array',  // Array of tag IDs
        ]);

        $validatedData['author'] = $request->input('author.id');
        // Simpan novel baru
        $novel = Novel::create($validatedData);

        // Attach tags
        if (isset($validatedData['tags'])) {
            $novel->tags()->attach($validatedData['tags']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Novel created successfully', 
            'data' => $novel
        ], 201);
    }



    public function show($id)
    {
        $novel = Novel::with(['category', 'tags', 'author'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Novel retrieved successfully',
            'novel' => $novel
        ], 200);
    }

    public function update(Request $request, $id)
    {
        Log::info('Request Headers: ', $request->headers->all());
        Log::info('Request Body: ', $request->all());

        try {
            $novel = Novel::findOrFail($id);

            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'author.id' => 'nullable|integer',
                'category_id' => 'required|exists:categories,id',
                'cover_image' => 'nullable|string',
                'published_date' => 'nullable|date',
                'synopsis' => 'nullable|string',
            ]);

            if ($request->hasFile('cover_image')) {
                $validatedData['cover_image'] = $request->file('cover_image')->store('covers');
            }
            $validatedData['author'] = $request->input('author.id');

            $novel->update($validatedData);

            Log::info('Novel updated successfully', ['novel' => $novel]);

            return response()->json([
                'success' => true,
                'message' => 'Novel updated successfully',
                'novel' => $novel
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error updating novel', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Error updating novel'], 500);
        }
    }


    public function destroy($id)
    {
        $novel = Novel::findOrFail($id);
        Chapter::where('novel_id', $novel->id)->delete();
        $novel->tags()->detach();

        $novel->delete();

        return response()->json([
            'success' => true,
            'message' => 'Novel, associated chapters, and tags deleted successfully',
        ], 200);
    }

    public function lastNovel()
    {
        $novels = Novel::with(['category', 'tags', 'author'])->latest()->limit(10)->get();

        if ($novels->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No novels found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Last 10 novels retrieved successfully',
            'novels' => $novels,
        ], 200);
    }

    public function getNovelByAuthor($id)
    {
        $novel = Novel::with(['category', 'tags', 'author'])->where('author', $id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Novel retrieved successfully',
            'novel' => $novel
        ], 200);
    }
}
