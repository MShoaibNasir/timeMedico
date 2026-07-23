<?php

namespace App\Services;

use App\Models\Area;
use App\Repositories\AreaReposatory;

class AreaServices
{
    protected AreaReposatory $arearepo;

    public function __construct(AreaReposatory $arearepo)
    {
        $this->arearepo = $arearepo;
    }

    public function UpdateBulkPrice(array $data)
    {
        $result = $this->arearepo->UpdateBulkPrice($data);
        return $result;
    }
}
