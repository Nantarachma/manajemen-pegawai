<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Display paginated audit logs.
     */
    public function index(Request $request)
    {
        $query = AuditLog::with('user')->latest();

        // Filter by action type
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Search by user name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $logs = $query->paginate(15)->withQueryString();

        return view('audit.index', compact('logs'));
    }
}
