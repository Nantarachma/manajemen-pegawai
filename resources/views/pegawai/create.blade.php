@extends('layouts.app')

@section('page-title', 'Tambah Pegawai')
@section('page-subtitle', 'Masukkan data pegawai baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card-modern">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="fas fa-user-plus" style="color: var(--accent);"></i>
                <h5>Form Tambah Pegawai</h5>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert-modern danger mb-3">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form action="{{ route('pegawai.store') }}" method="POST" class="form-modern">
                    @csrf

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip') }}" placeholder="Masukkan NIP" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <div class="d-flex gap-4 mt-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jkL" value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="jkL">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jkP" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="jkP">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                            <select class="form-select" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                                <option value="">Pilih Pendidikan...</option>
                                @foreach(['SMA/SMK', 'D3', 'S1', 'S2', 'S3'] as $edu)
                                    <option value="{{ $edu }}" {{ old('pendidikan_terakhir') == $edu ? 'selected' : '' }}>{{ $edu }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan') }}" placeholder="Masukkan jabatan" required>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 pt-3" style="border-top: 1px solid var(--border);">
                        <a href="{{ route('pegawai.index') }}" class="btn btn-light" style="border-radius: var(--radius-sm); font-weight: 500; padding: 10px 20px;">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn-modern-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
