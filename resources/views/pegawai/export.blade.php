@extends('layouts.app')

@section('page-title', 'Export Data')
@section('page-subtitle', 'Preview data sebelum diexport ke CSV')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-12 gap-5 mb-5">
    <div class="md:col-span-4">
        <div class="bg-white border border-border rounded-xl p-6 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] relative overflow-hidden">
            <div class="w-12 h-12 rounded-lg flex items-center justify-center text-xl mb-4 bg-primary text-white">
                <i class="fas fa-file-csv"></i>
            </div>
            <h3 class="font-display text-3xl font-bold text-text-primary tracking-[-0.03em]">{{ $totalData }}</h3>
            <p class="text-[13px] text-text-muted font-medium mt-1">Total Data Akan Diexport</p>
        </div>
    </div>
    <div class="md:col-span-8 flex items-center">
        <div class="w-full p-4 bg-primary-wash rounded-lg border border-primary/10">
            <h6 class="text-primary text-sm font-semibold mb-1.5">
                <i class="fas fa-info-circle mr-1"></i> Informasi Export
            </h6>
            <p class="text-[13px] text-text-secondary leading-relaxed">
                File CSV akan berisi seluruh data pegawai yang tampil di bawah ini. Format file mendukung Excel dan aplikasi spreadsheet lainnya. Data diurutkan berdasarkan nama pegawai secara alfabet.
            </p>
        </div>
    </div>
</div>

<div class="bg-white border border-border rounded-xl hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] transition-all duration-200 overflow-hidden">
    <div class="flex justify-between items-center px-6 py-5 border-b border-border">
        <h5 class="font-display text-base font-semibold text-text-primary"><i class="fas fa-eye mr-2 text-primary"></i>Preview Data</h5>
        <button type="button" id="btnExport" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-md font-medium text-sm border-none cursor-pointer transition-all duration-200 hover:-translate-y-px hover:shadow-[0_4px_12px_rgba(99,102,241,0.35)]">
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
                        <td class="px-4 py-4 text-sm border-b border-border align-middle"><code class="font-mono text-[13px] text-primary">{{ $pegawai->nip }}</code></td>
                        <td class="px-4 py-4 text-sm border-b border-border align-middle font-semibold">{{ $pegawai->nama }}</td>
                        <td class="px-4 py-4 text-sm border-b border-border align-middle">
                            @if($pegawai->jenis_kelamin == 'Laki-laki')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-primary-wash text-primary"><i class="fas fa-mars"></i>L</span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-pink-50 text-pink-600"><i class="fas fa-venus"></i>P</span>
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
                                <i class="fas fa-inbox text-5xl text-primary-pale mb-4 block"></i>
                                <h5 class="font-display text-base font-semibold text-text-secondary mb-1">Tidak Ada Data</h5>
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
            html: '<div style="text-align:left;font-size:14px;color:#6B6B6B;"><p>Anda akan mengunduh file CSV berisi:</p><ul style="padding-left:20px;margin-top:8px;"><li><strong>{{ $totalData }}</strong> data pegawai</li><li>Format: CSV</li><li>Kompatibel dengan Excel</li></ul></div>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#6366F1',
            cancelButtonColor: '#9C9C9C',
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
