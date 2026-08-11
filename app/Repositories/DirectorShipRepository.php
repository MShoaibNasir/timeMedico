<?php

namespace App\Repositories;

use App\Models\Directorship;

class DirectorShipRepository
{
    public function store(array $data): Directorship
    {

        return Directorship::create($data);
    }

    public function delete(Directorship $directorship): Directorship
    {
        $directorship->delete();

        return $directorship;
    }

    public function update(array $data): Directorship
    {
        $education = Directorship::findOrFail($data['id']);
        $education->update($data);

        return $education->fresh();
    }
}
