@extends('layouts.app')

@section('page-title', 'Riwayat Aktivitas')
@section('page-subtitle', 'Pencatatan setiap perubahan data dalam sistem')

@section('content')
<div class="bg-white border border-border rounded-2xl shadow-sm mb-3 hover:shadow-md transition-shadow">
    <div class="p-4">
        <form method="GET" action="{{ route('audit.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-end">
                <div class="md:col-span-4">
                    <label class="block text-xs font-semibold text-text-muted mb-1.5">Cari pengguna</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama pengguna..." class="w-full px-3.5 py-2.5 bg-bg border-[1.5px] border-border rounded-[10px] text-sm focus:border-ocean-mid focus:ring-2 focus:ring-ocean-mid/10 focus:bg-white outline-none transition-all">
                </div>
                <div class="md:col-span-3">
                    <label class="block text-xs font-semibold text-text-muted mb-1.5">Jenis Aksi</label>
                    <select name="action" class="w-full px-3.5 py-2.5 bg-bg border-[1.5px] border-border rounded-[10px] text-sm focus:border-ocean-mid focus:ring-2 focus:ring-ocean-mid/10 focus:bg-white outline-none transition-all">
                        <option value="">Semua</option>
                        @foreach(['create', 'update', 'delete', 'import', 'export'] as $act)
                            <option value="{{ $act }}" {{ request('action') == $act ? 'selected' : '' }}>{{ ucfirst($act) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-3 flex gap-2">
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-ocean-dark to-ocean-mid text-white rounded-[10px] font-semibold text-sm cursor-pointer transition-all hover:-translate-y-0.5 hover:shadow-[0_6px_20px_rgba(0,119,182,0.3)]">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <a href="{{ route('audit.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white text-text-secondary border-[1.5px] border-border rounded-[10px] font-medium text-sm no-underline transition-all hover:bg-gray-50">
                        <i class="fas fa-times"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="bg-white border border-border rounded-2xl shadow-sm hover:shadow-md transition-shadow overflow-hidden">
    <div class="flex items-center gap-2 px-6 py-5 border-b border-border">
        <i class="fas fa-history text-ocean-mid"></i>
        <h5 class="text-base font-semibold text-text-primary">Log Aktivitas</h5>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full border-separate border-spacing-0">
            <thead>
                <tr>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left pl-6">Waktu</th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left">Pengguna</th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left">Aksi</th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left">Model</th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left">ID</th>
                    <th class="bg-bg px-4 py-3.5 text-xs font-semibold uppercase tracking-wide text-text-muted border-b border-border text-left pr-6">Detail Perubahan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr class="table-row-hover transition-colors">
                        <td class="px-4 py-4 text-sm border-b border-border align-middle pl-6 whitespace-nowrap">
                            <span class="text-[13px]">{{ $log->created_at->format('d M Y') }}</span><br>
                            <span class="text-xs text-text-muted">{{ $log->created_at->format('H:i:s') }}</span>
                        </td>
                        <td class="px-4 py-4 text-sm border-b border-border align-middle font-semibold">{{ $log->user->name ?? '-' }}</td>
                        <td class="px-4 py-4 text-sm border-b border-border align-middle">
                            @php
                                $badgeClasses = [
                                    'create' => 'bg-emerald-50 text-emerald-600',
                                    'update' => 'bg-ocean-wash text-ocean-dark',
                                    'delete' => 'bg-red-50 text-red-600',
                                    'import' => 'bg-purple-50 text-purple-600',
                                    'export' => 'bg-amber-50 text-amber-600',
                                ];
                            @endphp
                            <span class="inline-block px-2.5 py-1 rounded-md text-xs font-semibold {{ $badgeClasses[$log->action] ?? '' }}">
                                {{ ucfirst($log->action) }}
                            </span>
                        </td>
                        <td class="px-4 py-4 text-sm border-b border-border align-middle">{{ class_basename($log->model_type) }}</td>
                        <td class="px-4 py-4 text-sm border-b border-border align-middle"><code>{{ $log->model_id ?? '-' }}</code></td>
                        <td class="px-4 py-4 text-sm border-b border-border align-middle pr-6 max-w-[300px]">
                            @if($log->action === 'update' && $log->old_values && $log->new_values)
                                @php
                                    $changes = [];
                                    foreach ($log->new_values as $key => $val) {
                                        if (isset($log->old_values[$key]) && $log->old_values[$key] != $val && !in_array($key, ['id', 'created_at', 'updated_at'])) {
                                            $changes[$key] = ['old' => $log->old_values[$key], 'new' => $val];
                                        }
                                    }
                                @endphp
                                @foreach($changes as $field => $change)
                                    <div class="text-xs mb-0.5">
                                        <strong>{{ $field }}:</strong>
                                        <span class="text-red-600 line-through">{{ $change['old'] }}</span>
                                        → <span class="text-emerald-600">{{ $change['new'] }}</span>
                                    </div>
                                @endforeach
                            @elseif($log->action === 'create' && $log->new_values)
                                <span class="text-xs text-text-muted">Data baru: {{ $log->new_values['nama'] ?? '' }}</span>
                            @elseif($log->action === 'delete' && $log->old_values)
                                <span class="text-xs text-text-muted">Dihapus: {{ $log->old_values['nama'] ?? '' }}</span>
                            @else
                                <span class="text-xs text-text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="text-center py-16">
                                <i class="fas fa-clipboard-list text-5xl text-ocean-pale mb-4 block"></i>
                                <h5 class="text-base font-semibold text-text-secondary mb-1">Belum Ada Riwayat</h5>
                                <p class="text-sm text-text-muted">Aktivitas akan dicatat secara otomatis</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($logs->hasPages())
        <div class="px-6 py-3 border-t border-border">
            {{ $logs->links('vendor.pagination.tailwind') }}
        </div>
    @endif
</div>
@endsection
