<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    body { 
        font-family: 'Inter', sans-serif; 
        background: radial-gradient(circle at top right, #f8fafc, #eff6ff);
        min-height: 100vh;
    }
    .glass-card { 
        background: rgba(255, 255, 255, 0.7); 
        backdrop-filter: blur(12px); 
        border: 1px solid rgba(255, 255, 255, 0.4); 
    }
</style>

<div class="max-w-md mx-auto px-6 py-12">
    <div class="text-center mb-8 group">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-[2rem] shadow-xl shadow-blue-100 mb-4 transition-transform group-hover:scale-110 duration-500">
            <i class="fas fa-shield-halved text-2xl text-blue-600"></i>
        </div>
        <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Otoritas <span class="text-blue-600">Sistem</span></h2>
        <p class="text-slate-500 text-sm font-medium mt-1">Konfigurasi akses keamanan perpustakaan</p>
    </div>

    <div class="glass-card rounded-[2.5rem] shadow-2xl shadow-blue-100/50 p-8 md:p-10">
        <div class="mb-8">
            <h3 class="text-xl font-bold text-slate-800">
                {{ isset($petugas) ? 'Perbarui Profil' : 'Registrasi Staff' }}
            </h3>
            <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest mt-1">Informasi Kredensial Akun</p>
        </div>

        <form action="{{ isset($petugas) ? route('petugas.update', $petugas->UserID) : route('petugas.store') }}" method="POST" class="space-y-5">
            @csrf
            @if(isset($petugas)) @method('PUT') @endif

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 ml-1">Username Unik</label>
                <div class="relative flex items-center">
                    <i class="fas fa-at absolute left-4 text-slate-300 text-sm"></i>
                    <input type="text" name="Username" value="{{ $petugas->Username ?? old('Username') }}" 
                        class="w-full h-14 pl-11 pr-4 rounded-2xl bg-white/50 border-2 border-slate-100 focus:border-blue-500 focus:bg-white transition-all outline-none font-semibold text-slate-700 placeholder:text-slate-300 shadow-sm"
                        placeholder="revandev" required>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 ml-1">Surel Institusi</label>
                <div class="relative flex items-center">
                    <i class="fas fa-envelope absolute left-4 text-slate-300 text-sm"></i>
                    <input type="email" name="Email" value="{{ $petugas->Email ?? old('Email') }}" 
                        class="w-full h-14 pl-11 pr-4 rounded-2xl bg-white/50 border-2 border-slate-100 focus:border-blue-500 focus:bg-white transition-all outline-none font-semibold text-slate-700 placeholder:text-slate-300 shadow-sm"
                        placeholder="nama@perpus.id" required>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 ml-1">Identitas Lengkap</label>
                <div class="relative flex items-center">
                    <i class="fas fa-user-tag absolute left-4 text-slate-300 text-sm"></i>
                    <input type="text" name="NamaLengkap" value="{{ $petugas->NamaLengkap ?? old('NamaLengkap') }}" 
                        class="w-full h-14 pl-11 pr-4 rounded-2xl bg-white/50 border-2 border-slate-100 focus:border-blue-500 focus:bg-white transition-all outline-none font-semibold text-slate-700 placeholder:text-slate-300 shadow-sm"
                        placeholder="Nama asli staff" required>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 ml-1">Kata Sandi {{ isset($petugas) ? '(Opsi)' : '' }}</label>
                <div class="relative flex items-center">
                    <i class="fas fa-lock absolute left-4 text-slate-300 text-sm"></i>
                    <input type="password" name="Password" 
                        class="w-full h-14 pl-11 pr-4 rounded-2xl bg-white/50 border-2 border-slate-100 focus:border-blue-500 focus:bg-white transition-all outline-none font-semibold text-slate-700 placeholder:text-slate-300 shadow-sm"
                        placeholder="{{ isset($petugas) ? 'Biarkan kosong jika tetap' : 'Min. 6 karakter' }}" {{ isset($petugas) ? '' : 'required' }}>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold text-slate-500 ml-1">Level Otoritas</label>
                <div class="relative flex items-center">
                    <i class="fas fa-user-shield absolute left-4 text-slate-300 text-sm"></i>
                    <select name="role" class="w-full h-14 pl-11 pr-4 rounded-2xl bg-white/50 border-2 border-slate-100 focus:border-blue-500 focus:bg-white transition-all outline-none font-bold text-slate-600 appearance-none shadow-sm cursor-pointer" required>
                        <option value="petugas" {{ (isset($petugas) && $petugas->role == 'petugas') ? 'selected' : '' }}>Staff Petugas</option>
                        <option value="administrator" {{ (isset($petugas) && $petugas->role == 'administrator') ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 space-y-4">
                <button type="submit" class="w-full h-14 bg-blue-600 hover:bg-blue-700 text-white rounded-[1.25rem] font-bold shadow-xl shadow-blue-100 hover:shadow-blue-200 transition-all active:scale-[0.98]">
                    {{ isset($petugas) ? 'Simpan Perubahan' : 'Finalisasi Pendaftaran' }}
                </button>
                <a href="{{ route('petugas.index') }}" class="flex items-center justify-center gap-2 text-slate-400 hover:text-blue-600 font-bold text-sm transition-colors py-2">
                    <i class="fas fa-arrow-left text-[10px]"></i> Batal dan Kembali
                </a>
            </div>
        </form>
    </div>
    
    <p class="text-center mt-10 text-slate-400 text-[11px] font-bold uppercase tracking-[0.2em]">&copy; 2026 Digital Library Engine</p>
</div>