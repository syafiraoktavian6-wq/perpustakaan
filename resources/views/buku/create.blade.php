<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body class="bg-[#f8fafc] font-['Inter'] antialiased text-slate-700">
    <div class="min-h-screen py-12 px-4 flex flex-col items-center justify-center">
        
        <div class="w-full max-w-2xl">
            <a href="{{ route('buku.index') }}" class="inline-flex items-center text-sm font-bold text-slate-400 hover:text-blue-600 transition-colors mb-6 group">
                <i class="fas fa-chevron-left mr-2 transform group-hover:-translate-x-1 transition-transform"></i> Kembali ke Koleksi
            </a>

            <div class="bg-white/80 backdrop-blur-xl border border-white shadow-[0_20px_50px_rgba(0,0,0,0.05)] rounded-[2rem] overflow-hidden">
                <div class="p-8 sm:p-12">
                    
                    <header class="mb-10 text-center sm:text-left">
                        <h4 class="text-2xl font-extrabold text-slate-900 tracking-tight mb-2">
                            <span class="bg-blue-100 text-blue-600 p-2 rounded-xl mr-2 inline-flex items-center justify-center">
                                <i class="fas fa-plus-circle text-lg"></i>
                            </span>
                            Tambah Koleksi Buku
                        </h4>
                        <p class="text-slate-500 font-medium">Lengkapi detail informasi buku di bawah ini.</p>
                    </header>

                    <form action="{{ route('buku.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest ml-1">Judul Buku</label>
                                <input type="text" name="Judul" placeholder="Laskar Pelangi" required
                                    class="w-full h-14 px-5 rounded-2xl bg-slate-50 border-2 border-slate-100 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all outline-none">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest ml-1">Nama Penulis</label>
                                <input type="text" name="Penulis" placeholder="Nama pengarang" required
                                    class="w-full h-14 px-5 rounded-2xl bg-slate-50 border-2 border-slate-100 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all outline-none">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest ml-1">Penerbit</label>
                                <input type="text" name="Penerbit" placeholder="Nama perusahaan" required
                                    class="w-full h-14 px-5 rounded-2xl bg-slate-50 border-2 border-slate-100 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all outline-none">
                            </div>

                            <div class="space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest ml-1">Tahun Terbit</label>
                                <input type="number" name="TahunTerbit" placeholder="2024" required
                                    class="w-full h-14 px-5 rounded-2xl bg-slate-50 border-2 border-slate-100 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all outline-none">
                            </div>

                            <div class="md:col-span-2 space-y-2">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-widest ml-1">Kategori Buku</label>
                                <select name="KategoriID" required
                                    class="w-full h-14 px-5 rounded-2xl bg-slate-50 border-2 border-slate-100 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10 transition-all outline-none appearance-none cursor-pointer">
                                    <option value="" selected disabled>Pilih kategori...</option>
                                    @foreach($kategori as $k)
                                        <option value="{{ $k->KategoriID }}">{{ $k->NamaKategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <a href="{{ route('buku.index') }}" 
                                class="w-full sm:w-auto px-8 h-14 flex items-center justify-center font-bold text-slate-500 hover:bg-slate-100 rounded-2xl transition-all">
                                Batal
                            </a>
                            <button type="submit" 
                                class="w-full sm:w-auto px-10 h-14 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl shadow-lg shadow-blue-500/30 hover:shadow-blue-500/40 transform hover:-translate-y-1 transition-all flex items-center justify-center gap-2">
                                Simpan Koleksi <i class="fas fa-check-circle"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <footer class="text-center mt-10">
                <p class="text-slate-400 text-xs font-medium tracking-wide opacity-70 uppercase">&copy; 2026 UKK RPL SMKN 11 Malang</p>
            </footer>
        </div>
    </div>
</body>