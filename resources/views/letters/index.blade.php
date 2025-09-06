@extends('layouts.app')
@section('content')
@php use Illuminate\Support\Str; @endphp
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Arsip Surat</h2>
        <a href="{{ route('letters.create') }}"
            class="inline-flex items-center px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700">Arsipkan Surat..</a>
    </div>


    <form method="get" class="mb-4">
        <div class="flex gap-2">
            <input type="text" name="q" value="{{ $q }}" placeholder="Cari judul surat..."
                class="w-full rounded border px-3 py-2" />
            <button class="px-4 py-2 rounded border bg-white hover:bg-slate-50">Cari</button>
        </div>
    </form>


    <div class="overflow-x-auto bg-white border rounded">
        <table class="w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="text-left px-3 py-2">Judul</th>
                    <th class="text-left px-3 py-2">Deskripsi</th>
                    <th class="text-left px-3 py-2">Kategori</th>
                    <th class="text-left px-3 py-2">Dibuat</th>
                    <th class="px-3 py-2 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($letters as $letter)
                    <tr class="border-t">
                        <td class="px-3 py-2 font-medium">{{ $letter->title }}</td>
                        <td class="px-3 py-2">{{ $letter->description ? Str::limit($letter->description, 60) : '-' }}</td>
                        <td class="px-3 py-2">{{ $letter->category->name }}</td>
                        <td class="px-3 py-2">{{ $letter->created_at->format('d M Y') }}</td>
                        <td class="px-3 py-2">
                            <div class="flex flex-wrap gap-2 justify-end">
                                <a href="{{ route('letters.show', $letter) }}"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-white bg-slate-600 hover:bg-slate-700 text-sm md:text-base">
                                    Lihat
                                </a>

                                <a href="{{ route('letters.download', $letter) }}"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-white bg-emerald-600 hover:bg-emerald-700 text-sm md:text-base">
                                    Unduh
                                </a>

                                <a href="{{ route('letters.edit', $letter) }}"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-white bg-amber-500 hover:bg-amber-600 text-sm md:text-base">
                                    Edit
                                </a>

                                <form action="{{ route('letters.destroy', $letter) }}" method="post" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="button"
                                        class="btn-delete inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-white bg-rose-600 hover:bg-rose-700 text-sm md:text-base"
                                        data-message="Yakin ingin menghapus arsip “{{ $letter->title }}” ? Aksi ini tidak bisa dibatalkan.">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-3 py-4 text-center text-slate-500">Belum ada arsip.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <div class="mt-4">{{ $letters->links() }}</div>
@endsection
