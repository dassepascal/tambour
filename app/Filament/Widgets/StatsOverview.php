<?php

namespace App\Filament\Widgets;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $paidTotal = Order::query()->where('status', OrderStatus::Paid)->sum('total');

        return [
            Stat::make('Chiffre d\'affaires', number_format((float) $paidTotal, 2, ',', ' ').' €')
                ->description('Commandes payées'),
            Stat::make('Commandes', Order::query()->count())
                ->description(Order::query()->where('status', OrderStatus::Pending)->count().' en attente'),
            Stat::make('Produits', Product::query()->count())
                ->description('Tambours et accessoires'),
            Stat::make('Clients', User::query()->where('is_admin', false)->count()),
        ];
    }
}
