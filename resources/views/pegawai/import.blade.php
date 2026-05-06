@extends('layouts.app')

@section('page-title', 'Import Data')
@section('page-subtitle', 'Unggah file CSV untuk import data pegawai')

@section('content')
<div class="flex justify-center">
    <div class="w-full max-w-2xl">
        <div class="bg-white border border-border rounded-2xl shadow-sm hover:shadow-md transition-shadow overflow-hidden">
            <div class="flex items-center gap-2 px-6 py-5 border-b border-border">
                <i class="fas fa-file-import text-ocean-mid"></i>
                <h5 class="text-base font-semibold text-text-primary">Import Data Pegawai dari CSV</h5>
            </div>
            <div class="p-6">
                @if ($errors->any())
                    <div class="flex items-start gap-2.5 px-5 py-3.5 rounded-[10px] bg-red-50 text-red-600 border border-red-200 text-sm mb-4 animate-slideDown">
                        <i class="fas fa-exclamation-circle mt-0.5"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mb-5 p-4 bg-ocean-wash rounded-[10px] border border-ocean-mid/15">
                    <h6 class="text-ocean-dark text-sm font-semibold mb-2">
                        <i class="fas fa-info-circle mr-1"></i> Format CSV yang Diterima
                    </h6>
                    <p class="text-[13px] text-text-secondary mb-2">
                        File CSV harus memiliki header dan kolom sesuai urutan berikut:
                    </p>
                    <code class="text-xs block px-3 py-2 bg-white rounded-lg text-ocean-dark">
                        No, NIP, Nama, Jenis Kelamin, Tanggal Lahir, Pendidikan Terakhir, Jabatan, Alamat
                    </code>
                    <p class="text-xs text-text-muted mt-2">
                        <strong>Tips:</strong> Export data terlebih dahulu untuk mendapatkan template CSV yang benar.
                    </p>
                </div>

                <form action="{{ route('pegawai.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5">
                        <label for="csv_file" class="block text-[13px] font-semibold text-text-secondary mb-1.5">Pilih File CSV</label>
                        <input type="file" id="csv_file" name="csv_file" accept=".csv,.txt" required class="w-full px-4 py-3 bg-bg border-[1.5px] border-border rounded-[10px] text-sm text-text-primary file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-ocean-wash file:text-ocean-dark hover:file:bg-ocean-pale transition-all">
                        <div class="text-xs text-text-muted mt-1.5">Maksimal 2MB. Format: .csv</div>
                    </div>

                    <div class="flex justify-end gap-2 pt-4 border-t border-border">
                        <a href="{{ route('pegawai.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-text-secondary border-[1.5px] border-border rounded-[10px] font-medium text-sm no-underline transition-all hover:bg-gray-50">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-ocean-dark to-ocean-mid text-white rounded-[10px] font-semibold text-sm border-none cursor-pointer transition-all hover:-translate-y-0.5 hover:shadow-[0_6px_20px_rgba(0,119,182,0.3)]">
                            <i class="fas fa-upload"></i> Import Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
