<?php

namespace App\Repositories;

use App\Models\BoardComitteeMember;

class BoardMemberRepository
{
    public function store(array $data): BoardComitteeMember
    {

        return BoardComitteeMember::create($data);
    }

    public function delete(BoardComitteeMember $data): BoardComitteeMember
    {
        $data->delete();

        return $data;
    }

    public function update(array $data): BoardComitteeMember
    {
        $board_data = BoardComitteeMember::findOrFail($data['id']);
        $board_data->update($data);

        return $board_data->fresh();
    }
}
