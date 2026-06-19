<?php

namespace App\Services;

use App\Models\Education;
use App\Models\User;
use App\Repositories\EmailSendRepository;

class EmailSendServices
{
    protected EmailSendRepository $emailSendRepo;

    public function __construct(EmailSendRepository $emailSendRepo)
    {
        $this->emailSendRepo = $emailSendRepo;
    }

    public function store(array $data): Education
    {
        $file_name = FileService::upload($data['education_document'], 'uploads/general/media/educationDocument');
        $data['education_document'] = $file_name;
        $data = $this->educationRepo->store($data);

        return $data;
    }

    public function delete(int $id): Education
    {
        $data = Education::findOrFail($id);
        $result = $this->educationRepo->delete($data);

        return $result;
    }

    public function update(array $data): Education
    {
        $education = Education::findOrFail($data['education_id']);

        if (isset($data['education_document'])) {
            FileService::delete($education->education_document);
            $file_name = FileService::upload(
                $data['education_document'],
                'uploads/general/media/educationDocument'
            );
            $data['education_document'] = $file_name;
        }
        $data = $this->educationRepo->update($data);

        return $data;
    }

    public function index($request)
    {

        $page = $request->get('ayis_page', 1);
        $qty = $request->get('qty', 10);
        $custom_pagination_path = $request->get('path', '');
        $sorting = $request->get('sorting', 'id');
        $direction = $request->get('direction', 'asc');
        $User = User::query();

        if (! empty($request->name)) {
            $User->where('name', 'like', '%'.$request->name.'%');
        }

        if (! empty($request->email)) {
            $User->where('email', 'like', '%'.$request->email.'%');
        }

        if (! empty($request->phone)) {
            $User->where('phone_number', 'like', '%'.$request->phone.'%');
        }
        if (! empty($request->gender)) {
            $User->where('gender', $request->gender);
        }

        $User->orderBy("users.$sorting", $direction);
        $data = $User->paginate($qty, ['*'], 'page', $page)->setPath($custom_pagination_path);

        return $data;
    }
}
