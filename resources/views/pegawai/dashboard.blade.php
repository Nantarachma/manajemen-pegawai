@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="text-secondary" style="color: var(--primary-blue) !important;">Dashboard Statistik Pegawai</h2>
        <hr>
    </div>
</div>

<div class="row">
    <!-- Chart Jenis Kelamin -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header">
                <h5 class="mb-0">Komposisi Jenis Kelamin</h5>
            </div>
            <div class="card-body">
                <canvas id="genderChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart Pendidikan -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header">
                <h5 class="mb-0">Pendidikan Terakhir</h5>
            </div>
            <div class="card-body">
                <canvas id="educationChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart Usia -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm h-100">
            <div class="card-header">
                <h5 class="mb-0">Sebaran Usia</h5>
            </div>
            <div class="card-body">
                <canvas id="ageChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Data dari Controller
    const genderL = {{ $genderL }};
    const genderP = {{ $genderP }};
    
    const educationLabels = {!! json_encode(array_keys($educationData)) !!};
    const educationData = {!! json_encode(array_values($educationData)) !!};

    const ageLabels = {!! json_encode(array_keys($ageGroups)) !!};
    const ageData = {!! json_encode(array_values($ageGroups)) !!};

    const colors = [
        '#0A3D62', '#3C6382', '#82CCDD', '#60A3BC', '#38ADA9'
    ];

    // Gender Chart (Pie)
    new Chart(document.getElementById('genderChart'), {
        type: 'pie',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [genderL, genderP],
                backgroundColor: ['#0A3D62', '#82CCDD'],
            }]
        }
    });

    // Education Chart (Bar)
    new Chart(document.getElementById('educationChart'), {
        type: 'bar',
        data: {
            labels: educationLabels,
            datasets: [{
                label: 'Jumlah Pegawai',
                data: educationData,
                backgroundColor: '#3C6382',
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    // Age Chart (Bar)
    new Chart(document.getElementById('ageChart'), {
        type: 'bar',
        data: {
            labels: ageLabels,
            datasets: [{
                label: 'Jumlah Pegawai',
                data: ageData,
                backgroundColor: '#60A3BC',
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });
</script>
@endpush
