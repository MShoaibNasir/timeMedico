<?php

namespace App\Services;

use App\Models\Communication;
use App\Repositories\CommunicationRepository;

class CommunicationServices
{
    protected CommunicationRepository $communicationRepo;

    public function __construct(CommunicationRepository $communicationRepo)
    {
        $this->communicationRepo = $communicationRepo;
    }

    public function store(array $data): Communication
    {
        if (isset($data['video'])) {
            $file_name = FileService::upload($data['video'], 'uploads/general/media/communication');
            $data['video'] = $file_name;
        }
        $data = $this->communicationRepo->store($data);
        return $data;
    }

    public function delete(int $id): Communication
    {
        $data = Communication::findOrFail($id);
        $result = $this->communicationRepo->delete($data);
        return $result;
    }

    public function update(array $data): Communication
    {
        if (isset($data['video'])) {
            $file_name = FileService::upload($data['video'], 'uploads/general/media/communication');
            $data['video'] = $file_name;
        }
        $data = $this->communicationRepo->update($data);
        return $data;
    }
    public function changeStatus(int $id)
    {
        $data = Communication::where('id', $id)->select('status')->first();
        $data['id'] = $id;
        if ($data->status == 0) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        };
      
        $result = $this->communicationRepo->changeStatus($data);
    }
}
