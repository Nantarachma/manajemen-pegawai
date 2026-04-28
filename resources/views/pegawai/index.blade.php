@extends('layouts.app')

@section('page-title', 'Data Pegawai')
@section('page-subtitle', 'Kelola seluruh data pegawai organisasi')

@section('content')
<div class="card-modern">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5><i class="fas fa-list me-2" style="color: var(--accent);"></i>Daftar Pegawai</h5>
        <a href="{{ route('pegawai.create') }}" class="btn-modern-primary">
            <i class="fas fa-plus"></i> Tambah Pegawai
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th style="padding-left: 24px;">No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tgl. Lahir</th>
                        <th>Pendidikan</th>
                        <th>Jabatan</th>
                        <th style="padding-right: 24px; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pegawais as $key => $pegawai)
                        <tr>
                            <td style="padding-left: 24px;">{{ $key + 1 }}</td>
                            <td><code style="font-size: 13px; color: var(--primary);">{{ $pegawai->nip }}</code></td>
                            <td><strong>{{ $pegawai->nama }}</strong></td>
                            <td>
                                @if($pegawai->jenis_kelamin == 'Laki-laki')
                                    <span class="badge-gender male"><i class="fas fa-mars me-1"></i>L</span>
                                @else
                                    <span class="badge-gender female"><i class="fas fa-venus me-1"></i>P</span>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d M Y') }}</td>
                            <td>{{ $pegawai->pendidikan_terakhir }}</td>
                            <td>{{ $pegawai->jabatan }}</td>
                            <td style="padding-right: 24px; text-align: right;">
                                <div class="d-flex gap-2 justify-content-end">
                                    <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn-action edit" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <button type="button" class="btn-action delete btn-delete" data-id="{{ $pegawai->id }}" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <form id="delete-form-{{ $pegawai->id }}" action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <h5>Belum Ada Data</h5>
                                    <p>Klik tombol "Tambah Pegawai" untuk memulai</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Hapus Data Pegawai?',
                    text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-trash-alt me-1"></i> Ya, Hapus',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'rounded-4',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });
    });
</script>
@endpush
