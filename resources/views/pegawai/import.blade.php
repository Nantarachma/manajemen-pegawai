@extends('layouts.app')

@section('page-title', 'Import Data')
@section('page-subtitle', 'Unggah file CSV untuk import data pegawai')

@section('content')
<div class="flex justify-center">
    <div class="w-full max-w-2xl">
        <div class="bg-white border border-border rounded-xl hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] transition-all duration-200 overflow-hidden">
            <div class="flex items-center gap-2 px-6 py-5 border-b border-border">
                <i class="fas fa-file-import text-primary"></i>
                <h5 class="font-display text-base font-semibold text-text-primary">Import Data Pegawai dari CSV</h5>
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

                <div class="mb-5 p-4 bg-primary-wash rounded-lg border border-primary/10">
                    <h6 class="text-primary text-sm font-semibold mb-2">
                        <i class="fas fa-info-circle mr-1"></i> Format CSV yang Diterima
                    </h6>
                    <p class="text-[13px] text-text-secondary mb-2">
                        File CSV harus memiliki header dan kolom sesuai urutan berikut:
                    </p>
                    <code class="font-mono text-xs block px-3 py-2 bg-white rounded-md text-primary">
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
                        <input type="file" id="csv_file" name="csv_file" accept=".csv,.txt" required class="w-full px-4 py-3 bg-white border border-border rounded-md text-sm text-text-primary file:mr-4 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-primary-wash file:text-primary hover:file:bg-primary-pale transition-all">
                        <div class="text-xs text-text-muted mt-1.5">Maksimal 2MB. Format: .csv</div>
                    </div>

                    <div class="flex justify-end gap-2 pt-4 border-t border-border">
                        <a href="{{ route('pegawai.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-transparent text-text-secondary border border-border rounded-md font-medium text-sm no-underline transition-all hover:bg-gray-50">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-md font-medium text-sm border-none cursor-pointer transition-all duration-200 hover:-translate-y-px hover:shadow-[0_4px_12px_rgba(99,102,241,0.35)]">
                            <i class="fas fa-upload"></i> Import Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
