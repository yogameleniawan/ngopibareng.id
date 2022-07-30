<?php

namespace App\Exports;

use App\Invoice;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class UsersExport implements FromQuery
{
    use Exportable;

    public function query()
    {
        return User::query();
    }
}
