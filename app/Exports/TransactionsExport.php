<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{

    public function collection()
    {
        $transactions = Transaction::with('details.product')->latest()->get();
        $rows = collect();
        foreach ($transactions as $trx) {
            foreach ($trx->details as $detail) {
                $detail->transaction = $trx;
                $rows->push($detail);
            }
        }
        return $rows;
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
    public function map($detail): array
    {
        $trx = $detail->transaction;
        return [
            $trx->id,
            $trx->created_at->format('d-m-Y H:i'),
            $detail->product->name ?? '-',
            'Rp ' . number_format($detail->price, 0, ',', '.'),
            $detail->quantity,
            'Rp ' . number_format($detail->subtotal, 0, ',', '.'),
            ucfirst($trx->status),
        ];
    }
}