<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;


class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'), // 'All Employees' tabı için bir başlık ekleyin
            'thisWeek' => Tab::make('This Week') 
                ->modifyQueryUsing(fn (Builder $query) => $query->where('date_hired', '>=', now()->subWeek())),
            'thisMonth' => Tab::make('This Month') 
                ->modifyQueryUsing(fn (Builder $query) => $query->where('date_hired', '>=', now()->subMonth())),
            'thisYear' => Tab::make('This Year') 
                ->modifyQueryUsing(fn (Builder $query) => $query->where('date_hired', '>=', now()->subYear())),
        ];
    }
}
