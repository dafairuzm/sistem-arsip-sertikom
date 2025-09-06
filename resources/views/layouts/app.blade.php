<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Arsip Surat Desa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<!-- Modal Root -->
<div id="app-modal" class="fixed inset-0 z-50 hidden" aria-hidden="true">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-black/60"></div>

    <!-- Panel -->
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="w-full max-w-md rounded-2xl bg-white shadow-xl ring-1 ring-black/5">
            <div class="px-5 pt-5">
                <h3 id="app-modal-title" class="text-lg font-semibold text-slate-800">Konfirmasi</h3>
                <p id="app-modal-message" class="mt-2 text-slate-600"></p>
            </div>
            <div class="px-5 pb-5 pt-4 flex items-center justify-end gap-2">
                <button type="button" id="app-modal-cancel"
                    class="px-4 py-2 rounded-lg border border-slate-300 hover:bg-slate-50">
                    Batal
                </button>
                <button type="button" id="app-modal-confirm"
                    class="px-4 py-2 rounded-lg text-white bg-rose-600 hover:bg-rose-700">
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        const modal = document.getElementById('app-modal');
        const titleEl = document.getElementById('app-modal-title');
        const msgEl = document.getElementById('app-modal-message');
        const btnCancel = document.getElementById('app-modal-cancel');
        const btnConfirm = document.getElementById('app-modal-confirm');
        let onConfirm = null;

        function openModal({
            title = 'Konfirmasi',
            message = '',
            confirmText = 'OK',
            onOk = null
        }) {
            titleEl.textContent = title;
            msgEl.textContent = message;
            btnConfirm.textContent = confirmText;
            onConfirm = typeof onOk === 'function' ? onOk : null;
            modal.classList.remove('hidden');
            modal.setAttribute('aria-hidden', 'false');
            // fokus tombol konfirmasi biar cepat enter
            setTimeout(() => btnConfirm.focus(), 0);
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');
            onConfirm = null;
        }

        // backdrop close
        modal.addEventListener('click', (e) => {
            if (e.target === modal || e.target === modal.firstElementChild) {
                closeModal();
            }
        });

        // tombol
        btnCancel.addEventListener('click', closeModal);
        btnConfirm.addEventListener('click', () => {
            if (onConfirm) onConfirm();
            closeModal();
        });

        // ESC key
        document.addEventListener('keydown', (e) => {
            if (!modal.classList.contains('hidden') && e.key === 'Escape') {
                closeModal();
            }
        });

        // Hook tombol delete generik
        document.addEventListener('click', (e) => {
            const delBtn = e.target.closest('.btn-delete');
            if (delBtn) {
                e.preventDefault();
                const form = delBtn.closest('form');
                const msg = delBtn.getAttribute('data-message') || 'Yakin ingin melanjutkan aksi ini?';
                openModal({
                    title: 'Konfirmasi Hapus',
                    message: msg,
                    confirmText: 'Ya, Hapus',
                    onOk: () => form.submit()
                });
            }
        });

        // Expose kalau mau dipakai konfirmasi lain:
        window.openConfirmModal = (opts) => openModal(opts);
    })();
</script>


<body class="bg-gray-50 text-slate-800">
    <div class="min-h-screen grid grid-cols-12">
        <!-- Sidebar -->
        <aside class="col-span-12 md:col-span-3 lg:col-span-2 bg-white shadow-sm border-r">
            <div class="p-4 border-b">
                <h1 class="text-lg font-semibold">Arsip Surat</h1>
                <p class="text-xs text-slate-500">Desa Karangduren</p>
            </div>
            <nav class="p-2 space-y-1">
                <a href="{{ route('letters.index') }}"
                    class="block px-3 py-2 rounded hover:bg-slate-100 {{ request()->routeIs('letters.*') ? 'bg-slate-100 font-medium' : '' }}">Arsip
                    Surat</a>
                <a href="{{ route('categories.index') }}"
                    class="block px-3 py-2 rounded hover:bg-slate-100 {{ request()->routeIs('categories.*') ? 'bg-slate-100 font-medium' : '' }}">Kategori
                    Surat</a>
                <a href="{{ route('about') }}"
                    class="block px-3 py-2 rounded hover:bg-slate-100 {{ request()->routeIs('about') ? 'bg-slate-100 font-medium' : '' }}">About</a>
            </nav>
        </aside>


        <!-- Content -->
        <main class="col-span-12 md:col-span-9 lg:col-span-10 p-6">
            @if (session('success'))
                <div class="mb-4 rounded border border-green-200 bg-green-50 text-green-700 px-4 py-3">
                    {{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 rounded border border-red-200 bg-red-50 text-red-700 px-4 py-3">{{ session('error') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>


    <script>
        // Konfirmasi hapus untuk semua form dengan class .confirm-delete
        document.addEventListener('click', function(e) {
            if (e.target.closest('.confirm-delete')) {
                if (!confirm('Yakin ingin menghapus data ini?')) {
                    e.preventDefault();
                }
            }
        })
    </script>
</body>

</html>
