@extends('layouts.app')
@section('content')
    <h2 class="text-xl font-semibold mb-4">Ubah Kategori</h2>
    <form action="{{ route('categories.update', $category) }}" method="post" class="bg-white border rounded p-4 space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm mb-1">Nama Kategori</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}"
                class="w-full rounded border px-3 py-2" required>
            @error('name')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block text-sm mb-1">Deskripsi (Opsional)</label>
            <textarea name="description" rows="3" class="w-full rounded border px-3 py-2" placeholder="Masukkan deskripsi kategori...">{{ old('description', $category->description) }}</textarea>
            @error('description')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex gap-2">
            <a href="{{ route('letters.index') }}"
                class="px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-50">Kembali</a>
            <button class="px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700">Simpan</button>
        </div>
    </form>
@endsection
