<?php

namespace App\Filament\Resources\ConnectionResource\Pages;

use App\Filament\Resources\ConnectionResource;
use Filament\Resources\Pages\ListRecords;

use Filament\Resources\Table;
use Filament\Tables;
class ListConnections extends ListRecords
{
    protected static string $resource = ConnectionResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('url'),
                Tables\Columns\TextColumn::make('tags'),
            ]);
    }

}
