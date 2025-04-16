<?php

namespace App\Exports;

use App\Models\Detail_sale;
use App\Models\Sale;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'Nama Pelanggan',
            'No HP Pelanggan',
            'Poin Pelanggan',
            'Produk',
            'Harga Satuan',
            'Jumlah',
            'Total Harga',
            'Total Bayar',
            'Total Diskon',
            'Total Kembalian',
            'Tanggal Pembelian',
        ];
    }

    public function collection()
    {
        $details = Detail_sale::with(['sale.member', 'product'])->orderBy('sale_id')->get();

        $lastSaleId = null;

        return $details->map(function ($detail) use (&$lastSaleId) {
            $sale = $detail->sale;
            $member = $sale->member;
            $isFirstRow = $sale->id !== $lastSaleId;
            $lastSaleId = $sale->id;

            return [
                'Nama Pelanggan'  => $isFirstRow ? ($member->name ?? 'Bukan Member') : '',
                'No HP Pelanggan' => $isFirstRow ? ($member->telephone ?? '-') : '',
                'Poin Pelanggan'  => $isFirstRow ? ($member->point ?? '') : '',
                'Produk'          => $detail->product->name ?? '-',
                'Harga Satuan'    => 'Rp ' . number_format($detail->sub_total / $detail->quantity, 0, ',', '.'),
                'Jumlah'          => $detail->quantity,
                'Subtotal'        => 'Rp ' . number_format($detail->sub_total, 0, ',', '.'),
                'Total Bayar'     => $isFirstRow ? ('Rp ' . number_format($sale->total_pay, 0, ',', '.')) : '',
                'Total Diskon'    => $isFirstRow ? ($sale->used_point > 0 ? 'Rp ' . number_format($sale->discount, 0, ',', '.') : 'Rp 0') : '',
                'Total Kembalian' => $isFirstRow ? ('Rp ' . number_format($sale->total_return, 0, ',', '.')) : '',
                'Tanggal Beli'    => $isFirstRow ? $sale->created_at->format('d-m-Y') : '',
            ];
        });
    }
}
