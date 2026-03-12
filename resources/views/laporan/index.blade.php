<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    @media print {
        .d-print-none { display: none !important; }
        .print-only { display: block !important; }
        body { background: white !important; }
        .print-card { box-shadow: none !important; border: 1px solid #e2e8f0 !important; border-radius: 0 !important; }
    }
</style>

<body class="bg-[#f8fafc] font-['Inter'] antialiased text-slate-700 min-h-screen bg-[radial-gradient(circle_at_top_right,_#e0e7ff_0%,_transparent_25%)]">
    
    <nav class="sticky top-0 z-50 bg-white/70 backdrop-blur-lg border-b border-white d-print-none">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a class="text-xl font-extrabold tracking-tight text-slate-900 flex items-center gap-2" href="{{ route('dashboard') }}">
                <i class="fas fa-book-reader text-blue-600"></i> Perpus<span class="text-blue-600">Digital</span>
            </a>
            <a href="{{ route('dashboard') }}" class="h-11 px-6 flex items-center gap-2 rounded-xl bg-slate-900 text-white text-sm font-bold hover:bg-slate-800 transition-all active:scale-95 shadow-lg shadow-slate-200">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-12">
        
        <div class="hidden print-only text-center border-b-4 border-double border-slate-900 pb-6 mb-10">
            <h1 class="text-2xl font-black uppercase tracking-widest">Arsip Laporan Transaksi</h1>
            <h2 class="text-lg font-bold">Perpustakaan Digital SMKN 11 Malang</h2>
            <p class="text-xs text-slate-500 mt-2 italic">Dicetak secara sistematis pada: {{ date('d M Y H:i') }}</p>
        </div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10 d-print-none">
            <div>
                <h3 class="text-3xl font-extrabold text-slate-900 tracking-tight">Data Laporan</h3>
                <p class="text-slate-500 font-medium mt-1">Audit dan cetak riwayat sirkulasi buku secara resmi.</p>
            </div>
            <button onclick="window.print()" class="h-14 px-8 bg-rose-500 hover:bg-rose-600 text-white font-extrabold rounded-2xl shadow-xl shadow-rose-500/20 transform hover:-translate-y-1 active:scale-95 transition-all flex items-center gap-3">
                <i class="fas fa-file-pdf text-lg"></i> Ekspor Laporan
            </button>
        </div>

        @if(session('success'))
            <div class="mb-8 p-5 bg-emerald-50 text-emerald-700 text-sm font-bold rounded-2xl border border-emerald-100 flex items-center gap-3 d-print-none animate-bounce">
                <i class="fas fa-check-circle text-lg"></i> {{ session('success') }}
            </div>
        @endif

        <div class="print-card bg-white/70 backdrop-blur-xl border border-white rounded-[2.5rem] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.04)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 text-[11px] font-extrabold text-slate-400 uppercase tracking-widest border-b border-slate-100">
                            <th class="px-8 py-5 text-center w-20">Ref</th>
                            <th class="px-6 py-5">Identitas Peminjam</th>
                            <th class="px-6 py-5">Koleksi Buku</th>
                            <th class="px-6 py-5 text-center">Waktu Pinjam</th>
                            <th class="px-6 py-5 text-center">Status</th>
                            <th class="px-6 py-5 text-center d-print-none">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($laporan as $index => $lp)
                        <tr class="hover:bg-blue-50/30 transition-colors group">
                            <td class="px-8 py-6 text-center text-xs font-bold text-slate-400">{{ $index + 1 }}</td>
                            <td class="px-6 py-6">
                                <div class="font-bold text-slate-900">{{ $lp->user->NamaLengkap ?? 'Anonim' }}</div>
                                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">Anggota Aktif</div>
                            </td>
                            <td class="px-6 py-6 font-semibold text-blue-600 italic">
                                "{{ $lp->buku->Judul ?? 'Data Hilang' }}"
                            </td>
                            <td class="px-6 py-6 text-center">
                                <span class="text-xs font-bold text-slate-600 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
                                    {{ \Carbon\Carbon::parse($lp->TanggalPeminjaman)->format('d M Y') }}
                                </span>
                            </td>
                            <td class="px-6 py-6 text-center">
                                @if($lp->StatusPeminjaman == 'Sudah Dikembalikan')
                                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-600 text-[11px] font-black uppercase tracking-wider border border-emerald-100 shadow-sm">
                                        <i class="fas fa-check-circle"></i> Arsip
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-amber-50 text-amber-600 text-[11px] font-black uppercase tracking-wider border border-amber-100 shadow-sm animate-pulse">
                                        <i class="fas fa-clock"></i> Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-6 text-center d-print-none">
                                @if($lp->StatusPeminjaman == 'Dipinjam')
                                    <form action="{{ route('peminjaman.kembali', $lp->PeminjamanID) }}" method="POST" class="inline">
                                        @csrf @method('PUT')
                                        <button type="submit" class="h-10 px-5 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-black rounded-xl shadow-md shadow-emerald-200 transition-all active:scale-95" onclick="return confirm('Selesaikan peminjaman ini?')">
                                            SELESAIKAN
                                        </button>
                                    </form>
                                @else
                                    <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-300">
                                        <i class="fas fa-check-double"></i>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="hidden print-only mt-20 flex justify-between">
            <div class="text-center w-64 border-t border-slate-200 pt-4">
                <p class="text-xs font-bold text-slate-400 uppercase italic">Kepala Perpustakaan</p>
            </div>
            <div class="text-center w-64 border-t border-slate-900 pt-4">
                <p class="text-xs font-medium text-slate-600 mb-16">Malang, {{ date('d M Y') }}</p>
                <p class="text-sm font-black uppercase underline">{{ auth()->user()->NamaLengkap }}</p>
                <p class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-widest italic">Petugas Otoritas</p>
            </div>
        </div>

        <footer class="text-center mt-16 d-print-none">
            <p class="text-[11px] font-bold text-slate-300 uppercase tracking-[0.2em]">
                &copy; 2026 Admin Panel &bull; SMK Negeri 11 Malang
            </p>
        </footer>
    </main>

</body>