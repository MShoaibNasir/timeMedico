<?php

namespace App\Services;

use App\Models\Directorship;
use App\Repositories\DirectorShipRepository;

class DirectorShipServices
{
    protected DirectorShipRepository $directorshipRepo;

    public function __construct(DirectorShipRepository $directorshipRepo)
    {
        $this->directorshipRepo = $directorshipRepo;
    }

    public function store(array $data): Directorship
    {
        $data = $this->directorshipRepo->store($data);

        return $data;
    }

    public function delete(int $id): Directorship
    {
        $data = Directorship::findOrFail($id);
        $result = $this->directorshipRepo->delete($data);

        return $result;
    }

    public function update(array $data): Directorship
    {
        $data = $this->directorshipRepo->update($data);

        return $data;
    }
}
