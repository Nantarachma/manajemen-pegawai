@extends('layouts.app')

@section('page-title', 'Profil Admin')
@section('page-subtitle', 'Kelola informasi akun dan keamanan Anda')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
    <div class="bg-white border border-border rounded-2xl shadow-sm hover:shadow-md transition-shadow overflow-hidden">
        <div class="flex items-center gap-2 px-6 py-5 border-b border-border">
            <i class="fas fa-user text-ocean-mid"></i>
            <h5 class="text-base font-semibold text-text-primary">Informasi Akun</h5>
        </div>
        <div class="p-6">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-[13px] font-semibold text-text-secondary mb-1.5">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-3 bg-bg border-[1.5px] border-border rounded-[10px] text-sm text-text-primary focus:border-ocean-mid focus:ring-2 focus:ring-ocean-mid/10 focus:bg-white outline-none transition-all">
                    @error('name') <div class="text-[13px] text-red-600 mt-1">{{ $message }}</div> @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-[13px] font-semibold text-text-secondary mb-1.5">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-3 bg-bg border-[1.5px] border-border rounded-[10px] text-sm text-text-primary focus:border-ocean-mid focus:ring-2 focus:ring-ocean-mid/10 focus:bg-white outline-none transition-all">
                    @error('email') <div class="text-[13px] text-red-600 mt-1">{{ $message }}</div> @enderror
                </div>
                <div class="flex justify-end pt-4 border-t border-border">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-ocean-dark to-ocean-mid text-white rounded-[10px] font-semibold text-sm border-none cursor-pointer transition-all hover:-translate-y-0.5 hover:shadow-[0_6px_20px_rgba(0,119,182,0.3)]">
                        <i class="fas fa-save"></i> Simpan Profil
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="bg-white border border-border rounded-2xl shadow-sm hover:shadow-md transition-shadow overflow-hidden">
        <div class="flex items-center gap-2 px-6 py-5 border-b border-border">
            <i class="fas fa-lock text-ocean-mid"></i>
            <h5 class="text-base font-semibold text-text-primary">Ubah Password</h5>
        </div>
        <div class="p-6">
            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="current_password" class="block text-[13px] font-semibold text-text-secondary mb-1.5">Password Saat Ini</label>
                    <input type="password" id="current_password" name="current_password" required class="w-full px-4 py-3 bg-bg border-[1.5px] border-border rounded-[10px] text-sm text-text-primary focus:border-ocean-mid focus:ring-2 focus:ring-ocean-mid/10 focus:bg-white outline-none transition-all">
                    @error('current_password') <div class="text-[13px] text-red-600 mt-1">{{ $message }}</div> @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-[13px] font-semibold text-text-secondary mb-1.5">Password Baru</label>
                    <input type="password" id="password" name="password" required class="w-full px-4 py-3 bg-bg border-[1.5px] border-border rounded-[10px] text-sm text-text-primary focus:border-ocean-mid focus:ring-2 focus:ring-ocean-mid/10 focus:bg-white outline-none transition-all">
                    @error('password') <div class="text-[13px] text-red-600 mt-1">{{ $message }}</div> @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-[13px] font-semibold text-text-secondary mb-1.5">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full px-4 py-3 bg-bg border-[1.5px] border-border rounded-[10px] text-sm text-text-primary focus:border-ocean-mid focus:ring-2 focus:ring-ocean-mid/10 focus:bg-white outline-none transition-all">
                </div>
                <div class="flex justify-end pt-4 border-t border-border">
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-ocean-dark to-ocean-mid text-white rounded-[10px] font-semibold text-sm border-none cursor-pointer transition-all hover:-translate-y-0.5 hover:shadow-[0_6px_20px_rgba(0,119,182,0.3)]">
                        <i class="fas fa-key"></i> Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
