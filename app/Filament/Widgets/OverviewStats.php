<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OverviewStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Postingan', Post::count())
                ->description('Jumlah semua artikel')
                ->color('success'),

            Stat::make('Total Pengguna', User::count())
                ->description('Akun yang terdaftar')
                ->color('info'),

            Stat::make('Total Kategori', Category::count())
                ->description('Kategori artikel')
                ->color('warning'),
            Stat::make('Total View', number_format(Post::sum('views')))
                ->description('Total semua view dari artikel')
                ->icon('heroicon-o-eye')
                ->color('info'),
        ];
    }
}
