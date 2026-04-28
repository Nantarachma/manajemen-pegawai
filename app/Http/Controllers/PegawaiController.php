<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PegawaiController extends Controller
{
    public function dashboard()
    {
        // 1. Gender Data
        $genderL = Pegawai::where('jenis_kelamin', 'Laki-laki')->count();
        $genderP = Pegawai::where('jenis_kelamin', 'Perempuan')->count();

        // 2. Education Data
        $educationData = Pegawai::selectRaw('pendidikan_terakhir, COUNT(*) as count')
            ->groupBy('pendidikan_terakhir')
            ->pluck('count', 'pendidikan_terakhir')
            ->toArray();

        // 3. Age Groups Data (Rentang: < 30, 30-40, > 40)
        $pegawais = Pegawai::all();
        $ageGroups = [
            '< 30' => 0,
            '30 - 40' => 0,
            '> 40' => 0,
        ];

        foreach ($pegawais as $p) {
            $age = Carbon::parse($p->tanggal_lahir)->age;
            if ($age < 30) {
                $ageGroups['< 30']++;
            } elseif ($age <= 40) {
                $ageGroups['30 - 40']++;
            } else {
                $ageGroups['> 40']++;
            }
        }

        return view('pegawai.dashboard', compact('genderL', 'genderP', 'educationData', 'ageGroups'));
    }

    public function index()
    {
        $pegawais = Pegawai::all();
        return view('pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:pegawais,nip',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'pendidikan_terakhir' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        Pegawai::create($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $request->validate([
            'nip' => 'required|unique:pegawais,nip,' . $id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'pendidikan_terakhir' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
