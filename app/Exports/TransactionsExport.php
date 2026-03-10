<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{

    // Ambil data transaksi
    public function collection()
    {
        return Transaction::with('product')->latest()->get();
    }

    // Header kolom Excel
    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Tanggal',
            'Produk',
            'Harga Satuan',
            'Jumlah',
            'Total',
            'Status',
        ];
    }

    // Mapping data
    public function map($trx): array
    {
        return [
            $trx->id,
            $trx->created_at->format('d-m-Y H:i'),
            $trx->product->name ?? '-',
            'Rp ' . number_format($trx->product->price ?? 0,0,',','.'),
            $trx->quantity,
            'Rp ' . number_format($trx->total_price,0,',','.'),
            ucfirst($trx->status),
        ];
    }
}