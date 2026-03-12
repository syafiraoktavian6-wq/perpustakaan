<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body class="bg-[#f8fafc] font-['Inter'] antialiased text-slate-700 min-h-screen bg-[radial-gradient(circle_at_top_right,_#e0e7ff_0%,_transparent_25%)]">
    
    <nav class="sticky top-0 z-50 bg-white/70 backdrop-blur-lg border-b border-white">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a class="text-xl font-extrabold tracking-tight text-slate-900 flex items-center gap-2" href="/dashboard">
                <i class="fas fa-history text-blue-600"></i> Aktivitas<span class="text-blue-600">User</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-xl bg-rose-50 text-rose-500 border border-rose-100 hover:bg-rose-500 hover:text-white transition-all active:scale-95">
                    <i class="fas fa-power-off text-sm"></i>
                </button>
            </form>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white text-xl shadow-xl shadow-blue-200">
                    <i class="fas fa-clock-rotate-left"></i>
                </div>
                <div>
                    <h3 class="text-3xl font-black text-slate-900 tracking-tight leading-none">Log Sirkulasi</h3>
                    <p class="text-slate-500 text-sm font-medium mt-2 tracking-wide">Pantau status literatur yang sedang Anda pinjam.</p>
                </div>
            </div>
            <a href="/pinjam-buku" class="h-14 px-8 bg-slate-900 text-white font-black text-xs uppercase tracking-widest rounded-2xl hover:bg-blue-600 transition-all shadow-xl shadow-slate-200 flex items-center gap-3">
                <i class="fas fa-plus"></i> Pinjam Koleksi Baru
            </a>
        </div>

        <div class="bg-white/70 backdrop-blur-xl border border-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.02)] overflow-hidden p-2">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] border-b border-slate-50">
                            <th class="px-8 py-6">Detail Literatur</th>
                            <th class="px-6 py-6">Periode Pinjam</th>
                            <th class="px-6 py-6">Batas Kembali</th>
                            <th class="px-8 py-6 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50/50">
                        @forelse($pinjaman as $p)
                        <tr class="group hover:bg-blue-50/30 transition-all duration-300">
                            <td class="px-8 py-8">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 group-hover:bg-white group-hover:text-blue-500 transition-all border border-slate-100">
                                        <i class="fas fa-book-bookmark text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 group-hover:text-blue-600 transition-colors leading-tight">{{ $p->buku->Judul ?? 'Karya Tidak Tersedia' }}</div>
                                        <div class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-tighter">{{ $p->buku->Penulis ?? 'Anonim' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-8">
                                <span class="text-xs font-bold text-slate-600 bg-white px-3 py-1.5 rounded-lg border border-slate-100">
                                    {{ \Carbon\Carbon::parse($p->TanggalPeminjaman)->translatedFormat('d M Y') }}
                                </span>
                            </td>
                            <td class="px-6 py-8">
                                @if($p->TanggalPengembalian)
                                    <span class="text-xs font-bold text-slate-400 italic">
                                        {{ \Carbon\Carbon::parse($p->TanggalPengembalian)->translatedFormat('d M Y') }}
                                    </span>
                                @else
                                    <span class="text-[10px] font-black text-rose-400 uppercase tracking-widest flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 bg-rose-400 rounded-full animate-ping"></span> Belum Kembali
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-8 text-center">
                                @if($p->StatusPeminjaman == 'Sudah Dikembalikan')
                                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-wider border border-emerald-100">
                                        <i class="fas fa-check-circle"></i> SELESAI
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-wider border border-blue-100">
                                        <i class="fas fa-clock"></i> AKTIF
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-24 text-center">
                                <div class="text-slate-100 mb-4"><i class="fas fa-database fa-4x"></i></div>
                                <h6 class="text-slate-400 font-bold uppercase tracking-widest text-xs">Arsip Sirkulasi Masih Kosong</h6>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="text-center py-12 opacity-20">
        <p class="text-[11px] font-bold text-slate-900 uppercase tracking-[0.3em]">&copy; 2026 Admin Panel &bull; SMKN 11 Malang</p>
    </footer>
</body>