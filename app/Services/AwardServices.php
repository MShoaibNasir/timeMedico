<?php

namespace App\Services;

use App\Models\Award;
use App\Repositories\AwardRepository;

class AwardServices
{
    protected AwardRepository $awardrepo;

    public function __construct(AwardRepository $awardrepo)
    {
        $this->awardrepo = $awardrepo;
    }

    public function store(array $data): Award
    {

        $data = $this->awardrepo->store($data);

        return $data;
    }

    public function delete(int $id): Award
    {
        $data = Award::findOrFail($id);
        $result = $this->awardrepo->delete($data);

        return $result;
    }

    public function update(array $data): Award
    {

        $data = $this->awardrepo->update($data);

        return $data;
    }
}
