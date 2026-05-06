@extends('layouts.app')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan statistik data pegawai')

@section('content')
{{-- Stat Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-5">
    <div class="bg-white border border-border rounded-xl p-6 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[100px] h-[100px] rounded-full bg-primary/5 translate-x-[30px] -translate-y-[30px]"></div>
        <div class="w-12 h-12 rounded-lg flex items-center justify-center text-xl mb-4 bg-primary text-white">
            <i class="fas fa-users"></i>
        </div>
        <h3 class="font-display text-3xl font-bold text-text-primary tracking-[-0.03em]">{{ $genderL + $genderP }}</h3>
        <p class="text-[13px] text-text-muted font-medium mt-1">Total Pegawai</p>
    </div>
    <div class="bg-white border border-border rounded-xl p-6 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[100px] h-[100px] rounded-full bg-primary-light/5 translate-x-[30px] -translate-y-[30px]"></div>
        <div class="w-12 h-12 rounded-lg flex items-center justify-center text-xl mb-4 bg-primary-light text-white">
            <i class="fas fa-mars"></i>
        </div>
        <h3 class="font-display text-3xl font-bold text-text-primary tracking-[-0.03em]">{{ $genderL }}</h3>
        <p class="text-[13px] text-text-muted font-medium mt-1">Pegawai Laki-laki</p>
    </div>
    <div class="bg-white border border-border rounded-xl p-6 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[100px] h-[100px] rounded-full bg-primary-pale/10 translate-x-[30px] -translate-y-[30px]"></div>
        <div class="w-12 h-12 rounded-lg flex items-center justify-center text-xl mb-4 bg-primary-pale text-primary-hover">
            <i class="fas fa-venus"></i>
        </div>
        <h3 class="font-display text-3xl font-bold text-text-primary tracking-[-0.03em]">{{ $genderP }}</h3>
        <p class="text-[13px] text-text-muted font-medium mt-1">Pegawai Perempuan</p>
    </div>
</div>

{{-- Charts --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-5">
    <div class="bg-white border border-border rounded-xl hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] transition-all duration-200 overflow-hidden h-full">
        <div class="chart-header-bar"></div>
        <div class="flex items-center gap-2 px-6 py-5 border-b border-border">
            <i class="fas fa-venus-mars text-primary"></i>
            <h5 class="font-display text-base font-semibold text-text-primary">Komposisi Jenis Kelamin</h5>
        </div>
        <div class="p-6 flex items-center justify-center min-h-[280px]">
            <canvas id="genderChart"></canvas>
        </div>
    </div>
    <div class="bg-white border border-border rounded-xl hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] transition-all duration-200 overflow-hidden h-full">
        <div class="chart-header-bar"></div>
        <div class="flex items-center gap-2 px-6 py-5 border-b border-border">
            <i class="fas fa-graduation-cap text-primary"></i>
            <h5 class="font-display text-base font-semibold text-text-primary">Pendidikan Terakhir</h5>
        </div>
        <div class="p-6 flex items-center justify-center min-h-[280px]">
            <canvas id="educationChart"></canvas>
        </div>
    </div>
    <div class="bg-white border border-border rounded-xl hover:shadow-[0_8px_30px_rgba(0,0,0,0.08)] transition-all duration-200 overflow-hidden h-full">
        <div class="chart-header-bar"></div>
        <div class="flex items-center gap-2 px-6 py-5 border-b border-border">
            <i class="fas fa-birthday-cake text-primary"></i>
            <h5 class="font-display text-base font-semibold text-text-primary">Sebaran Usia</h5>
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

    Chart.defaults.font.family = 'DM Sans, sans-serif';
    Chart.defaults.font.size = 13;
    Chart.defaults.color = '#9C9C9C';

    new Chart(document.getElementById('genderChart'), {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{ data: [genderL, genderP], backgroundColor: ['#6366F1', '#C7D2FE'], borderWidth: 0, hoverOffset: 8 }]
        },
        options: { cutout: '65%', plugins: { legend: { position: 'bottom', labels: { padding: 16, usePointStyle: true, pointStyleWidth: 10 } } } }
    });

    new Chart(document.getElementById('educationChart'), {
        type: 'bar',
        data: {
            labels: educationLabels,
            datasets: [{ label: 'Jumlah', data: educationValues, backgroundColor: ['#4F46E5','#6366F1','#818CF8','#A5B4FC','#C7D2FE'], borderRadius: 8, borderSkipped: false, barThickness: 36 }]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,0.03)' } }, x: { grid: { display: false } } } }
    });

    new Chart(document.getElementById('ageChart'), {
        type: 'bar',
        data: {
            labels: ageLabels,
            datasets: [{ label: 'Jumlah', data: ageValues, backgroundColor: ['#A5B4FC', '#6366F1', '#4F46E5'], borderRadius: 8, borderSkipped: false, barThickness: 48 }]
        },
        options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,0.03)' } }, x: { grid: { display: false } } } }
    });
</script>
@endpush
