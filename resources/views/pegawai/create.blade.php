@extends('layouts.app')

@section('page-title', 'Tambah Pegawai')
@section('page-subtitle', 'Masukkan data pegawai baru')

@section('content')
<div class="flex justify-center">
    <div class="w-full max-w-3xl">
        <div class="bg-white border border-border rounded-xl hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] transition-all duration-200 overflow-hidden">
            <div class="flex items-center gap-2 px-6 py-5 border-b border-border">
                <i class="fas fa-user-plus text-primary"></i>
                <h5 class="font-display text-base font-semibold text-text-primary">Form Tambah Pegawai</h5>
            </div>
            <div class="p-6">
                @if ($errors->any())
                    <div class="flex items-start gap-2.5 px-5 py-3.5 rounded-lg bg-red-50 text-error border border-red-200 text-sm mb-4 animate-slideDown">
                        <i class="fas fa-exclamation-circle mt-0.5"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form action="{{ route('pegawai.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nip" class="block text-[13px] font-semibold text-text-secondary mb-1.5">NIP</label>
                            <input type="text" id="nip" name="nip" value="{{ old('nip') }}" placeholder="Masukkan NIP" required class="w-full px-4 py-3 bg-white border border-border rounded-md text-sm text-text-primary focus:border-primary focus:ring-[3px] focus:ring-primary/10 outline-none transition-all">
                        </div>
                        <div>
                            <label for="nama" class="block text-[13px] font-semibold text-text-secondary mb-1.5">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required class="w-full px-4 py-3 bg-white border border-border rounded-md text-sm text-text-primary focus:border-primary focus:ring-[3px] focus:ring-primary/10 outline-none transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-[13px] font-semibold text-text-secondary mb-1.5">Jenis Kelamin</label>
                            <div class="flex gap-6 mt-1">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" id="jkL" value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required class="w-4 h-4 accent-primary">
                                    <span class="text-sm text-text-primary">Laki-laki</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" id="jkP" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} required class="w-4 h-4 accent-primary">
                                    <span class="text-sm text-text-primary">Perempuan</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label for="tanggal_lahir" class="block text-[13px] font-semibold text-text-secondary mb-1.5">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="w-full px-4 py-3 bg-white border border-border rounded-md text-sm text-text-primary focus:border-primary focus:ring-[3px] focus:ring-primary/10 outline-none transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label for="pendidikan_terakhir" class="block text-[13px] font-semibold text-text-secondary mb-1.5">Pendidikan Terakhir</label>
                            <select id="pendidikan_terakhir" name="pendidikan_terakhir" required class="w-full px-4 py-3 bg-white border border-border rounded-md text-sm text-text-primary focus:border-primary focus:ring-[3px] focus:ring-primary/10 outline-none transition-all">
                                <option value="">Pilih Pendidikan...</option>
                                @foreach(['SMA/SMK', 'D3', 'S1', 'S2', 'S3'] as $edu)
                                    <option value="{{ $edu }}" {{ old('pendidikan_terakhir') == $edu ? 'selected' : '' }}>{{ $edu }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="jabatan" class="block text-[13px] font-semibold text-text-secondary mb-1.5">Jabatan</label>
                            <input type="text" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" placeholder="Masukkan jabatan" required class="w-full px-4 py-3 bg-white border border-border rounded-md text-sm text-text-primary focus:border-primary focus:ring-[3px] focus:ring-primary/10 outline-none transition-all">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="alamat" class="block text-[13px] font-semibold text-text-secondary mb-1.5">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required class="w-full px-4 py-3 bg-white border border-border rounded-md text-sm text-text-primary focus:border-primary focus:ring-[3px] focus:ring-primary/10 outline-none transition-all resize-y">{{ old('alamat') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2 mt-6 pt-4 border-t border-border">
                        <a href="{{ route('pegawai.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-transparent text-text-secondary border border-border rounded-md font-medium text-sm no-underline transition-all hover:bg-gray-50">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-md font-medium text-sm border-none cursor-pointer transition-all duration-200 hover:-translate-y-px hover:shadow-[0_4px_12px_rgba(99,102,241,0.35)]">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
