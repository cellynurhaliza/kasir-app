<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class ProductExport implements FromCollection, WithHeadings, WithEvents, WithCustomStartCell
{
    public function startCell(): string
    {
        // Header akan dimulai dari sel A2
        return 'A2';
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Stok',
            'Harga',
        ];
    }

    public function collection()
    {
        return Product::get()->map(function ($product) {
            return [
                $product->name,
                $product->stok,
                'Rp ' . number_format($product->price, 0, ',', '.'),
            ];
        });
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Menulis judul di baris pertama
                $event->sheet->setCellValue('A1', 'Data Produk');

                // Merge cell judul (misalnya A1 sampai C1)
                $event->sheet->mergeCells('A1:C1');

                // Styling judul (opsional)
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
