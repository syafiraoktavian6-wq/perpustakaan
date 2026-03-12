<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body class="bg-[#f8fafc] font-['Inter'] antialiased text-slate-800">
    <div class="min-h-screen py-12 px-4 flex items-center justify-center bg-[radial-gradient(circle_at_top_right,_#fffbeb_0%,_transparent_25%)]">
        <div class="w-full max-w-2xl">
            
            <div class="mb-6 flex justify-between items-center px-2">
                <a href="{{ route('buku.index') }}" class="group text-sm font-bold text-slate-400 hover:text-amber-600 transition-colors">
                    <i class="fas fa-arrow-left mr-2 transition-transform group-hover:-translate-x-1"></i> Kembali
                </a>
                <span class="bg-white/60 backdrop-blur-md border border-white text-slate-500 px-4 py-1.5 rounded-full text-[11px] font-bold shadow-sm">
                    ID BUKU: #{{ $buku->BukuID }}
                </span>
            </div>

            <div class="bg-white/70 backdrop-blur-2xl border border-white shadow-[0_20px_50px_rgba(0,0,0,0.04)] rounded-[2.5rem] overflow-hidden">
                <div class="p-8 sm:p-12">
                    
                    <header class="mb-10 flex items-center gap-5">
                        <div class="h-14 w-14 bg-amber-100 rounded-2xl flex items-center justify-center text-amber-600 shadow-inner">
                            <i class="fas fa-edit text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-2xl font-extrabold tracking-tight text-slate-900">Edit Informasi</h4>
                            <p class="text-slate-500 text-sm font-medium leading-relaxed">Perbarui data buku untuk menjaga akurasi katalog.</p>
                        </div>
                    </header>

                    <form action="{{ route('buku.update', $buku->BukuID) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="space-y-2">
                            <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-[0.1em] ml-1">Judul Buku</label>
                            <input type="text" name="Judul" value="{{ $buku->Judul }}" required
                                class="w-full h-14 px-6 rounded-2xl bg-white border-2 border-slate-100 focus:border-amber-400 focus:ring-4 focus:ring-amber-400/10 transition-all outline-none font-medium">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-[0.1em] ml-1">Penulis</label>
                                <input type="text" name="Penulis" value="{{ $buku->Penulis }}" required
                                    class="w-full h-14 px-6 rounded-2xl bg-white border-2 border-slate-100 focus:border-amber-400 focus:ring-4 focus:ring-amber-400/10 transition-all outline-none font-medium">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-[0.1em] ml-1">Penerbit</label>
                                <input type="text" name="Penerbit" value="{{ $buku->Penerbit }}" required
                                    class="w-full h-14 px-6 rounded-2xl bg-white border-2 border-slate-100 focus:border-amber-400 focus:ring-4 focus:ring-amber-400/10 transition-all outline-none font-medium">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-[0.1em] ml-1">Tahun Terbit</label>
                                <input type="number" name="TahunTerbit" value="{{ $buku->TahunTerbit }}" required
                                    class="w-full h-14 px-6 rounded-2xl bg-white border-2 border-slate-100 focus:border-amber-400 focus:ring-4 focus:ring-amber-400/10 transition-all outline-none font-medium">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-[0.1em] ml-1">Kategori Buku</label>
                                <div class="relative group">
                                    <select name="KategoriID" required
                                        class="w-full h-14 px-6 rounded-2xl bg-white border-2 border-slate-100 focus:border-amber-400 focus:ring-4 focus:ring-amber-400/10 transition-all outline-none font-medium appearance-none cursor-pointer">
                                        @foreach($kategori as $k)
                                            <option value="{{ $k->KategoriID }}" {{ $buku->KategoriID == $k->KategoriID ? 'selected' : '' }}>
                                                {{ $k->NamaKategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="fas fa-chevron-down absolute right-6 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs group-hover:text-amber-500 transition-colors"></i>
                                </div>
                            </div>
                        </div>

                        <div class="pt-10 flex items-center justify-between border-t border-slate-100">
                            <a href="{{ route('buku.index') }}" class="text-sm font-bold text-slate-400 hover:text-slate-600 transition-all">Batalkan</a>
                            <button type="submit" 
                                class="h-14 px-10 bg-amber-500 hover:bg-amber-600 text-amber-950 font-extrabold rounded-2xl shadow-xl shadow-amber-500/20 transform hover:-translate-y-1 active:scale-95 transition-all flex items-center gap-3">
                                Simpan Perubahan <i class="fas fa-save opacity-50"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <footer class="mt-10 text-center">
                <p class="text-[11px] font-bold text-slate-300 uppercase tracking-[0.2em]">&copy; 2026 Perpus Digital &bull; SMKN 11 Malang</p>
            </footer>
        </div>
    </div>
</body>