@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Daftar Pegawai</h4>
        <a href="{{ route('pegawai.create') }}" class="btn btn-light btn-sm text-primary fw-bold">+ Tambah Pegawai</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>L/P</th>
                        <th>Tanggal Lahir</th>
                        <th>Pendidikan</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pegawais as $key => $pegawai)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $pegawai->nip }}</td>
                            <td>{{ $pegawai->nama }}</td>
                            <td>{{ $pegawai->jenis_kelamin == 'Laki-laki' ? 'L' : 'P' }}</td>
                            <td>{{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('d-m-Y') }}</td>
                            <td>{{ $pegawai->pendidikan_terakhir }}</td>
                            <td>{{ $pegawai->jabatan }}</td>
                            <td>
                                <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $pegawai->id }}">Hapus</button>
                                <form id="delete-form-{{ $pegawai->id }}" action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Data pegawai belum tersedia.</td>
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
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data pegawai ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                })
            });
        });
    });
</script>
@endpush
