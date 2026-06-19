<?php

namespace App\Services;

use App\Models\Writing;
use App\Models\Speaking;
use App\Repositories\SpeakAndWriteReposatory;

class SpeakAndWriteServices
{
    protected SpeakAndWriteReposatory $SpeakAndWriteReposatory;

    public function __construct(SpeakAndWriteReposatory $SpeakAndWriteReposatory)
    {
        $this->SpeakAndWriteReposatory = $SpeakAndWriteReposatory;
    }

    public function index($request)
    {

        $page = $request->get('ayis_page', 1);
        $qty = $request->get('qty', 10);
        $custom_pagination_path = $request->get('path', '');
        $sorting = $request->get('sorting', 'id');
        $direction = $request->get('direction', 'asc');
        $type = $request->type;
        if ($type == 'speak') {
            $User = Speaking::query();
        } else {
            $User = Writing::query();
        }



        if (! empty($request->name)) {
            $User->where('name', 'like', '%' . $request->name . '%');
        }

        if (! empty($request->email)) {
            $User->where('email', 'like', '%' . $request->email . '%');
        }

        if (! empty($request->phone)) {
            $User->where('phone_number', 'like', '%' . $request->phone . '%');
        }
        if (! empty($request->gender)) {
            $User->where('gender', $request->gender);
        }
        if ($type == 'speak') {
            $User->orderBy("speaking.$sorting", $direction);
        } else {
            $User->orderBy("writing.$sorting", $direction);
        }
        $data = $User->paginate($qty, ['*'], 'page', $page)->setPath($custom_pagination_path);
        return $data;
    }
}
