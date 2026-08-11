<?php

namespace App\Http\Controllers\API;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends BaseController
{
    /**
     * Active areas list for mobile/web clients.
     * Filter: ?serviceable=1 (local) or ?serviceable=0 (courier-only / non-serviceable)
     */
    public function list(Request $request)
    {
        $query = Area::active()->orderBy('name');

        if ($request->filled('serviceable')) {
            if ((string) $request->serviceable === '1') {
                $query->serviceable();
            } elseif ((string) $request->serviceable === '0') {
                $query->nonServiceable();
            }
        }

        return $query->get([
            'id',
            'name',
            'delivery_charges',
            'status',
            'is_service_able',
            'created_at',
            'updated_at',
        ]);
    }
}
