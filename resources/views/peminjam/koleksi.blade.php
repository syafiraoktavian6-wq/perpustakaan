<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body class="bg-[#f8fafc] font-['Inter'] antialiased text-slate-700 min-h-screen bg-[radial-gradient(circle_at_top_right,_#e0e7ff_0%,_transparent_25%)]">
    
    <nav class="sticky top-0 z-50 bg-white/70 backdrop-blur-lg border-b border-white">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a class="text-xl font-extrabold tracking-tight text-slate-900 flex items-center gap-2" href="{{ route('dashboard') }}">
                <i class="fas fa-bookmark text-blue-600"></i> Koleksi<span class="text-blue-600">Saya</span>
            </a>
            <a href="{{ route('dashboard') }}" class="h-10 px-6 flex items-center gap-2 rounded-xl bg-slate-900 text-white text-xs font-black hover:bg-slate-800 transition-all active:scale-95 shadow-lg shadow-slate-200">
                <i class="fas fa-th-large text-[10px]"></i> DASHBOARD
            </a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">Arsip Pribadi</h2>
                <p class="text-slate-500 text-sm font-medium mt-1">Daftar buku pilihan yang Anda simpan untuk dibaca nanti.</p>
            </div>
            <a href="{{ route('buku.index') }}" class="h-14 px-8 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-2xl shadow-xl shadow-blue-500/30 transform hover:-translate-y-1 active:scale-95 transition-all flex items-center gap-3">
                <i class="fas fa-plus"></i> Tambah Literatur
            </a>
        </div>

        @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-2xl border border-emerald-100 flex items-center gap-3">
                <i class="fas fa-check-circle text-lg"></i> {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($koleksi as $k)
            <div class="group bg-white/70 backdrop-blur-xl border border-white rounded-[2.5rem] p-6 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-[1.5rem] flex items-center justify-center text-2xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500 shadow-inner">
                    <i class="fas fa-book"></i>
                </div>
                
                <h6 class="font-extrabold text-slate-900 line-clamp-2 mb-1">{{ $k->buku->Judul }}</h6>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-8">{{ $k->buku->Penulis }}</p>
                
                <div class="w-full space-y-3 mt-auto">
                    <form action="{{ route('peminjam.store', $k->BukuID) }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="w-full h-12 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-blue-600 transition-all active:scale-95 flex items-center justify-center gap-2">
                            <i class="fas fa-paper-plane"></i> Ajukan Pinjam
                        </button>
                    </form>
                    
                    <form action="{{ route('koleksi.destroy', $k->KoleksiID) }}" method="POST" class="m-0">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full h-12 bg-rose-50 text-rose-500 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-rose-500 hover:text-white transition-all active:scale-95" onclick="return confirm('Hapus dari daftar favorit?')">
                            <i class="fas fa-trash-alt mr-1"></i> Singkirkan
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center">
                <div class="w-24 h-24 bg-slate-100 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-folder-open text-4xl"></i>
                </div>
                <h4 class="text-xl font-extrabold text-slate-900">Belum Ada Favorit</h4>
                <p class="text-slate-400 text-sm font-medium mt-1">Mulai jelajahi katalog dan simpan buku yang Anda sukai.</p>
                <a href="{{ route('buku.index') }}" class="inline-flex h-12 px-8 mt-8 bg-blue-600 text-white text-xs font-black rounded-xl items-center shadow-lg shadow-blue-200">MULAI CARI</a>
            </div>
            @endforelse
        </div>
    </main>

    <footer class="text-center py-12 opacity-30">
        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em]">&copy; 2026 Perpus Digital &bull; SMKN 11 Malang</p>
    </footer>
</body>