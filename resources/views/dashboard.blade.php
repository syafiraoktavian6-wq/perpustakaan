<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body class="bg-[#f8fafc] font-['Inter'] antialiased text-slate-700 min-h-screen bg-[radial-gradient(circle_at_top_right,_#e0e7ff_0%,_transparent_25%)]">
    
    <nav class="sticky top-0 z-50 bg-white/70 backdrop-blur-lg border-b border-white">
        <div class="max-w-7xl mx-auto px-8 h-20 flex items-center justify-between">
            <a class="text-xl font-extrabold tracking-tight text-slate-900 flex items-center gap-2" href="#">
                <i class="fas fa-book-reader text-blue-600"></i> Perpus<span class="text-blue-600">Digital</span>
            </a>
            <form action="/logout" method="POST" class="m-0">
                @csrf
                <button type="submit" class="h-10 px-5 bg-rose-50 text-rose-600 text-[10px] font-black tracking-widest rounded-xl border border-rose-100 hover:bg-rose-500 hover:text-white transition-all active:scale-95" onclick="return confirm('Keluar dari sistem?')">
                    KELUAR
                </button>
            </form>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-8 py-12">
        <div class="relative overflow-hidden bg-white/40 backdrop-blur-md border border-white rounded-[2.5rem] p-10 mb-12 shadow-sm">
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight">Halo, {{ auth()->user()->NamaLengkap }}! 👋</h2>
                    <p class="text-slate-500 font-medium mt-2">Akses cepat ke semua fitur perpustakaan digital Anda.</p>
                </div>
                <div>
                    <span class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-blue-600 text-white text-xs font-black uppercase tracking-widest shadow-lg shadow-blue-200">
                        <i class="fas fa-shield-halved"></i> {{ auth()->user()->role }}
                    </span>
                </div>
            </div>
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-100 rounded-full blur-3xl opacity-50"></div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-8">
            
            <div class="group bg-white/70 backdrop-blur-xl border border-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col">
                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-book"></i>
                </div>
                <h5 class="text-lg font-black text-slate-900 mb-2">E-Katalog</h5>
                <p class="text-sm font-medium text-slate-400 mb-8 flex-grow">Jelajahi koleksi pustaka dan ulasan pembaca.</p>
                <a href="{{ route('buku.index') }}" class="h-12 flex items-center justify-center bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-blue-600 transition-all active:scale-95">Buka Katalog</a>
            </div>

            @if(auth()->user()->role == 'peminjam')
            <div class="group bg-white/70 backdrop-blur-xl border border-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col">
                <div class="w-16 h-16 bg-sky-50 text-sky-600 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-sky-500 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-clock-rotate-left"></i>
                </div>
                <h5 class="text-lg font-black text-slate-900 mb-2">Aktivitas</h5>
                <p class="text-sm font-medium text-slate-400 mb-8 flex-grow">Lacak durasi dan status pinjaman buku Anda.</p>
                <a href="{{ route('peminjam.pinjaman') }}" class="h-12 flex items-center justify-center bg-sky-50 text-sky-600 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-sky-500 hover:text-white transition-all active:scale-95">Lihat Riwayat</a>
            </div>

            <div class="group bg-white/70 backdrop-blur-xl border border-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col">
                <div class="w-16 h-16 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-rose-500 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-heart"></i>
                </div>
                <h5 class="text-lg font-black text-slate-900 mb-2">Favorit</h5>
                <p class="text-sm font-medium text-slate-400 mb-8 flex-grow">Akses cepat ke buku-buku pilihan Anda.</p>
                <a href="{{ route('koleksi.index') }}" class="h-12 flex items-center justify-center bg-rose-50 text-rose-600 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-rose-500 hover:text-white transition-all active:scale-95">Buka Koleksi</a>
            </div>
            @endif

            @if(auth()->user()->role == 'administrator' || auth()->user()->role == 'petugas')
            <div class="group bg-white/70 backdrop-blur-xl border border-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col">
                <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-layer-group"></i>
                </div>
                <h5 class="text-lg font-black text-slate-900 mb-2">Kategori</h5>
                <p class="text-sm font-medium text-slate-400 mb-8 flex-grow">Organisir genre dan klasifikasi buku sistem.</p>
                <a href="{{ route('kategori.index') }}" class="h-12 flex items-center justify-center bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-emerald-500 hover:text-white transition-all active:scale-95">Atur Genre</a>
            </div>

            <div class="group bg-white/70 backdrop-blur-xl border border-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col">
                <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-print"></i>
                </div>
                <h5 class="text-lg font-black text-slate-900 mb-2">Pelaporan</h5>
                <p class="text-sm font-medium text-slate-400 mb-8 flex-grow">Cetak data transaksi dan laporan bulanan.</p>
                <a href="{{ route('laporan.generate') }}" class="h-12 flex items-center justify-center bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-indigo-600 hover:text-white transition-all active:scale-95">Rekap Data</a>
            </div>
            @endif

            @if(auth()->user()->role == 'administrator')
            <div class="group bg-white/70 backdrop-blur-xl border border-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col">
                <div class="w-16 h-16 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-amber-500 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-user-gear"></i>
                </div>
                <h5 class="text-lg font-black text-slate-900 mb-2">Akses User</h5>
                <p class="text-sm font-medium text-slate-400 mb-8 flex-grow">Kelola akun petugas dan otorisasi sistem.</p>
                <a href="{{ route('petugas.index') }}" class="h-12 flex items-center justify-center bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-amber-500 hover:text-white transition-all active:scale-95">Kelola Akun</a>
            </div>
            @endif

        </div>
    </main>

    <footer class="text-center py-12 opacity-30">
        <p class="text-[11px] font-bold text-slate-900 uppercase tracking-[0.3em]">&copy; 2026 Perpus Digital &bull; SMK Negeri 11 Malang</p>
    </footer>

</body>