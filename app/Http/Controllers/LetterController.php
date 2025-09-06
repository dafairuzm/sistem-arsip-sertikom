<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Letter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $letters = Letter::with('category')
            ->when($q, function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%");  // MySQL ci collation => case-insensitive
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('letters.index', compact('letters', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('letters.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string', 'max:500'],
            'file' => ['required', 'file', 'mimes:pdf', 'max:20480'],  // 20MB
        ]);

        $file = $request->file('file');
        $path = $file->store('letters', 'public');

        Letter::create([
            'title' => $data['title'],
            'category_id' => $data['category_id'],
            'description' => $data['description'],
            'file_path' => $path,
            'original_name' => $file->getClientOriginalName(),
        ]);

        return redirect()->route('letters.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Letter $letter)
    {
        $letter->load('category');
        return view('letters.show', compact('letter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Letter $letter)
    {
        $categories = Category::orderBy('name')->get();
        return view('letters.edit', compact('letter', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Letter $letter)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string', 'max:500'],
            'file' => ['nullable', 'file', 'mimes:pdf', 'max:20480'],
        ]);

        $payload = [
            'title' => $data['title'],
            'category_id' => $data['category_id'],
            'description' => $data['description'],
        ];

        if ($request->hasFile('file')) {
            // hapus file lama
            if ($letter->file_path && Storage::disk('public')->exists($letter->file_path)) {
                Storage::disk('public')->delete($letter->file_path);
            }
            $file = $request->file('file');
            $payload['file_path'] = $file->store('letters', 'public');
            $payload['original_name'] = $file->getClientOriginalName();
        }

        $letter->update($payload);

        return redirect()->route('letters.index')->with('success', 'Data berhasil disimpan');
    }

    public function destroy(Letter $letter)
    {
        if ($letter->file_path && Storage::disk('public')->exists($letter->file_path)) {
            Storage::disk('public')->delete($letter->file_path);
        }
        $letter->delete();
        return redirect()->route('letters.index')->with('success', 'Data berhasil dihapus');
    }

    public function download(Letter $letter)
    {
        $path = $letter->file_path;
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }
        // Namakan file dengan judul atau nama asli
        $downloadName = Str::slug($letter->title) . '.pdf';
        return Storage::disk('public')->download($path, $downloadName);
    }
}
