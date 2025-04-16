<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Nama User',
            'Email',
            'Role',
        ];
    }

    public function collection()
    {
        return User::get()->map(function ($user) {
            return [
                'Nama User'  => $user->name,
                'Email' => $user->email,
                'Role' => $user->role,
            ];
        });
    }
}
