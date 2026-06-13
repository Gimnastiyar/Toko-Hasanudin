<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan - Sistem Kasir Toko Hasan</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 20mm 20mm 20mm 20mm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11px;
            color: #000000;
            background-color: #ffffff;
            line-height: 1.6;
            width: 170mm; /* Sesuai margin 20mm kiri-kanan pada A4 (210mm - 40mm) */
            margin: 0 auto;
        }

        .header {
            text-align: center;
            position: relative;
            margin-bottom: 5px;
        }

        .logo-placeholder {
            width: 40px;
            height: 40px;
            border: 1.5px solid #000000;
            margin: 0 auto 10px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 1px;
            margin: 0;
            text-transform: uppercase;
        }

        .subtitle {
            font-size: 12px;
            font-weight: bold;
            margin: 3px 0 0 0;
            text-transform: uppercase;
        }

        .period {
            font-size: 11px;
            margin: 5px 0 0 0;
            font-style: italic;
        }

        .divider {
            border-top: 1.5px solid #000000;
            border-bottom: 0.5px solid #000000;
            height: 3px;
            margin: 10px 0 20px 0;
        }

        .section-title {
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 8px;
            text-align: left;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #000000;
            padding: 6px 8px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .font-mono {
            font-family: 'Courier New', Courier, monospace;
        }

        /* 2-Column Summary Table Style */
        .summary-table {
            width: 100mm;
            margin-bottom: 25px;
        }

        .summary-table td {
            padding: 6px 10px;
        }

        .summary-table td.label {
            font-weight: bold;
            width: 50%;
        }

        .summary-table td.value {
            text-align: right;
            font-family: 'Courier New', Courier, monospace;
        }

        /* Footer */
        .footer-table {
            border: none;
            width: 100%;
            margin-top: 30px;
        }

        .footer-table td {
            border: none;
            padding: 0;
        }

        .footer-text {
            font-size: 10px;
            color: #000000;
        }

        .signature-area {
            text-align: center;
            float: right;
            width: 60mm;
            margin-top: 20px;
        }

        .signature-line {
            border-bottom: 1px solid #000000;
            margin-top: 50px;
            margin-bottom: 5px;
            width: 45mm;
            margin-left: auto;
            margin-right: auto;
        }

        .no-print-bar {
            background-color: #f1f5f9;
            border: 1px solid #cbd5e1;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            background-color: #1e293b;
            color: #ffffff;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-white {
            background-color: #ffffff;
            color: #334155;
            border: 1px solid #cbd5e1;
        }

        @media print {
            .no-print-bar {
                display: none !important;
            }

            body {
                width: 100%;
                margin: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <!-- BAR CETAK (TIDAK AKAN DICETAK) -->
    <div class="no-print-bar">
        <span style="font-family: Arial, sans-serif; font-size: 12px; color: #475569;">
            💡 Dokumen siap cetak A4 Portrait. Silakan simpan sebagai PDF atau cetak langsung.
        </span>
        <div style="display: flex; gap: 8px;">
            <button onclick="window.print()" class="btn">Cetak Laporan</button>
            <a href="{{ route('reports.index') }}" class="btn btn-white">Kembali</a>
        </div>
    </div>

    <!-- HEADER LAPORAN -->
    <div class="header">
        <div class="logo-placeholder">TH</div>
        <h1 class="title">LAPORAN KEUANGAN</h1>
        <h2 class="subtitle">SISTEM KASIR TOKO HASAN</h2>
        <p class="period">Periode: {{ $startDate->translatedFormat('d F Y') }} s.d. {{ $endDate->translatedFormat('d F Y') }}</p>
    </div>

    <div class="divider"></div>

    <!-- RINGKASAN KEUANGAN (TABEL RINGKAS 2-KOLOM) -->
    <div class="section-title">I. Ringkasan Keuangan</div>
    <table class="summary-table">
        <thead>
            <tr>
                <th style="text-align: left;">Keterangan</th>
                <th style="text-align: right;">Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="label">Total Omzet</td>
                <td class="value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Total Modal (HPP)</td>
                <td class="value">Rp {{ number_format($totalCost, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Total Diskon</td>
                <td class="value">Rp {{ number_format($totalDiscount, 0, ',', '.') }}</td>
            </tr>
            <tr style="font-weight: bold; background-color: #f9f9f9;">
                <td class="label" style="border-top: 1.5px solid #000000;">Laba Bersih</td>
                <td class="value" style="border-top: 1.5px solid #000000;">Rp {{ number_format($netProfit, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- TABEL DETAIL TRANSAKSI (8 KOLOM) -->
    <div class="section-title">II. Buku Rincian Transaksi Penjualan</div>
    <table>
        <thead>
            <tr>
                <th style="width: 8mm;">No</th>
                <th style="width: 22mm;">Tanggal</th>
                <th>Nama Produk</th>
                <th style="width: 25mm; text-align: right;">Harga</th>
                <th style="width: 10mm; text-align: center;">Qty</th>
                <th style="width: 20mm; text-align: right;">Diskon</th>
                <th style="width: 25mm; text-align: right;">Total</th>
                <th style="width: 25mm; text-align: right;">Profit</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($transactions as $trx)
                @php
                    $trxSubtotal = $trx->details->sum('subtotal');
                    $trxDiscount = $trx->discount ?? 0;
                    if ($trx->discount_type == 'percent') {
                        $trxDiscountValue = ($trxDiscount / 100) * $trxSubtotal;
                    } else {
                        $trxDiscountValue = $trxDiscount;
                    }
                @endphp
                @foreach($trx->details as $detail)
                    @php
                        $price = $detail->price;
                        $qty = $detail->quantity;
                        $detailDiscount = $trxSubtotal > 0 ? ($detail->subtotal / $trxSubtotal) * $trxDiscountValue : 0;
                        $detailTotal = $detail->subtotal - $detailDiscount;
                        $detailCost = ($detail->cost_price ?? 0) * $qty;
                        $detailProfit = $detailTotal - $detailCost;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-center">{{ $trx->created_at->format('d/m/Y') }}</td>
                        <td>{{ $detail->product->name ?? 'Produk Dihapus' }}</td>
                        <td class="text-right font-mono">Rp {{ number_format($price, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $qty }}</td>
                        <td class="text-right font-mono">
                            @if($detailDiscount > 0)
                                Rp {{ number_format($detailDiscount, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="text-right font-mono">Rp {{ number_format($detailTotal, 0, ',', '.') }}</td>
                        <td class="text-right font-mono" style="font-weight: bold;">Rp {{ number_format($detailProfit, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="8" class="text-center" style="padding: 20px; font-style: italic;">Tidak ada data transaksi pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- TANDA TANGAN -->
    <div class="signature-area">
        <p style="margin: 0; font-weight: bold;">Mengetahui,</p>
        <p style="margin: 3px 0 0 0; font-weight: bold;">Pemilik Toko Hasan</p>
        <div class="signature-line"></div>
        <p style="margin: 0; font-weight: bold;">( Hasanudin )</p>
    </div>

    <!-- FOOTER LAPORAN -->
    <div style="clear: both; margin-top: 60px; border-top: 1px solid #000000; padding-top: 8px;">
        <table class="footer-table">
            <tbody>
                <tr class="footer-text">
                    <td style="text-align: left;">Sistem Kasir Toko Hasan</td>
                    <td style="text-align: center;">Halaman 1 dari 1</td>
                    <td style="text-align: right;">Dicetak pada: {{ now()->translatedFormat('d F Y, H:i') }} WIB</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>
