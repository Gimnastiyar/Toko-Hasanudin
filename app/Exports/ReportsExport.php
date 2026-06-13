<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Ambil data transaksi yang difilter tanggal dan berstatus sukses
     */
    public function collection()
    {
        $transactions = Transaction::with('details.product')
            ->whereIn('status', ['completed', 'success'])
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->latest()
            ->get();

        $rows = collect();
        foreach ($transactions as $trx) {
            foreach ($trx->details as $detail) {
                $detail->transaction = $trx;
                $rows->push($detail);
            }
        }

        return $rows;
    }

    /**
     * Header kolom Excel
     */
    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Tanggal',
            'Produk',
            'Harga Jual Satuan',
            'Harga Pokok (HPP)',
            'Jumlah (Qty)',
            'Diskon Diberikan',
            'Total Omzet Bersih',
            'Laba Kotor Penjualan',
        ];
    }

    /**
     * Pemetaan baris data
     */
    public function map($detail): array
    {
        $trx = $detail->transaction;
        $price = $detail->price;
        $costPrice = $detail->cost_price ?? 0;
        $qty = $detail->quantity;
        $subtotal = $detail->subtotal;
        
        $trxSubtotal = $trx->details->sum('subtotal');
        $trxDiscount = $trx->discount ?? 0;
        if ($trx->discount_type == 'percent') {
            $trxDiscountValue = ($trxDiscount / 100) * $trxSubtotal;
        } else {
            $trxDiscountValue = $trxDiscount;
        }
        
        $discountValue = $trxSubtotal > 0 ? ($subtotal / $trxSubtotal) * $trxDiscountValue : 0;

        $revenue = $subtotal - $discountValue;
        $cost = $costPrice * $qty;
        $profit = $revenue - $cost;

        return [
            'TRX-' . str_pad($trx->id, 5, '0', STR_PAD_LEFT),
            $trx->created_at->format('d-m-Y H:i'),
            $detail->product->name ?? 'Produk Dihapus',
            $price,
            $costPrice,
            $qty,
            $discountValue,
            $revenue,
            $profit,
        ];
    }
}
