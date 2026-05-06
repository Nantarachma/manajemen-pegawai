<?php

namespace App\Policies;

use App\Models\Pegawai;
use App\Models\User;

class PegawaiPolicy
{
    /**
     * Determine if the user can view any pegawai.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can view a specific pegawai.
     */
    public function view(User $user, Pegawai $pegawai): bool
    {
        return true;
    }

    /**
     * Determine if the user can create pegawai.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can update a pegawai.
     */
    public function update(User $user, Pegawai $pegawai): bool
    {
        return true;
    }

    /**
     * Determine if the user can delete a pegawai.
     */
    public function delete(User $user, Pegawai $pegawai): bool
    {
        return true;
    }

    /**
     * Determine if the user can import pegawai data.
     */
    public function import(User $user): bool
    {
        return true;
    }

    /**
     * Determine if the user can export pegawai data.
     */
    public function export(User $user): bool
    {
        return true;
    }
}
