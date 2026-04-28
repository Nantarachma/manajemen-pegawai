@extends('layouts.app')

@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan statistik data pegawai')

@section('content')
{{-- Stat Cards --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card ocean">
            <div class="stat-card-icon">
                <i class="fas fa-users"></i>
            </div>
            <h3>{{ $genderL + $genderP }}</h3>
            <p>Total Pegawai</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card sky">
            <div class="stat-card-icon">
                <i class="fas fa-mars"></i>
            </div>
            <h3>{{ $genderL }}</h3>
            <p>Pegawai Laki-laki</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card aqua">
            <div class="stat-card-icon">
                <i class="fas fa-venus"></i>
            </div>
            <h3>{{ $genderP }}</h3>
            <p>Pegawai Perempuan</p>
        </div>
    </div>
</div>

{{-- Charts --}}
<div class="row g-4">
    <div class="col-md-4">
        <div class="card-modern h-100">
            <div class="chart-header-bar"></div>
            <div class="card-header d-flex align-items-center gap-2">
                <i class="fas fa-venus-mars" style="color: var(--ocean-mid);"></i>
                <h5>Komposisi Jenis Kelamin</h5>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center" style="min-height: 280px;">
                <canvas id="genderChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-modern h-100">
            <div class="chart-header-bar"></div>
            <div class="card-header d-flex align-items-center gap-2">
                <i class="fas fa-graduation-cap" style="color: var(--ocean-mid);"></i>
                <h5>Pendidikan Terakhir</h5>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center" style="min-height: 280px;">
                <canvas id="educationChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card-modern h-100">
            <div class="chart-header-bar"></div>
            <div class="card-header d-flex align-items-center gap-2">
                <i class="fas fa-birthday-cake" style="color: var(--ocean-mid);"></i>
                <h5>Sebaran Usia</h5>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center" style="min-height: 280px;">
                <canvas id="ageChart"></canvas>
            </div>
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

    // Gender — Doughnut
    new Chart(document.getElementById('genderChart'), {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [genderL, genderP],
                backgroundColor: ['#0077b6', '#90e0ef'],
                borderWidth: 0,
                hoverOffset: 8,
            }]
        },
        options: {
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { padding: 16, usePointStyle: true, pointStyleWidth: 10 }
                }
            }
        }
    });

    // Education — Bar (rounded, gradient-like)
    new Chart(document.getElementById('educationChart'), {
        type: 'bar',
        data: {
            labels: educationLabels,
            datasets: [{
                label: 'Jumlah',
                data: educationValues,
                backgroundColor: ['#0077b6','#0096c7','#00b4d8','#48cae4','#90e0ef'],
                borderRadius: 8,
                borderSkipped: false,
                barThickness: 36,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    grid: { color: 'rgba(0,0,0,0.03)' }
                },
                x: { grid: { display: false } }
            }
        }
    });

    // Age — Bar (rounded)
    new Chart(document.getElementById('ageChart'), {
        type: 'bar',
        data: {
            labels: ageLabels,
            datasets: [{
                label: 'Jumlah',
                data: ageValues,
                backgroundColor: ['#48cae4', '#00b4d8', '#0077b6'],
                borderRadius: 8,
                borderSkipped: false,
                barThickness: 48,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    grid: { color: 'rgba(0,0,0,0.03)' }
                },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endpush
