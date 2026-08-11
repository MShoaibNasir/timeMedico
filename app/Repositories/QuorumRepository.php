<?php

namespace App\Repositories;

use App\Models\Quorum;

class QuorumRepository
{
    public function store(array $data): Quorum
    {
        return Quorum::create($data);
    }

    public function delete(Quorum $data): Quorum
    {
        $data->delete();

        return $data;
    }

    public function update(array $data): Quorum
    {
        $quorum = Quorum::findOrFail($data['id']);
        $quorum->update($data);

        return $quorum->fresh();
    }
}
