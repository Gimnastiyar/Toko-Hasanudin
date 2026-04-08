<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('layouts.app', function ($view) {
            $notifications = collect();

            // 1. Stok Menipis
            $lowStockProducts = \App\Models\Product::where('stock', '<=', 5)->get();
            foreach($lowStockProducts as $p) {
                $notifications->push([
                    'type' => 'warning',
                    'title' => 'Stok Menipis',
                    'message' => "Stok <b>{$p->name}</b> tersisa {$p->stock} pcs",
                    'icon' => 'cube',
                    'time' => $p->updated_at ? $p->updated_at->diffForHumans() : 'baru saja'
                ]);
            }

            // 2. Produk Expired & Akan Expired
            $expiringProducts = \App\Models\Product::whereNotNull('expired_date')
                ->where('expired_date', '<=', now()->addDays(7))
                ->get();
            foreach($expiringProducts as $p) {
                $diff = now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($p->expired_date)->startOfDay(), false);
                $msg = $diff < 0 ? "Telah kadaluarsa sejak " . abs($diff) . " hari lalu" : ($diff == 0 ? "Kadaluarsa hari ini!" : "Akan kadaluarsa dalam {$diff} hari");
                $notifications->push([
                    'type' => $diff <= 0 ? 'danger' : 'warning',
                    'title' => 'Peringatan Kadaluarsa',
                    'message' => "<b>{$p->name}</b> - {$msg}",
                    'icon' => 'clock',
                    'time' => \Carbon\Carbon::parse($p->expired_date)->format('d M Y')
                ]);
            }

            // 3. Hutang Supplier Mendekati Jatuh Tempo
            $suppliersWithDebt = \App\Models\Supplier::where('saldo_hutang', '>', 0)->get();
            foreach($suppliersWithDebt as $s) {
                if ($s->jatuh_tempo > 0) {
                    // updated_at + jatuh_tempo hari
                    $dueDate = $s->updated_at->copy()->addDays($s->jatuh_tempo)->startOfDay();
                    $diff = now()->startOfDay()->diffInDays($dueDate, false);
                    if ($diff <= 3) {
                        $msg = $diff < 0 ? "Telah lewat " . abs($diff) . " hari" : ($diff == 0 ? "Jatuh tempo hari ini!" : "Jatuh tempo dalam {$diff} hari");
                        $notifications->push([
                            'type' => 'danger',
                            'title' => 'Jatuh Tempo Hutang',
                            'message' => "Tagihan <b>{$s->nama_supplier}</b> {$msg}",
                            'icon' => 'cash',
                            'time' => $dueDate->format('d M Y')
                        ]);
                    }
                }
            }

            // Sort notifications mostly by danger first, or keep them grouped
            $sortedNotifications = $notifications->sortBy(function($notif) {
                return $notif['type'] == 'danger' ? 1 : 2;
            })->values();

            $view->with('notifications', $sortedNotifications);
        });
    }
}
