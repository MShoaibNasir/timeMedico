<?php

namespace App\Services;

use App\Models\Quorum;
use App\Repositories\QuorumRepository;

class QuorumServices
{
    protected QuorumRepository $quorumRepo;

    public function __construct(QuorumRepository $quorumRepo)
    {
        $this->quorumRepo = $quorumRepo;
    }

    public function store(array $data): Quorum
    {

        $data = $this->quorumRepo->store($data);

        return $data;
    }

    public function delete(int $id): Quorum
    {
        $data = Quorum::findOrFail($id);
        $result = $this->quorumRepo->delete($data);

        return $result;
    }

    public function update(array $data): Quorum
    {
        Quorum::findOrFail(intval($data['id']));
        $data = $this->quorumRepo->update($data);

        return $data;
    }
}
