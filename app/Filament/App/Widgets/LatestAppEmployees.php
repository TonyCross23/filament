<?php

namespace App\Filament\App\Widgets;

use Filament\Tables;
use App\Models\Employee;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestAppEmployees extends BaseWidget
{
    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(Employee::query()->whereBelongsTo(Filament::getTenant()))
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                ->label('Name')
                ->sortable()
                ->getStateUsing(function ($record) {
                    return $record->first_name . ' ' . $record->middle_name . ' ' . $record->last_name;
                }),
                Tables\Columns\TextColumn::make('country.name'),
            ]);
    }
}
