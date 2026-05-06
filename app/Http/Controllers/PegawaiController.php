<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\AuditLog;
use App\Http\Requests\PegawaiRequest;
use App\Services\PegawaiStatisticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class PegawaiController extends Controller
{
    protected PegawaiStatisticsService $statisticsService;

    public function __construct(PegawaiStatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    /**
     * Dashboard with statistics charts.
     */
    public function dashboard()
    {
        $data = $this->statisticsService->getDashboardData();
        return view('pegawai.dashboard', $data);
    }

    /**
     * Display paginated list with search, filter, and sort.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Pegawai::class);

        $query = Pegawai::query();

        // Search by NIP or Nama
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nip', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%");
            });
        }

        // Filter by Jabatan
        if ($request->filled('jabatan')) {
            $query->where('jabatan', $request->jabatan);
        }

        // Filter by Pendidikan
        if ($request->filled('pendidikan')) {
            $query->where('pendidikan_terakhir', $request->pendidikan);
        }

        // Filter by Jenis Kelamin
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Sort
        $sortBy = $request->get('sort', 'nama');
        $sortDir = $request->get('dir', 'asc');
        $allowedSorts = ['nip', 'nama', 'jabatan', 'tanggal_lahir', 'pendidikan_terakhir'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortDir === 'desc' ? 'desc' : 'asc');
        }

        // Pagination
        $pegawais = $query->paginate(10)->withQueryString();

        // Get distinct jabatan for filter dropdown
        $jabatanList = Pegawai::select('jabatan')->distinct()->orderBy('jabatan')->pluck('jabatan');

        return view('pegawai.index', compact('pegawais', 'jabatanList'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        Gate::authorize('create', Pegawai::class);
        return view('pegawai.create');
    }

    /**
     * Store new pegawai.
     */
    public function store(PegawaiRequest $request)
    {
        Gate::authorize('create', Pegawai::class);

        $pegawai = Pegawai::create($request->safeData());

        AuditLog::record('create', 'Pegawai', $pegawai->id, null, $pegawai->toArray());

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    /**
     * Show edit form.
     */
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        Gate::authorize('update', $pegawai);

        return view('pegawai.edit', compact('pegawai'));
    }

    /**
     * Update pegawai.
     */
    public function update(PegawaiRequest $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);
        Gate::authorize('update', $pegawai);

        $oldValues = $pegawai->toArray();
        $pegawai->update($request->safeData());

        AuditLog::record('update', 'Pegawai', $pegawai->id, $oldValues, $pegawai->fresh()->toArray());

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    /**
     * Delete pegawai.
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        Gate::authorize('delete', $pegawai);

        $oldValues = $pegawai->toArray();
        $pegawai->delete();

        AuditLog::record('delete', 'Pegawai', $id, $oldValues, null);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus.');
    }

    /**
     * Show export preview page.
     */
    public function exportPreview()
    {
        Gate::authorize('export', Pegawai::class);

        $pegawais = Pegawai::orderBy('nama')->get();
        $totalData = $pegawais->count();

        return view('pegawai.export', compact('pegawais', 'totalData'));
    }

    /**
     * Export pegawai data to CSV.
     */
    public function export(Request $request)
    {
        Gate::authorize('export', Pegawai::class);

        $pegawais = Pegawai::orderBy('nama')->get();

        $csvHeader = ['No', 'NIP', 'Nama', 'Jenis Kelamin', 'Tanggal Lahir', 'Pendidikan Terakhir', 'Jabatan', 'Alamat'];

        $callback = function () use ($pegawais, $csvHeader) {
            $file = fopen('php://output', 'w');
            // UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($file, $csvHeader);

            foreach ($pegawais as $index => $p) {
                fputcsv($file, [
                    $index + 1,
                    $p->nip,
                    $p->nama,
                    $p->jenis_kelamin,
                    $p->tanggal_lahir,
                    $p->pendidikan_terakhir,
                    $p->jabatan,
                    $p->alamat,
                ]);
            }

            fclose($file);
        };

        AuditLog::record('export', 'Pegawai', null, null, ['total' => $pegawais->count()]);

        $filename = 'data_pegawai_' . date('Y-m-d_His') . '.csv';

        return Response::stream($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Show import form.
     */
    public function importForm()
    {
        Gate::authorize('import', Pegawai::class);
        return view('pegawai.import');
    }

    /**
     * Process CSV import.
     */
    public function import(Request $request)
    {
        Gate::authorize('import', Pegawai::class);

        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ], [
            'csv_file.required' => 'File CSV wajib diunggah.',
            'csv_file.mimes' => 'File harus berformat CSV.',
            'csv_file.max' => 'Ukuran file maksimal 2MB.',
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();

        $imported = 0;
        $skipped = 0;
        $errors = [];

        if (($handle = fopen($path, 'r')) !== false) {
            $header = fgetcsv($handle); // Skip header row
            $rowNumber = 1;

            while (($row = fgetcsv($handle)) !== false) {
                $rowNumber++;

                // Expect at least 7 columns (NIP, Nama, JK, TglLahir, Pendidikan, Jabatan, Alamat)
                // Skip the No column if present (8 columns)
                if (count($row) >= 8) {
                    $data = [
                        'nip' => trim($row[1]),
                        'nama' => trim($row[2]),
                        'jenis_kelamin' => trim($row[3]),
                        'tanggal_lahir' => trim($row[4]),
                        'pendidikan_terakhir' => trim($row[5]),
                        'jabatan' => trim($row[6]),
                        'alamat' => trim($row[7]),
                    ];
                } elseif (count($row) >= 7) {
                    $data = [
                        'nip' => trim($row[0]),
                        'nama' => trim($row[1]),
                        'jenis_kelamin' => trim($row[2]),
                        'tanggal_lahir' => trim($row[3]),
                        'pendidikan_terakhir' => trim($row[4]),
                        'jabatan' => trim($row[5]),
                        'alamat' => trim($row[6]),
                    ];
                } else {
                    $skipped++;
                    $errors[] = "Baris {$rowNumber}: Kolom tidak lengkap.";
                    continue;
                }

                // Validate jenis_kelamin
                if (!in_array($data['jenis_kelamin'], ['Laki-laki', 'Perempuan'])) {
                    $skipped++;
                    $errors[] = "Baris {$rowNumber}: Jenis kelamin '{$data['jenis_kelamin']}' tidak valid.";
                    continue;
                }

                // Check duplicate NIP
                if (Pegawai::where('nip', $data['nip'])->exists()) {
                    $skipped++;
                    $errors[] = "Baris {$rowNumber}: NIP '{$data['nip']}' sudah terdaftar.";
                    continue;
                }

                try {
                    $pegawai = Pegawai::create($data);
                    AuditLog::record('import', 'Pegawai', $pegawai->id, null, $data);
                    $imported++;
                } catch (\Exception $e) {
                    $skipped++;
                    $errors[] = "Baris {$rowNumber}: Gagal menyimpan data.";
                }
            }

            fclose($handle);
        }

        $message = "{$imported} data berhasil diimpor.";
        if ($skipped > 0) {
            $message .= " {$skipped} data dilewati.";
        }

        return redirect()->route('pegawai.index')
            ->with('success', $message)
            ->with('import_errors', $errors);
    }
}
