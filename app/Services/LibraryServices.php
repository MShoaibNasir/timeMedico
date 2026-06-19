<?php

namespace App\Services;

use App\Models\ResourceLibrary;
use App\Repositories\LibraryRepository;

class LibraryServices
{
    protected LibraryRepository $libraryRepo;

    public function __construct(LibraryRepository $libraryRepo)
    {
        $this->libraryRepo = $libraryRepo;
    }

    public function store(array $data): ResourceLibrary
    {

        if (isset($data['file'])) {
            $file_name = FileService::upload($data['file'], 'uploads/general/media/library');
            $data['file'] = $file_name;
        }
        if (isset($data['banner_pic'])) {
            $file_name = FileService::upload($data['banner_pic'], 'uploads/general/media/library/banner');
            $data['banner_pic'] = $file_name;
        }
        $data = $this->libraryRepo->store($data);

        return $data;
    }

    public function delete(int $id): ResourceLibrary
    {
        $data = ResourceLibrary::findOrFail($id);
        $result = $this->libraryRepo->delete($data);

        return $result;
    }

    public function update(array $data): ResourceLibrary
    {
        ResourceLibrary::findOrFail(intval($data['id']));

        if (isset($data['file'])) {
            $file_name = FileService::upload($data['file'], 'uploads/general/media/library');
            $data['file'] = $file_name;
        }
        if (isset($data['banner_pic'])) {
            $file_name = FileService::upload($data['banner_pic'], 'uploads/general/media/library/banner');
            $data['banner_pic'] = $file_name;
        }
        $data = $this->libraryRepo->update($data);

        return $data;
    }
}
