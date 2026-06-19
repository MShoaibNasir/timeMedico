<?php

namespace App\Services;

use App\Models\Publication;
use App\Repositories\PublicationRepository;

class PublicationServices
{
    protected PublicationRepository $pubrepo;

    public function __construct(PublicationRepository $pubrepo)
    {
        $this->pubrepo = $pubrepo;
    }

    public function store(array $data): Publication
    {

        $data = $this->pubrepo->store($data);
        return $data;
    }

    public function delete(int $id): Publication
    {
        $data = Publication::findOrFail($id);
        $result = $this->pubrepo->delete($data);
        return $result;
    }

    public function update(array $data): Publication
    {

        $data = $this->pubrepo->update($data);

        return $data;
    }
}
