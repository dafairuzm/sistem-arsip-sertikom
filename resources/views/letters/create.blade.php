@extends('layouts.app')
@section('content')
    <h2 class="text-xl font-semibold mb-4">Tambah Arsip Surat</h2>
    <form action="{{ route('letters.store') }}" method="post" enctype="multipart/form-data"
        class="bg-white border rounded p-4 space-y-4">
        @csrf
        <div>
            <label class="block text-sm mb-1">Judul</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full rounded border px-3 py-2" required>
            @error('title')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block text-sm mb-1">Kategori</label>
            <select name="category_id" class="w-full rounded border px-3 py-2" required>
                <option value="">-- Pilih --</option>
                @foreach ($categories as $c)
                    <option value="{{ $c->id }}" @selected(old('category_id') == $c->id)>{{ $c->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block text-sm mb-1">Deskripsi (Opsional)</label>
            <textarea name="description" rows="3" class="w-full rounded border px-3 py-2" placeholder="Masukkan deskripsi surat...">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label class="block text-sm mb-1">File PDF</label>
            <input type="file" name="file" accept="application/pdf" class="w-full rounded border px-3 py-2 bg-white"
                required>
            @error('file')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="flex gap-2">
            <a href="{{ route('letters.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-50">Kembali</a>
            <button class="px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700">Simpan</button>
        </div>
    </form>
@endsection
