<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body { font-family: 'Inter', sans-serif; background: #f8fafc; min-height: 100vh; }
    .glass-nav { background: rgba(15, 23, 42, 0.9); backdrop-filter: blur(10px); }
</style>

<nav class="glass-nav sticky top-0 z-50 py-4 px-6 border-b border-slate-800">
    <div class="max-w-6xl mx-auto flex justify-between items-center">
        <a href="/dashboard" class="flex items-center gap-3 group">
            <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white group-hover:rotate-12 transition-transform shadow-lg shadow-blue-900/20"><i class="fas fa-book-open"></i></div>
            <span class="font-black text-white tracking-tighter text-xl">LibSpace<span class="text-blue-500">.</span></span>
        </a>
        <a href="/dashboard" class="text-xs font-black text-slate-400 hover:text-white uppercase tracking-widest transition-colors flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Panel Kontrol
        </a>
    </div>
</nav>

<div class="max-w-6xl mx-auto px-6 py-12">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Manajemen Akun</h1>
            <p class="text-slate-500 font-medium mt-1">Otorisasi akses dan manajemen profil staf perpustakaan.</p>
        </div>
        <a href="{{ route('petugas.create') }}" class="h-14 px-8 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold shadow-xl shadow-blue-200 transition-all flex items-center gap-3 active:scale-95">
            <i class="fas fa-plus-circle"></i> Tambah Staff Baru
        </a>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-2xl mb-8 animate-pulse flex items-center gap-3">
        <i class="fas fa-check-circle text-emerald-500"></i>
        <span class="text-emerald-800 font-bold text-sm">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/60 overflow-hidden border border-slate-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center w-20">No</th>
                        <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Profil Pengguna</th>
                        <th class="px-6 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">Otoritas</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($petugas as $index => $p)
                    <tr class="hover:bg-slate-50/80 transition-colors group">
                        <td class="px-8 py-6 text-center font-black text-slate-300 group-hover:text-blue-600 transition-colors">{{ $index + 1 }}</td>
                        <td class="px-6 py-6">
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-800 text-base leading-none mb-1">{{ $p->Username }}</span>
                                <span class="text-xs text-slate-400 font-medium tracking-tight">{{ $p->Email }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-6 text-center">
                            @php $isAdmin = $p->role == 'administrator'; @endphp
                            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest {{ $isAdmin ? 'bg-indigo-50 text-indigo-600 border border-indigo-100' : 'bg-sky-50 text-sky-600 border border-sky-100' }}">
                                <i class="fas {{ $isAdmin ? 'fa-user-shield' : 'fa-user-tie' }}"></i>
                                {{ $p->role }}
                            </span>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-all transform translate-x-4 group-hover:translate-x-0">
                                <a href="{{ route('petugas.edit', $p->UserID) }}" class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 hover:bg-amber-500 hover:text-white flex items-center justify-center transition-all">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                @if($p->UserID != auth()->user()->UserID)
                                <form action="{{ route('petugas.destroy', $p->UserID) }}" method="POST" class="m-0">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus akses staff ini?')" class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white flex items-center justify-center transition-all">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>