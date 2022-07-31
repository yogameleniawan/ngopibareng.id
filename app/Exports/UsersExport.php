<?php

namespace App\Exports;

use App\Invoice;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function query()
    {
        return User::query()->first();
    }

    public function headings(): array
    {
        return [
            '#',
            'Email',
            'Name',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->email,
            $user->name,
        ];
    }

    public function fields(): array
    {
        return [
            'id',
            'email',
            'name',
        ];
    }
}
