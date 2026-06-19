<?php

namespace App\Repositories;

use App\Models\DTP;

class DTPRepository
{
    public function store(array $data): DTP
    {
        return DTP::create($data);
    }

    public function delete(DTP $dtp): DTP
    {
        $dtp->delete();

        return $dtp;
    }

    public function update(array $data): DTP
    {
        $dtp = DTP::findOrFail($data['id']);
        $dtp->update([
            'name' => $data['name'],
            'type' => $data['type'],
            'link' => $data['link'],
            'resource_type' => $data['resource_type'],
            'file' => $data['file'] ?? null,
            'price' => $data['price'],
            'date' => $data['date'],
        ]);

        return $dtp->fresh();
    }
}
