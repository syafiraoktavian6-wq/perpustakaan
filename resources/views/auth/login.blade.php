<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body class="bg-[#f8fafc] font-['Inter'] antialiased text-slate-700 min-h-screen flex items-center justify-center p-4 bg-[radial-gradient(circle_at_top_right,_#e0e7ff_0%,_transparent_25%)]">
    <div class="w-full max-w-[420px]">
        
        <div class="text-center mb-8">
            <h4 class="text-2xl font-extrabold tracking-tight text-slate-900 flex items-center justify-center gap-2">
                <i class="fas fa-book-reader text-blue-600"></i>
                Perpus<span class="text-blue-600">Digital</span>
            </h4>
        </div>

        <div class="bg-white/70 backdrop-blur-xl border border-white rounded-[2.5rem] shadow-[0_25px_50px_-12px_rgba(0,0,0,0.06)] overflow-hidden">
            <div class="p-8 sm:p-12">
                
                <header class="text-center mb-10">
                    <div class="w-16 h-16 bg-blue-600/10 text-blue-600 rounded-2xl mx-auto mb-6 flex items-center justify-center shadow-inner">
                        <i class="fas fa-fingerprint text-3xl"></i>
                    </div>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Selamat Datang</h2>
                    <p class="text-slate-500 font-medium text-sm mt-1">Akses akun petugas Anda</p>
                </header>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-xl border border-emerald-100 text-center animate-fade-in">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->has('loginError'))
                    <div class="mb-6 p-4 bg-rose-50 text-rose-700 text-xs font-bold rounded-xl border border-rose-100 text-center">
                        {{ $errors->first('loginError') }}
                    </div>
                @endif

                <form action="/login" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="space-y-2">
                        <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest ml-1">Username</label>
                        <input type="text" name="Username" placeholder="ID Pengguna" required autofocus
                            class="w-full h-14 px-6 rounded-2xl bg-white border-2 border-slate-100 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all outline-none font-medium placeholder:text-slate-300">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-extrabold text-slate-400 uppercase tracking-widest ml-1">Password</label>
                        <input type="password" name="Password" placeholder="••••••••" required
                            class="w-full h-14 px-6 rounded-2xl bg-white border-2 border-slate-100 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 transition-all outline-none font-medium">
                    </div>

                    <button type="submit" 
                        class="w-full h-14 bg-blue-600 hover:bg-blue-700 text-white font-extrabold rounded-2xl shadow-lg shadow-blue-500/30 transform hover:-translate-y-1 transition-all flex items-center justify-center gap-3 active:scale-95">
                        Masuk Sekarang <i class="fas fa-arrow-right text-xs opacity-70"></i>
                    </button>
                </form>

                <footer class="mt-10 text-center">
                    <p class="text-sm font-medium text-slate-400">
                        Belum memiliki akses? 
                        <a href="/register" class="text-blue-600 font-bold hover:underline ml-1">Buat Akun</a>
                    </p>
                </footer>
            </div>
        </div>

        <footer class="text-center mt-12">
            <p class="text-[11px] font-bold text-slate-300 uppercase tracking-[0.2em]">
                &copy; 2026 UKK RPL &bull; SMKN 11 Malang
            </p>
        </footer>
    </div>
</body>