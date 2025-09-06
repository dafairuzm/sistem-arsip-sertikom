<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->paginate(12);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);
        Category::create($data);
        return redirect()->route('categories.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name,' . $category->id],
            'description' => ['nullable', 'string', 'max:500'],
        ]);
        $category->update($data);
        return redirect()->route('categories.index')->with('success', 'Data berhasil disimpan');
    }

    public function destroy(Category $category)
    {
        // Cegah hapus jika dipakai oleh surat agar tidak error FK
        if ($category->letters()->exists()) {
            return back()->with('error', 'Tidak dapat menghapus: kategori sedang digunakan.');
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Data berhasil dihapus');
    }
}
