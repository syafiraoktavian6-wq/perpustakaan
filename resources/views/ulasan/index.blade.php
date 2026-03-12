<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body class="bg-[#f8fafc] font-['Inter'] antialiased text-slate-700 min-h-screen bg-[radial-gradient(circle_at_top_right,_#e0e7ff_0%,_transparent_25%)]">
    <div class="max-w-6xl mx-auto px-6 py-12">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
            <div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight flex items-center gap-3">
                    <span class="p-3 bg-blue-600 rounded-2xl text-white shadow-lg shadow-blue-200">
                        <i class="fas fa-star text-sm"></i>
                    </span>
                    Ulasan Pembaca
                </h2>
                <p class="text-slate-500 font-medium mt-2">Apa yang mereka katakan tentang koleksi buku kami.</p>
            </div>
            <a href="{{ route('buku.index') }}" class="h-12 px-6 flex items-center gap-2 rounded-xl bg-white border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition-all active:scale-95 shadow-sm">
                <i class="fas fa-arrow-left text-[10px]"></i> KEMBALI
            </a>
        </div>

        <div class="bg-white/70 backdrop-blur-xl border border-white rounded-[2.5rem] shadow-sm overflow-hidden p-2">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest border-b border-slate-100">
                            <th class="px-8 py-5 w-20 text-center">No</th>
                            <th class="px-6 py-5">Identitas & Buku</th>
                            <th class="px-6 py-5">Testimoni</th>
                            <th class="px-6 py-5 text-center">Apresiasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($ulasan as $key => $u)
                        <tr class="hover:bg-blue-50/40 transition-colors group">
                            <td class="px-8 py-6 text-center font-bold text-slate-300 group-hover:text-blue-400 transition-colors">{{ $key + 1 }}</td>
                            <td class="px-6 py-6">
                                <div class="font-bold text-slate-900">{{ $u->user->NamaLengkap }}</div>
                                <div class="mt-1 inline-flex items-center px-2 py-0.5 rounded-md bg-blue-50 text-blue-600 text-[10px] font-bold border border-blue-100">
                                    {{ $u->buku->Judul }}
                                </div>
                            </td>
                            <td class="px-6 py-6 italic text-sm text-slate-600 font-medium leading-relaxed">
                                "{{ $u->Ulasan }}"
                            </td>
                            <td class="px-6 py-6 text-center">
                                <div class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-amber-50 text-amber-600 text-xs font-black border border-amber-100 shadow-sm">
                                    <i class="fas fa-star"></i> {{ $u->Rating }}
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="text-slate-200 mb-4"><i class="fas fa-comment-slash fa-4x"></i></div>
                                <p class="text-slate-400 font-bold tracking-tight">Belum ada diskusi atau ulasan tersedia.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>