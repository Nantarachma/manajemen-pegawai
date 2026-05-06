@extends('layouts.app')

@section('page-title', 'Data Pegawai')
@section('page-subtitle', 'Kelola seluruh data pegawai organisasi')

@section('content')
{{-- Search & Filter Bar --}}
<div class="bg-white border border-border rounded-xl mb-3 hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] transition-all duration-200">
    <div class="p-4">
        <form method="GET" action="{{ route('pegawai.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                <div class="md:col-span-3">
                    <label class="block text-xs font-semibold text-text-muted mb-1.5">Cari NIP / Nama</label>
                    <div class="relative">
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-text-muted text-[13px]"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik NIP atau nama..." class="w-full pl-10 pr-4 py-2.5 bg-white border border-border rounded-md text-sm focus:border-primary focus:ring-[3px] focus:ring-primary/10 outline-none transition-all">
                    </div>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-text-muted mb-1.5">Jabatan</label>
                    <select name="jabatan" class="w-full px-3.5 py-2.5 bg-white border border-border rounded-md text-sm focus:border-primary focus:ring-[3px] focus:ring-primary/10 outline-none transition-all">
                        <option value="">Semua</option>
                        @foreach($jabatanList as $j)
                            <option value="{{ $j }}" {{ request('jabatan') == $j ? 'selected' : '' }}>{{ $j }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-text-muted mb-1.5">Pendidikan</label>
                    <select name="pendidikan" class="w-full px-3.5 py-2.5 bg-white border border-border rounded-md text-sm focus:border-primary focus:ring-[3px] focus:ring-primary/10 outline-none transition-all">
                        <option value="">Semua</option>
                        @foreach(['SMA/SMK', 'D3', 'S1', 'S2', 'S3'] as $edu)
                            <option value="{{ $edu }}" {{ request('pendidikan') == $edu ? 'selected' : '' }}>{{ $edu }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-text-muted mb-1.5">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full px-3.5 py-2.5 bg-white border border-border rounded-md text-sm focus:border-primary focus:ring-[3px] focus:ring-primary/10 outline-none transition-all">
                        <option value="">Semua</option>
                        <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="md:col-span-3 flex gap-2">
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-white rounded-md font-medium text-sm cursor-pointer transition-all duration-200 hover:-translate-y-px hover:shadow-[0_4px_12px_rgba(99,102,241,0.35)]">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <a href="{{ route('pegawai.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-transparent text-text-secondary border border-border rounded-md font-medium text-sm transition-all hover:bg-gray-50 no-underline">
                        <i class="fas fa-times"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Import Errors --}}
@if(session('import_errors') && count(session('import_errors')) > 0)
    <div class="bg-red-50 text-error border border-red-200 rounded-lg px-5 py-3.5 text-sm mb-3 animate-slideDown">
        <strong><i class="fas fa-exclamation-triangle mr-1"></i> Detail import:</strong>
        <ul class="mt-1 ml-5 list-disc">
            @foreach(session('import_errors') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Table --}}
<div class="bg-white border border-border rounded-xl hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] transition-all duration-200 overflow-hidden">
    <div class="flex justify-between items-center px-6 py-5 border-b border-border">
        <h5 class="font-display text-base font-semibold text-text-primary"><i class="fas fa-list mr-2 text-primary"></i>Daftar Pegawai</h5>
        <a href="{{ route('pegawai.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-md font-medium text-sm no-underline transition-all duration-200 hover:-translate-y-px hover:shadow-[0_4px_12px_rgba(99,102,241,0.35)]">
            <i class="fas fa-plus"></i> Tambah Pegawai
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full border-separate border-spacing-0">
            <thead>
                <tr>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left pl-6">No</th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left">
                        <a href="{{ route('pegawai.index', array_merge(request()->query(), ['sort' => 'nip', 'dir' => request('sort') == 'nip' && request('dir') == 'asc' ? 'desc' : 'asc'])) }}" class="text-inherit no-underline">NIP @if(request('sort') == 'nip')<i class="fas fa-sort-{{ request('dir') == 'desc' ? 'down' : 'up' }} text-[10px]"></i>@endif</a>
                    </th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left">
                        <a href="{{ route('pegawai.index', array_merge(request()->query(), ['sort' => 'nama', 'dir' => request('sort') == 'nama' && request('dir') == 'asc' ? 'desc' : 'asc'])) }}" class="text-inherit no-underline">Nama @if(request('sort') == 'nama' || !request('sort'))<i class="fas fa-sort-{{ request('dir') == 'desc' ? 'down' : 'up' }} text-[10px]"></i>@endif</a>
                    </th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left">Jenis Kelamin</th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left">
                        <a href="{{ route('pegawai.index', array_merge(request()->query(), ['sort' => 'tanggal_lahir', 'dir' => request('sort') == 'tanggal_lahir' && request('dir') == 'asc' ? 'desc' : 'asc'])) }}" class="text-inherit no-underline">Tgl. Lahir @if(request('sort') == 'tanggal_lahir')<i class="fas fa-sort-{{ request('dir') == 'desc' ? 'down' : 'up' }} text-[10px]"></i>@endif</a>
                    </th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left">Pendidikan</th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left">
                        <a href="{{ route('pegawai.index', array_merge(request()->query(), ['sort' => 'jabatan', 'dir' => request('sort') == 'jabatan' && request('dir') == 'asc' ? 'desc' : 'asc'])) }}" class="text-inherit no-underline">Jabatan @if(request('sort') == 'jabatan')<i class="fas fa-sort-{{ request('dir') == 'desc' ? 'down' : 'up' }} text-[10px]"></i>@endif</a>
                    </th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left min-w-[240px]">Alamat</th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-right pr-6">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pegawais as $key => $pegawai)
                    <tr class="table-row-hover transition-colors">
                        <td class="px-4 py-4 text-sm text-text-primary border-b border-border align-middle pl-6">{{ $pegawais->firstItem() + $key }}</td>
                        <td class="px-4 py-4 text-sm border-b border-border align-middle"><code class="font-mono text-[13px] text-primary">{{ $pegawai->nip }}</code></td>
                        <td class="px-4 py-4 text-sm text-text-primary border-b border-border align-middle"><strong>{{ $pegawai->nama }}</strong></td>
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
                        <td class="px-4 py-4 text-sm border-b border-border align-middle max-w-[280px] whitespace-normal break-words leading-relaxed">{{ $pegawai->alamat }}</td>
                        <td class="px-4 py-4 text-sm border-b border-border align-middle text-right pr-6">
                            <div class="flex gap-2 justify-end">
                                <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="w-[34px] h-[34px] rounded-md inline-flex items-center justify-center text-[13px] bg-primary-wash text-primary transition-all duration-200 hover:bg-primary hover:text-white no-underline" title="Edit"><i class="fas fa-pen"></i></a>
                                <button type="button" class="w-[34px] h-[34px] rounded-md inline-flex items-center justify-center text-[13px] bg-red-50 text-red-500 border-none cursor-pointer transition-all duration-200 hover:bg-red-500 hover:text-white btn-delete" data-id="{{ $pegawai->id }}" title="Hapus"><i class="fas fa-trash-alt"></i></button>
                                <form id="delete-form-{{ $pegawai->id }}" action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" class="hidden">@csrf @method('DELETE')</form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">
                            <div class="text-center py-16 px-5">
                                <i class="fas fa-inbox text-5xl text-primary-pale mb-4 block"></i>
                                <h5 class="font-display text-base font-semibold text-text-secondary mb-1">Belum Ada Data</h5>
                                <p class="text-sm text-text-muted">Klik tombol "Tambah Pegawai" untuk memulai</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pegawais->hasPages())
        <div class="px-6 py-3 border-t border-border">{{ $pegawais->links('vendor.pagination.tailwind') }}</div>
    @endif
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
                    confirmButtonColor: '#EF4444',
                    cancelButtonColor: '#9C9C9C',
                    confirmButtonText: '<i class="fas fa-trash-alt mr-1"></i> Ya, Hapus',
                    cancelButtonText: 'Batal',
                    customClass: { popup: 'rounded-xl' }
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
