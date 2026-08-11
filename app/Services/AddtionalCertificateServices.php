<?php

namespace App\Services;

use App\Models\AdditionalCertificate;
use App\Repositories\AdditionalCertificateRepository;

class AddtionalCertificateServices
{
    protected AdditionalCertificateRepository $aditionalCertificateRepo;

    public function __construct(AdditionalCertificateRepository $aditionalCertificateRepo)
    {
        $this->aditionalCertificateRepo = $aditionalCertificateRepo;
    }

    public function store(array $data): AdditionalCertificate
    {
        $data = $this->aditionalCertificateRepo->store($data);
        return $data;
    }

    public function delete(int $id): AdditionalCertificate
    {
        $data = AdditionalCertificate::findOrFail($id);
        $result = $this->aditionalCertificateRepo->delete($data);

        return $result;
    }

    public function update(array $data): AdditionalCertificate
    {
        $data = $this->aditionalCertificateRepo->update($data);

        return $data;
    }
}
