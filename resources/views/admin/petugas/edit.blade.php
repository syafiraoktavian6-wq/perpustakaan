<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body { font-family: 'Inter', sans-serif; background: radial-gradient(circle at top right, #fffbeb, #f8fafc); min-height: 100vh; }
    .glass-card { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.4); }
</style>

<div class="max-w-md mx-auto px-6 py-16">
    <div class="glass-card rounded-[2.5rem] shadow-2xl shadow-orange-100/50 p-8 md:p-10 relative overflow-hidden">
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-amber-100/50 rounded-full blur-3xl"></div>
        
        <div class="relative">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 bg-amber-400 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-amber-200">
                    <i class="fas fa-user-pen text-xl"></i>
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-slate-800 tracking-tight">Profil Staf</h2>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Update Kredensial</p>
                </div>
            </div>

            <form action="{{ route('petugas.update', $petugas->UserID) }}" method="POST" class="space-y-5">
                @csrf @method('PUT')

                <div class="space-y-2">
                    <label class="text-[11px] font-extrabold text-slate-400 uppercase ml-1">Username</label>
                    <div class="relative flex items-center group">
                        <i class="fas fa-at absolute left-4 text-slate-300 group-focus-within:text-amber-500 transition-colors"></i>
                        <input type="text" name="Username" value="{{ $petugas->Username }}" class="w-full h-14 pl-11 pr-4 rounded-2xl bg-white border-2 border-slate-50 focus:border-amber-400 outline-none font-bold text-slate-700 shadow-sm transition-all" required>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-extrabold text-slate-400 uppercase ml-1">Alamat Email</label>
                    <div class="relative flex items-center group">
                        <i class="fas fa-envelope absolute left-4 text-slate-300 group-focus-within:text-amber-500 transition-colors"></i>
                        <input type="email" name="Email" value="{{ $petugas->Email }}" class="w-full h-14 pl-11 pr-4 rounded-2xl bg-white border-2 border-slate-50 focus:border-amber-400 outline-none font-bold text-slate-700 shadow-sm transition-all" required>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-extrabold text-slate-400 uppercase ml-1">Kata Sandi Baru</label>
                    <div class="relative flex items-center group">
                        <i class="fas fa-key absolute left-4 text-slate-300 group-focus-within:text-amber-500 transition-colors"></i>
                        <input type="password" name="Password" placeholder="Biarkan kosong jika tidak diganti" class="w-full h-14 pl-11 pr-4 rounded-2xl bg-white border-2 border-slate-50 focus:border-amber-400 outline-none font-bold text-slate-700 shadow-sm transition-all">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-extrabold text-slate-400 uppercase ml-1">Level Akses</label>
                    <div class="relative flex items-center group">
                        <i class="fas fa-shield-halved absolute left-4 text-slate-300 group-focus-within:text-amber-500 transition-colors"></i>
                        <select name="role" class="w-full h-14 pl-11 pr-4 rounded-2xl bg-white border-2 border-slate-50 focus:border-amber-400 outline-none font-bold text-slate-600 appearance-none shadow-sm cursor-pointer" required>
                            <option value="petugas" {{ $petugas->role == 'petugas' ? 'selected' : '' }}>Staf Perpustakaan</option>
                            <option value="administrator" {{ $petugas->role == 'administrator' ? 'selected' : '' }}>Administrator Utama</option>
                        </select>
                    </div>
                </div>

                <div class="pt-6 space-y-4">
                    <button type="submit" class="w-full h-14 bg-amber-400 hover:bg-amber-500 text-white rounded-[1.25rem] font-black shadow-xl shadow-amber-100 transition-all active:scale-95 uppercase tracking-widest text-xs">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('petugas.index') }}" class="flex items-center justify-center gap-2 text-slate-400 hover:text-amber-600 font-bold text-sm transition-colors py-2">
                        Batal dan Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>