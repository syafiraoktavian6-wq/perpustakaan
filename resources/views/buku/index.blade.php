<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body class="bg-[#f8fafc] font-['Inter'] antialiased text-slate-700">
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200/60 py-4">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <a class="text-xl font-extrabold text-slate-900 tracking-tight flex items-center" href="{{ route('dashboard') }}">
                <span class="bg-blue-600 text-white p-2 rounded-xl mr-3 shadow-blue-200 shadow-lg">
                    <i class="fas fa-book-open text-sm"></i>
                </span>
                Perpus Digital
            </a>
            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition-colors flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Dashboard
            </a>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Koleksi Buku</h2>
                <p class="text-slate-500 font-medium mt-1">Temukan bacaan favorit dan bagikan ulasan Anda.</p>
            </div>
            @if(auth()->user()->role != 'peminjam')
                <a href="{{ route('buku.create') }}" class="h-12 inline-flex items-center px-6 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl shadow-lg shadow-blue-500/30 transition-all hover:-translate-y-1">
                    <i class="fas fa-plus mr-2"></i> Tambah Koleksi
                </a>
            @endif
        </div>

        @if(session('success'))
            <div class="mb-8 flex items-center p-5 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl shadow-sm animate-pulse">
                <i class="fas fa-check-circle mr-3 text-lg"></i>
                <span class="text-sm font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="bg-white border border-slate-200/60 rounded-[2rem] shadow-[0_20px_50px_rgba(0,0,0,0.02)] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-5 text-[11px] font-extrabold text-slate-400 uppercase tracking-widest">Informasi Buku</th>
                            <th class="px-6 py-5 text-[11px] font-extrabold text-slate-400 uppercase tracking-widest text-center">Tahun</th>
                            <th class="px-6 py-5 text-[11px] font-extrabold text-slate-400 uppercase tracking-widest text-center">Rating</th>
                            <th class="px-8 py-5 text-[11px] font-extrabold text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($buku as $b)
                        <tr class="group hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <div class="font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors">{{ $b->Judul }}</div>
                                <div class="text-xs font-semibold text-slate-400 mt-1 uppercase tracking-wide">{{ $b->Penulis }} • <span class="text-slate-300">{{ $b->Penerbit }}</span></div>
                            </td>
                            <td class="px-6 py-6 text-center">
                                <span class="inline-block px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded-lg">{{ $b->TahunTerbit }}</span>
                            </td>
                            <td class="px-6 py-6 text-center">
                                <div class="flex items-center justify-center text-amber-500 font-extrabold text-sm">
                                    <i class="fas fa-star mr-1.5 text-xs"></i>
                                    {{ number_format($b->ulasan()->avg('Rating'), 1) ?? '0.0' }}
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex justify-end gap-2">
                                    <button data-bs-toggle="modal" data-bs-target="#modalLihatUlasan{{ $b->BukuID }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-blue-50 hover:text-blue-600 transition-all">
                                        <i class="fas fa-eye text-sm"></i>
                                    </button>

                                    @if(auth()->user()->role == 'peminjam')
                                        <form action="{{ route('peminjam.store', $b->BukuID) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all shadow-sm shadow-emerald-200/50">
                                                <i class="fas fa-plus text-sm"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('koleksi.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="BukuID" value="{{ $b->BukuID }}">
                                            <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-100 transition-all shadow-sm shadow-rose-200/50">
                                                <i class="fas fa-heart text-sm"></i>
                                            </button>
                                        </form>

                                        <button data-bs-toggle="modal" data-bs-target="#modalTambahUlasan{{ $b->BukuID }}" class="w-10 h-10 flex items-center justify-center rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-100 transition-all shadow-sm shadow-blue-200/50">
                                            <i class="fas fa-comment-alt text-sm"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <footer class="mt-12 text-center">
            <p class="text-[10px] font-bold text-slate-300 uppercase tracking-[0.3em]">&copy; 2026 Perpus Digital • SMK Negeri 11 Malang</p>
        </footer>
    </div>

    @foreach($buku as $b)
    <div class="modal fade" id="modalLihatUlasan{{ $b->BukuID }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content !rounded-[2rem] border-none p-4 shadow-2xl">
                <div class="flex justify-between items-center p-4 border-b border-slate-50">
                    <h5 class="text-lg font-extrabold text-slate-900">Ulasan Pembaca</h5>
                    <button type="button" class="text-slate-400 hover:text-slate-600 transition-colors" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-4 overflow-y-auto max-h-[60vh]">
                    <div class="mb-6 p-4 bg-slate-50 rounded-2xl">
                        <h6 class="font-extrabold text-blue-600">{{ $b->Judul }}</h6>
                        <p class="text-xs font-bold text-slate-400 uppercase mt-1">Karya {{ $b->Penulis }}</p>
                    </div>
                    @forelse($b->ulasan as $u)
                        <div class="mb-4 last:mb-0 p-4 border border-slate-100 rounded-2xl">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-sm font-extrabold text-slate-800">{{ $u->user->NamaLengkap ?? 'Anonim' }}</span>
                                <div class="flex text-amber-400 text-[10px]">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $u->Rating ? '' : 'text-slate-200' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-sm text-slate-500 italic leading-relaxed">"{{ $u->Ulasan }}"</p>
                        </div>
                    @empty
                        <div class="text-center py-8 opacity-40">
                            <i class="fas fa-comment-slash text-3xl mb-3"></i>
                            <p class="text-xs font-bold uppercase tracking-widest">Belum ada ulasan</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahUlasan{{ $b->BukuID }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content !rounded-[2rem] border-none p-4 shadow-2xl">
                <form action="{{ route('ulasan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="BukuID" value="{{ $b->BukuID }}">
                    <div class="flex justify-between items-center p-4 border-b border-slate-50">
                        <h5 class="text-lg font-extrabold text-slate-900">Beri Ulasan</h5>
                        <button type="button" class="text-slate-400 hover:text-slate-600 transition-colors" data-bs-dismiss="modal"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="p-4 space-y-5">
                        <div class="space-y-2">
                            <label class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest ml-1">Rating</label>
                            <select name="Rating" class="w-full h-12 px-4 rounded-xl bg-slate-50 border-2 border-transparent focus:border-blue-500 focus:bg-white transition-all outline-none font-bold text-slate-700 appearance-none cursor-pointer" required>
                                <option value="5">5 - Sempurna</option>
                                <option value="4">4 - Bagus</option>
                                <option value="3" selected>3 - Cukup</option>
                                <option value="2">2 - Kurang</option>
                                <option value="1">1 - Buruk</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest ml-1">Pendapat Anda</label>
                            <textarea name="Ulasan" rows="4" class="w-full p-4 rounded-xl bg-slate-50 border-2 border-transparent focus:border-blue-500 focus:bg-white transition-all outline-none font-medium text-slate-600 placeholder:text-slate-300" required placeholder="Ceritakan pengalaman membaca Anda..."></textarea>
                        </div>
                        <button type="submit" class="w-full h-14 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-2xl shadow-lg shadow-blue-500/30 transition-all hover:-translate-y-1">
                            Kirim Ulasan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>