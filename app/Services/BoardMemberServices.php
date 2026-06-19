<?php

namespace App\Services;

use App\Models\BoardComitteeMember;
use App\Repositories\BoardMemberRepository;

class BoardMemberServices
{
    protected BoardMemberRepository $boardmemberRepo;

    public function __construct(BoardMemberRepository $boardmemberRepo)
    {
        $this->boardmemberRepo = $boardmemberRepo;
    }

    public function store(array $data): BoardComitteeMember
    {
        $data = $this->boardmemberRepo->store($data);

        return $data;
    }

    public function delete(int $id): BoardComitteeMember
    {
        $data = BoardComitteeMember::findOrFail($id);
        $result = $this->boardmemberRepo->delete($data);

        return $result;
    }

    public function update(array $data): BoardComitteeMember
    {
        $data = $this->boardmemberRepo->update($data);

        return $data;
    }
}
