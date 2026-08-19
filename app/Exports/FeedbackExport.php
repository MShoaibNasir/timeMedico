<?php

namespace App\Exports;

use App\Models\Feedback;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FeedbackExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected Builder $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function collection(): Collection
    {
        return $this->query->with('user')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Customer Name',
            'Customer Phone',
            'Email',
            'Subject',
            'Message',
            'User ID',
            'Status',
            'Submitted At',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->user->name ?? 'Guest / N/A',
            $row->user->phone_number ?? '',
            $row->email ?: ($row->user->email ?? ''),
            $row->subject ?? '',
            $row->message ?? '',
            $row->user_id ?? '',
            (int) $row->status === 1 ? 'Active' : 'Inactive',
            optional($row->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
