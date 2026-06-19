<?php

namespace App\Services;

use App\Models\DTP;
use App\Repositories\DTPRepository;

class DTPServices
{
    protected DTPRepository $dtpRepo;

    public function __construct(DTPRepository $dtpRepo)
    {
        $this->dtpRepo = $dtpRepo;
    }

    public function store(array $data): DTP
    {

        if (isset($data['file'])) {
            $file_name = FileService::upload($data['file'], 'uploads/general/media/dtpDocument');
            $data['file'] = $file_name;
        }
        $data = $this->dtpRepo->store($data);

        return $data;
    }

    public function delete(int $id): DTP
    {
        $data = DTP::findOrFail($id);
        $result = $this->dtpRepo->delete($data);

        return $result;
    }

    public function update(array $data): DTP
    {
        $DTP = DTP::findOrFail(intval($data['id']));

        if (isset($data['file'])) {
            $file_name = FileService::upload($data['file'], 'uploads/general/media/dtpDocument');
            $data['file'] = $file_name;
        }
        $data = $this->dtpRepo->update($data);

        return $data;
    }
}
