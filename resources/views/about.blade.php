@extends('layouts.app')
@section('content')
    <h2 class="text-xl font-semibold mb-4">About</h2>
    <div class="bg-white border rounded p-4">
        <div class="flex items-center gap-4">
            <img src="{{ asset('storage/profile/daffa-baru.jpg') }}" alt="Foto"
                class="w-24 h-24 rounded-full object-cover" />
            <div>
                <div class="text-sm text-slate-500">Nama</div>
                <div class="font-medium text-lg">Daffa Fairuz Muslim</div>
                <div class="text-sm text-slate-500 mt-2">NIM</div>
                <div class="font-medium">2231740027</div>
                <div class="text-sm text-slate-500 mt-2">Tanggal Pembuatan</div>
                <div class="font-medium">6 September 2025</div>
            </div>
        </div>
    </div>
@endsection
