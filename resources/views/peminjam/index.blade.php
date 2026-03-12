<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body class="bg-[#f8fafc] font-['Inter'] antialiased text-slate-700 min-h-screen bg-[radial-gradient(circle_at_top_right,_#e0e7ff_0%,_transparent_25%)]">
    
    <nav class="sticky top-0 z-50 bg-white/70 backdrop-blur-lg border-b border-white">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a class="text-xl font-extrabold tracking-tight text-slate-900 flex items-center gap-2" href="/dashboard">
                <i class="fas fa-book-reader text-blue-600"></i> Perpus<span class="text-blue-600">Digital</span>
            </a>
            <div class="flex items-center gap-6">
                <a href="/dashboard" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition-colors">Beranda</a>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="h-10 px-5 bg-rose-50 text-rose-600 text-xs font-black rounded-xl border border-rose-100 hover:bg-rose-100 transition-all active:scale-95" onclick="return confirm('Akhiri sesi Anda?')">KELUAR</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="mb-10 flex items-center gap-4">
            <div class="w-1.5 h-8 bg-blue-600 rounded-full"></div>
            <div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight">E-Katalog</h3>
                <p class="text-slate-500 text-sm font-medium">Temukan literatur terbaik untuk dipelajari hari ini.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-8 p-4 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-2xl border border-emerald-100 flex items-center gap-3 animate-fade-in">
                <i class="fas fa-check-circle text-lg"></i> {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mb-16">
            @foreach($buku as $b)
            <div class="group bg-white/70 backdrop-blur-xl border border-white rounded-[2rem] shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 overflow-hidden flex flex-col">
                <div class="aspect-[4/3] bg-slate-50 flex items-center justify-center text-slate-300 group-hover:bg-blue-50 group-hover:text-blue-500 transition-colors">
                    <i class="fas fa-book fa-4x opacity-20"></i>
                </div>
                <div class="p-6 flex-grow">
                    <h6 class="font-extrabold text-slate-900 line-clamp-1 mb-1">{{ $b->Judul }}</h6>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">{{ $b->Penulis }}</p>
                    <div class="mt-4 flex items-center gap-2">
                        <span class="text-[10px] font-black px-2 py-1 bg-slate-100 text-slate-500 rounded-md border border-slate-200 uppercase">{{ $b->TahunTerbit }}</span>
                    </div>
                </div>
                <div class="px-6 pb-6 mt-auto">
                    <form action="{{ route('peminjam.store', $b->BukuID) }}" method="POST">
                        @csrf
                        <input type="hidden" name="BukuID" value="{{ $b->BukuID }}">
                        <button type="submit" class="w-full h-12 bg-blue-600 hover:bg-blue-700 text-white text-xs font-black rounded-xl shadow-lg shadow-blue-500/30 transition-all active:scale-95 flex items-center justify-center gap-2" onclick="return confirm('Pinjam buku ini?')">
                            <i class="fas fa-plus-circle"></i> PINJAM SEKARANG
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mb-8 flex items-center gap-4">
            <div class="w-1.5 h-8 bg-amber-400 rounded-full"></div>
            <h3 class="text-2xl font-black text-slate-900 tracking-tight">Sedang Dibaca</h3>
        </div>

        <div class="bg-white/70 backdrop-blur-xl border border-white rounded-[2.5rem] shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50/50 text-[11px] font-extrabold text-slate-400 uppercase tracking-widest border-b border-slate-100">
                            <th class="px-8 py-5">Judul Karya</th>
                            <th class="px-6 py-5 text-center">Waktu Akses</th>
                            <th class="px-8 py-5 text-center">Status Keanggotaan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($pinjaman as $p)
                            @if($p->StatusPeminjaman != 'Sudah Dikembalikan')
                            <tr class="hover:bg-amber-50/30 transition-colors">
                                <td class="px-8 py-6 font-bold text-slate-900">{{ $p->buku->Judul ?? 'Data Tidak Ada' }}</td>
                                <td class="px-6 py-6 text-center text-xs font-bold text-slate-500">
                                    <span class="bg-white px-3 py-1.5 rounded-lg border border-slate-100">{{ \Carbon\Carbon::parse($p->TanggalPeminjaman)->translatedFormat('d F Y') }}</span>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-wider border border-amber-100">
                                        <i class="fas fa-hourglass-half"></i> Sedang Dipinjam
                                    </span>
                                </td>
                            </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="3" class="px-8 py-16 text-center">
                                    <div class="text-slate-300 mb-2"><i class="fas fa-inbox fa-3x"></i></div>
                                    <p class="text-sm font-bold text-slate-400">Rak pinjaman Anda kosong.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="text-center py-12 opacity-30">
        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em]">&copy; 2026 E-Library &bull; SMKN 11 Malang</p>
    </footer>
</body>