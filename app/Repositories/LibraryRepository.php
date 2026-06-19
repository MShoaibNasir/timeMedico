<?php

namespace App\Repositories;

use App\Models\ResourceLibrary;

class LibraryRepository
{
    public function store(array $data): ResourceLibrary
    {
        return ResourceLibrary::create($data);
    }

    public function delete(ResourceLibrary $data): ResourceLibrary
    {
        $data->delete();

        return $data;
    }

    public function update(array $data): ResourceLibrary
    {
        $dtp = ResourceLibrary::findOrFail($data['id']);
        $dtp->update([
            'name' => $data['name'],
            // 'type' => $data['type'],
            'link' => $data['link'] ?? null,
            'resource_type' => $data['resource_type'] ?? null,
            'file' => $data['file'] ?? null,
            'banner_pic' => $data['banner_pic'] ?? null,
            'quorum_id' => $data['quorum_id'] ?? null,
        ]);

        return $dtp->fresh();
    }
}
