@extends('layouts.app')

@section('page-title', 'Export Data')
@section('page-subtitle', 'Preview data sebelum diexport ke CSV')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-12 gap-4 mb-4">
    <div class="md:col-span-4">
        <div class="bg-white border border-border rounded-2xl p-6 shadow-sm transition-all hover:-translate-y-0.5 hover:shadow-lg relative overflow-hidden">
            <div class="w-12 h-12 rounded-[14px] flex items-center justify-center text-xl mb-4 bg-gradient-to-br from-ocean-dark to-ocean-mid text-white">
                <i class="fas fa-file-csv"></i>
            </div>
            <h3 class="text-3xl font-extrabold text-text-primary tracking-tight">{{ $totalData }}</h3>
            <p class="text-[13px] text-text-muted font-medium mt-1">Total Data Akan Diexport</p>
        </div>
    </div>
    <div class="md:col-span-8 flex items-center">
        <div class="w-full p-4 bg-ocean-wash rounded-[10px] border border-ocean-mid/15">
            <h6 class="text-ocean-dark text-sm font-semibold mb-1.5">
                <i class="fas fa-info-circle mr-1"></i> Informasi Export
            </h6>
            <p class="text-[13px] text-text-secondary leading-relaxed">
                File CSV akan berisi seluruh data pegawai yang tampil di bawah ini. Format file mendukung Excel dan aplikasi spreadsheet lainnya. Data diurutkan berdasarkan nama pegawai secara alfabet.
            </p>
        </div>
    </div>
</div>

<div class="bg-white border border-border rounded-2xl shadow-sm hover:shadow-md transition-shadow overflow-hidden">
    <div class="flex justify-between items-center px-6 py-5 border-b border-border">
        <h5 class="text-base font-semibold text-text-primary"><i class="fas fa-eye mr-2 text-ocean-mid"></i>Preview Data</h5>
        <button type="button" id="btnExport" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-ocean-dark to-ocean-mid text-white rounded-[10px] font-semibold text-sm border-none cursor-pointer transition-all hover:-translate-y-0.5 hover:shadow-[0_6px_20px_rgba(0,119,182,0.3)]">
            <i class="fas fa-download"></i> Export CSV
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full border-separate border-spacing-0">
            <thead>
                <tr>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left pl-6">No</th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left">NIP</th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left">Nama</th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left">Jenis Kelamin</th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left">Tanggal Lahir</th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left">Pendidikan</th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left">Jabatan</th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left pr-6">Alamat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pegawais as $key => $pegawai)
                    <tr class="table-row-hover transition-colors">
                        <td class="px-4 py-4 text-sm border-b border-border align-middle pl-6">{{ $key + 1 }}</td>
                        <td class="px-4 py-4 text-sm border-b border-border align-middle"><code class="text-[13px] text-ocean-dark">{{ $pegawai->nip }}</code></td>
                        <td class="px-4 py-4 text-sm border-b border-border align-middle font-semibold">{{ $pegawai->nama }}</td>
                        <td class="px-4 py-4 text-sm border-b border-border align-middle">
                            @if($pegawai->jenis_kelamin == 'Laki-laki')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-ocean-wash text-ocean-dark"><i class="fas fa-mars"></i>L</span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-pink-100 text-pink-600"><i class="fas fa-venus"></i>P</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-sm border-b border-border align-middle">{{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d M Y') }}</td>
                        <td class="px-4 py-4 text-sm border-b border-border align-middle">{{ $pegawai->pendidikan_terakhir }}</td>
                        <td class="px-4 py-4 text-sm border-b border-border align-middle">{{ $pegawai->jabatan }}</td>
                        <td class="px-4 py-4 text-sm border-b border-border align-middle pr-6 min-w-[280px] max-w-[420px] whitespace-normal break-words leading-relaxed">{{ $pegawai->alamat }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="text-center py-16">
                                <i class="fas fa-inbox text-5xl text-ocean-pale mb-4 block"></i>
                                <h5 class="text-base font-semibold text-text-secondary mb-1">Tidak Ada Data</h5>
                                <p class="text-sm text-text-muted">Belum ada data pegawai untuk diexport</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('btnExport').addEventListener('click', function () {
        Swal.fire({
            title: 'Export Data Pegawai?',
            html: '<div style="text-align:left;font-size:14px;color:#5a6a7a;"><p>Anda akan mengunduh file CSV berisi:</p><ul style="padding-left:20px;margin-top:8px;"><li><strong>{{ $totalData }}</strong> data pegawai</li><li>Format: CSV</li><li>Kompatibel dengan Excel</li></ul></div>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0077b6',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-download mr-1"></i> Ya, Download',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ route("pegawai.export") }}';
            }
        });
    });
</script>
@endpush
