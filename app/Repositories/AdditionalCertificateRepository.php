<?php

namespace App\Repositories;

use App\Models\AdditionalCertificate;

class AdditionalCertificateRepository
{
    public function store(array $data): AdditionalCertificate
    {

        return AdditionalCertificate::create($data);
    }

    public function delete(AdditionalCertificate $directorship): AdditionalCertificate
    {
        $directorship->delete();

        return $directorship;
    }

    public function update(array $data): AdditionalCertificate
    {
        $education = AdditionalCertificate::findOrFail($data['id']);
        $education->update($data);

        return $education->fresh();
    }
}
