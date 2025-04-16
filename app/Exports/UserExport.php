<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class UserExport implements FromCollection, WithHeadings, WithEvents, WithCustomStartCell
{
    public function startCell(): string
    {
        // Mulai header kolom dari sel A2
        return 'A2';
    }

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
                $user->name,
                $user->email,
                $user->role,
            ];
        });
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Tambahkan judul di baris pertama
                $event->sheet->setCellValue('A1', 'Data User');
                $event->sheet->mergeCells('A1:C1');
                $event->sheet->getDelegate()->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}
