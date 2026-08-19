<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MasterLog;
use Illuminate\Http\Request;

class MasterLogController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'q' => $request->get('q', ''),
            'source' => $request->get('source', ''),
            'actor_type' => $request->get('actor_type', ''),
            'action' => $request->get('action', ''),
            'module' => $request->get('module', ''),
            'date_from' => $request->get('date_from', ''),
            'date_to' => $request->get('date_to', ''),
        ];

        $logs = MasterLog::query()
            ->filter($filters)
            ->latest('id')
            ->paginate(50)
            ->withQueryString();

        $sources = MasterLog::query()
            ->whereNotNull('source')
            ->distinct()
            ->orderBy('source')
            ->pluck('source');

        $actorTypes = MasterLog::query()
            ->whereNotNull('actor_type')
            ->distinct()
            ->orderBy('actor_type')
            ->pluck('actor_type');

        $actions = MasterLog::query()
            ->whereNotNull('action')
            ->distinct()
            ->orderBy('action')
            ->pluck('action');

        $modules = MasterLog::query()
            ->whereNotNull('module')
            ->distinct()
            ->orderBy('module')
            ->pluck('module');

        return view('backend.master-logs.index', compact(
            'logs',
            'filters',
            'sources',
            'actorTypes',
            'actions',
            'modules'
        ));
    }

    public function show($id)
    {
        $item = MasterLog::findOrFail($id);

        return view('backend.master-logs.show', compact('item'));
    }
}
