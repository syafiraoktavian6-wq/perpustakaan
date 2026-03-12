<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body { font-family: 'Inter', sans-serif; background: radial-gradient(circle at top right, #f8fafc, #eff6ff); min-height: 100vh; }
    .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.3); }
</style>

<nav class="glass sticky top-0 z-50 mb-10 border-b border-blue-100/50">
    <div class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="/dashboard" class="flex items-center gap-2 text-blue-600 font-bold text-xl tracking-tight">
            <div class="bg-blue-600 p-2 rounded-lg text-white shadow-lg shadow-blue-200"><i class="fas fa-layer-group"></i></div>
            <span>LibSpace</span>
        </a>
        <a href="/dashboard" class="text-sm font-semibold text-slate-500 hover:text-blue-600 transition-all flex items-center gap-2 px-4 py-2 rounded-xl hover:bg-blue-50/50">
            <i class="fas fa-arrow-left text-xs"></i> Kembali
        </a>
    </div>
</nav>

<div class="max-w-5xl mx-auto px-6 pb-20">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800 tracking-tight">Manajemen Kategori</h1>
            <p class="text-slate-500 text-sm">Klasifikasikan koleksi buku untuk mempermudah navigasi pembaca.</p>
        </div>
        <button data-bs-toggle="modal" data-bs-target="#modalTambah" class="bg-blue-600 hover:bg-blue-700 text-white px-6 h-12 rounded-2xl font-bold shadow-xl shadow-blue-200 transition-all active:scale-95 flex items-center justify-center gap-2">
            <i class="fas fa-plus-circle"></i> Kategori Baru
        </button>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-2xl mb-8 flex items-center gap-4 animate-bounce-in">
        <i class="fas fa-check-circle text-emerald-500 text-xl"></i>
        <span class="text-emerald-800 font-medium text-sm">{{ session('success') }}</span>
    </div>
    @endif

    <div class="glass rounded-[2rem] shadow-2xl shadow-blue-100/50 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-[0.1em] text-center w-20">No</th>
                    <th class="px-6 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-[0.1em]">Label Kategori</th>
                    <th class="px-8 py-5 text-[11px] font-bold text-slate-400 uppercase tracking-[0.1em] text-right">Tindakan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($kategori as $index => $k)
                <tr class="hover:bg-blue-50/30 transition-colors group">
                    <td class="px-8 py-5 text-center font-bold text-slate-300 group-hover:text-blue-400 transition-colors tracking-tighter">{{ $index + 1 }}</td>
                    <td class="px-6 py-5 font-bold text-slate-700">{{ $k->NamaKategori }}</td>
                    <td class="px-8 py-5">
                        <div class="flex justify-end items-center gap-3">
                            <form action="{{ route('kategori.destroy', $k->KategoriID) }}" method="POST" class="m-0">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus data ini selamanya?')" class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white transition-all duration-300 flex items-center justify-center shadow-sm">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="py-20 text-center">
                        <div class="flex flex-col items-center opacity-40">
                            <i class="fas fa-folder-open text-6xl text-slate-200 mb-4"></i>
                            <p class="font-medium text-slate-400">Arsip kategori masih kosong.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered px-4">
        <div class="modal-content !rounded-[2.5rem] !border-0 shadow-2xl p-4">
            <div class="flex justify-between items-center p-6 pb-2">
                <h3 class="text-xl font-extrabold text-slate-800">Definisikan Kategori</h3>
                <button type="button" class="text-slate-400 hover:text-slate-600 transition-colors" data-bs-dismiss="modal"><i class="fas fa-times text-xl"></i></button>
            </div>
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="p-6">
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3 ms-1">Nama Identitas Kategori</label>
                    <input type="text" name="NamaKategori" class="w-full h-14 px-5 rounded-2xl bg-slate-50 border-2 border-slate-50 focus:border-blue-500 focus:bg-white transition-all outline-none font-semibold text-slate-700 placeholder:text-slate-300" placeholder="Misal: Literasi Digital" required autofocus>
                </div>
                <div class="flex gap-3 p-6 pt-2">
                    <button type="button" class="flex-1 h-12 rounded-2xl font-bold text-slate-400 hover:bg-slate-100 transition-colors" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="flex-[2] h-12 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-bold shadow-lg shadow-blue-100 transition-all active:scale-95">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>