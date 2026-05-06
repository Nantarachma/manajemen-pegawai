@extends('layouts.app')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan statistik data pegawai')

@section('content')
{{-- Stat Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
    <div class="bg-white border border-border rounded-2xl p-6 shadow-sm transition-all hover:-translate-y-0.5 hover:shadow-lg relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[100px] h-[100px] rounded-full bg-ocean-dark/5 translate-x-[30px] -translate-y-[30px]"></div>
        <div class="w-12 h-12 rounded-[14px] flex items-center justify-center text-xl mb-4 bg-gradient-to-br from-ocean-dark to-ocean-mid text-white">
            <i class="fas fa-users"></i>
        </div>
        <h3 class="text-3xl font-extrabold text-text-primary tracking-tight">{{ $genderL + $genderP }}</h3>
        <p class="text-[13px] text-text-muted font-medium mt-1">Total Pegawai</p>
    </div>
    <div class="bg-white border border-border rounded-2xl p-6 shadow-sm transition-all hover:-translate-y-0.5 hover:shadow-lg relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[100px] h-[100px] rounded-full bg-ocean-mid/5 translate-x-[30px] -translate-y-[30px]"></div>
        <div class="w-12 h-12 rounded-[14px] flex items-center justify-center text-xl mb-4 bg-gradient-to-br from-ocean-mid to-ocean-light text-white">
            <i class="fas fa-mars"></i>
        </div>
        <h3 class="text-3xl font-extrabold text-text-primary tracking-tight">{{ $genderL }}</h3>
        <p class="text-[13px] text-text-muted font-medium mt-1">Pegawai Laki-laki</p>
    </div>
    <div class="bg-white border border-border rounded-2xl p-6 shadow-sm transition-all hover:-translate-y-0.5 hover:shadow-lg relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[100px] h-[100px] rounded-full bg-ocean-light/5 translate-x-[30px] -translate-y-[30px]"></div>
        <div class="w-12 h-12 rounded-[14px] flex items-center justify-center text-xl mb-4 bg-gradient-to-br from-ocean-light to-ocean-pale text-ocean-dark">
            <i class="fas fa-venus"></i>
        </div>
        <h3 class="text-3xl font-extrabold text-text-primary tracking-tight">{{ $genderP }}</h3>
        <p class="text-[13px] text-text-muted font-medium mt-1">Pegawai Perempuan</p>
    </div>
</div>

{{-- Charts --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white border border-border rounded-2xl shadow-sm hover:shadow-md transition-shadow overflow-hidden h-full">
        <div class="chart-header-bar"></div>
        <div class="flex items-center gap-2 px-6 py-5 border-b border-border">
            <i class="fas fa-venus-mars text-ocean-mid"></i>
            <h5 class="text-base font-semibold text-text-primary">Komposisi Jenis Kelamin</h5>
        </div>
        <div class="p-6 flex items-center justify-center min-h-[280px]">
            <canvas id="genderChart"></canvas>
        </div>
    </div>
    <div class="bg-white border border-border rounded-2xl shadow-sm hover:shadow-md transition-shadow overflow-hidden h-full">
        <div class="chart-header-bar"></div>
        <div class="flex items-center gap-2 px-6 py-5 border-b border-border">
            <i class="fas fa-graduation-cap text-ocean-mid"></i>
            <h5 class="text-base font-semibold text-text-primary">Pendidikan Terakhir</h5>
        </div>
        <div class="p-6 flex items-center justify-center min-h-[280px]">
            <canvas id="educationChart"></canvas>
        </div>
    </div>
    <div class="bg-white border border-border rounded-2xl shadow-sm hover:shadow-md transition-shadow overflow-hidden h-full">
        <div class="chart-header-bar"></div>
        <div class="flex items-center gap-2 px-6 py-5 border-b border-border">
            <i class="fas fa-birthday-cake text-ocean-mid"></i>
            <h5 class="text-base font-semibold text-text-primary">Sebaran Usia</h5>
        </div>
        <div class="p-6 flex items-center justify-center min-h-[280px]">
            <canvas id="ageChart"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const genderL = {{ $genderL }};
    const genderP = {{ $genderP }};
    const educationLabels = {!! json_encode(array_keys($educationData)) !!};
    const educationValues = {!! json_encode(array_values($educationData)) !!};
    const ageLabels = {!! json_encode(array_keys($ageGroups)) !!};
    const ageValues = {!! json_encode(array_values($ageGroups)) !!};

    Chart.defaults.font.family = 'Inter, sans-serif';
    Chart.defaults.font.size = 13;
    Chart.defaults.color = '#94a3b8';

    new Chart(document.getElementById('genderChart'), {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{ data: [genderL, genderP], backgroundColor: ['#0077b6', '#90e0ef'], borderWidth: 0, hoverOffset: 8 }]
        },
        options: { cutout: '65%', plugins: { legend: { position: 'bottom', labels: { padding: 16, usePointStyle: true, pointStyleWidth: 10 } } } }
    });

    new Chart(document.getElementById('educationChart'), {
        type: 'bar',
        data: {
            labels: educationLabels,
            datasets: [{ label: 'Jumlah', data: educationValues, backgroundColor: ['#0077b6','#0096c7','#00b4d8','#48cae4','#90e0ef'], borderRadius: 8, borderSkipped: false, barThickness: 36 }]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,0.03)' } }, x: { grid: { display: false } } } }
    });

    new Chart(document.getElementById('ageChart'), {
        type: 'bar',
        data: {
            labels: ageLabels,
            datasets: [{ label: 'Jumlah', data: ageValues, backgroundColor: ['#48cae4', '#00b4d8', '#0077b6'], borderRadius: 8, borderSkipped: false, barThickness: 48 }]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,0.03)' } }, x: { grid: { display: false } } } }
    });
</script>
@endpush
