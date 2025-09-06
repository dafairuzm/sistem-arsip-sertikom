@extends('layouts.app')
@section('content')
    <h2 class="text-xl font-semibold mb-4">Detail Arsip</h2>
    <div class="bg-white border rounded p-4 space-y-3">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <div class="text-sm text-slate-500">Judul</div>
                <div class="font-medium">{{ $letter->title }}</div>
            </div>
            <div>
                <div class="text-sm text-slate-500">Kategori</div>
                <div class="font-medium">{{ $letter->category->name }}</div>
            </div>
        </div>
        @if($letter->description)
        <div>
            <div class="text-sm text-slate-500">Deskripsi</div>
            <div class="font-medium">{{ $letter->description }}</div>
        </div>
        @endif
        <div class="flex gap-2 pt-2">
            <a href="{{ route('letters.index') }}" class="px-4 py-2 rounded border">Kembali</a>
            <a href="{{ route('letters.download', $letter) }}" class="px-4 py-2 rounded border">Unduh</a>
        </div>
        <div class="mt-4">
            <iframe src="{{ asset('storage/' . $letter->file_path) }}" class="w-full h-[70vh] border rounded"></iframe>
        </div>
    </div>
@endsection
