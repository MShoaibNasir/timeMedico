<?php

namespace App\Repositories;

use App\Models\Communication;

class CommunicationRepository
{
    public function store(array $data): Communication
    {

        return Communication::create($data);
    }

    public function delete(Communication $data): Communication
    {
        $data->delete();
        return $data;
    }

    public function update(array $data): Communication
    {
        $board_data = Communication::findOrFail($data['id']);
        $board_data->update($data);
        return $board_data->fresh();
    }

    public function changeStatus($data)
    {
        $update_data = Communication::find($data['id']);
        $update_data->update(['status' => $data['status']]);
        return $update_data->fresh();
    }
}
