@extends('layouts.app')
@section('content')
@php use Illuminate\Support\Str; @endphp
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Kategori Surat</h2>
        <a href="{{ route('categories.create') }}"
            class="inline-flex items-center px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700">Tambah</a>
    </div>
    <div class="overflow-x-auto bg-white border rounded">
        <table class="w-full text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="text-left px-3 py-2">Nama</th>
                    <th class="text-left px-3 py-2">Deskripsi</th>
                    <th class="px-3 py-2 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $cat)
                    <tr class="border-t">
                        <td class="px-3 py-2">{{ $cat->name }}</td>
                        <td class="px-3 py-2">{{ $cat->description ? Str::limit($cat->description, 50) : '-' }}</td>
                        <td class="px-3 py-2">
                            <div class="flex flex-wrap gap-2 justify-end">
                                <a href="{{ route('categories.edit', $cat) }}"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-white bg-amber-500 hover:bg-amber-600 text-sm md:text-base">
                                    Edit
                                </a>

                                <form action="{{ route('categories.destroy', $cat) }}" method="post" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="button"
                                        class="btn-delete inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-white bg-rose-600 hover:bg-rose-700 text-sm md:text-base"
                                        data-message="Yakin ingin menghapus kategori “{{ $cat->name }}” ?">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-3 py-4 text-center text-slate-500">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $categories->links() }}</div>
@endsection
