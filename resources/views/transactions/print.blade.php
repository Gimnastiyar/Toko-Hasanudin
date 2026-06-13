<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk #{{ $transaction->id }}</title>
    <style>
        /* BASE & SCREEN STYLES */
        body {
            font-family: "Courier New", Courier, monospace;
            font-size: 12px;
            line-height: 1.4;
            color: #000000;
            background-color: #f3f4f6;
            margin: 0;
            padding: 40px 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .receipt-container {
            width: 80mm;
            background-color: #ffffff;
            padding: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            box-sizing: border-box;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-bold {
            font-weight: bold;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .border-dashed-bottom {
            border-bottom: 1px dashed #000000;
            padding-bottom: 8px;
            margin-bottom: 8px;
        }

        .border-dashed-top {
            border-top: 1px dashed #000000;
            padding-top: 8px;
            margin-top: 8px;
        }

        .my-2 {
            margin-top: 8px;
            margin-bottom: 8px;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .mt-3 {
            margin-top: 12px;
        }

        .flex {
            display: flex;
        }

        .justify-between {
            display: flex;
            justify-content: space-between;
        }

        .text-lg {
            font-size: 16px;
        }

        .text-sm {
            font-size: 13px;
        }

        .text-xs {
            font-size: 11px;
        }

        .text-xxs {
            font-size: 10px;
        }

        .text-red {
            color: #b91c1c;
        }

        /* PRINT STYLES - Optimized for Thermal Receipt Printers */
        @media print {
            @page {
                margin: 0;
            }

            body {
                background: none !important;
                background-color: #ffffff !important;
                margin: 0 !important;
                padding: 0 !important;
                display: block !important;
                width: 100% !important;
            }

            .receipt-container {
                width: 100% !important;
                max-width: 80mm !important;
                padding: 4mm !important;
                margin: 0 auto !important;
                box-shadow: none !important;
                background: none !important;
                border: none !important;
            }

            * {
                color: #000000 !important;
                text-shadow: none !important;
                background: transparent !important;
                box-shadow: none !important;
            }

            .text-red {
                color: #000000 !important;
            }
        }
    </style>
</head>

@php
    $subtotal = $transaction->details->sum('subtotal');
    $discount = $transaction->discount ?? 0;
    $type = $transaction->discount_type ?? 'nominal';

    if ($type == 'percent') {
        $discountValue = ($discount / 100) * $subtotal;
    } else {
        $discountValue = $discount;
    }

    $total = max(0, $subtotal - $discountValue);
@endphp

<body onload="window.print()">

    <div class="receipt-container">

        <!-- HEADER -->
        <div class="text-center border-dashed-bottom">
            <h1 class="font-bold text-lg uppercase">TOKO HASAN</h1>
            <p>Jl. Subang No.123</p>
            <p>Telp: 0812-3456789</p>
        </div>

        <!-- INFO TRANSAKSI -->
        <div class="mb-2">
            <div class="justify-between">
                <span>No Transaksi</span>
                <span>#{{ $transaction->id }}</span>
            </div>

            <div class="justify-between">
                <span>Tanggal</span>
                <span>{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
            </div>

            <div class="justify-between">
                <span>Kasir</span>
                <span>{{ $transaction->user->name ?? 'Admin' }}</span>
            </div>

            @if($transaction->customer)
            <div class="justify-between font-bold">
                <span>Pelanggan</span>
                <span>{{ $transaction->customer->nama }}</span>
            </div>
            @endif
        </div>

        <div class="border-dashed-bottom my-2"></div>

        <!-- ITEM -->
        @foreach($transaction->details as $detail)
        <div class="mb-2">
            <div class="font-bold">
                {{ $detail->product->name ?? 'Produk Dihapus' }}
            </div>
            <div class="justify-between">
                <span>
                    {{ $detail->quantity }} x {{ number_format($detail->price, 0, ',', '.') }}
                </span>
                <span>
                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                </span>
            </div>
        </div>
        @endforeach

        <div class="border-dashed-bottom my-2"></div>

        <!-- TOTALS & DISCOUNTS -->
        <div class="text-xs">
            <div class="justify-between">
                <span>Subtotal</span>
                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>

            @if($discount > 0)
            <div class="justify-between">
                <span>Diskon</span>
                <span>
                    {{ $type == 'percent' ? $discount . '%' : 'Rp ' . number_format($discount, 0, ',', '.') }}
                </span>
            </div>
            <div class="justify-between text-red">
                <span>Potongan</span>
                <span>- Rp {{ number_format($discountValue, 0, ',', '.') }}</span>
            </div>
            @endif
        </div>

        <!-- GRAND TOTAL -->
        <div class="justify-between font-bold text-sm border-dashed-top border-dashed-bottom my-2" style="padding: 4px 0;">
            <span>TOTAL</span>
            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>

        <!-- FOOTER -->
        <div class="text-center mt-3 text-xxs">
            <p>Terima kasih sudah berbelanja</p>
            <p>Barang yang sudah dibeli</p>
            <p>tidak dapat dikembalikan</p>
        </div>

    </div>

</body>

</html>