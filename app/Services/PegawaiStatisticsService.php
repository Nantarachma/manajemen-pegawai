<?php

namespace App\Services;

use App\Models\Pegawai;
use Illuminate\Support\Carbon;

class PegawaiStatisticsService
{
    /**
     * Get gender distribution counts.
     */
    public function getGenderData(): array
    {
        return [
            'laki_laki' => Pegawai::where('jenis_kelamin', 'Laki-laki')->count(),
            'perempuan' => Pegawai::where('jenis_kelamin', 'Perempuan')->count(),
        ];
    }

    /**
     * Get education distribution counts.
     */
    public function getEducationData(): array
    {
        return Pegawai::selectRaw('pendidikan_terakhir, COUNT(*) as count')
            ->groupBy('pendidikan_terakhir')
            ->pluck('count', 'pendidikan_terakhir')
            ->toArray();
    }

    /**
     * Get age group distribution counts.
     */
    public function getAgeGroups(): array
    {
        $ageGroups = [
            '< 30' => 0,
            '30 - 40' => 0,
            '> 40' => 0,
        ];

        Pegawai::select('tanggal_lahir')->each(function ($pegawai) use (&$ageGroups) {
            $age = Carbon::parse($pegawai->tanggal_lahir)->age;
            if ($age < 30) {
                $ageGroups['< 30']++;
            } elseif ($age <= 40) {
                $ageGroups['30 - 40']++;
            } else {
                $ageGroups['> 40']++;
            }
        });

        return $ageGroups;
    }

    /**
     * Get all dashboard statistics in one call.
     */
    public function getDashboardData(): array
    {
        $gender = $this->getGenderData();

        return [
            'genderL' => $gender['laki_laki'],
            'genderP' => $gender['perempuan'],
            'educationData' => $this->getEducationData(),
            'ageGroups' => $this->getAgeGroups(),
        ];
    }
}
