<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
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
                'Nama Pelanggan'  => $product->name,
                'Stok' => $product->stok,
                'Harga'     => 'Rp ' . number_format($product->price, 0, ',', '.'),
            ];
        });
    }
}
