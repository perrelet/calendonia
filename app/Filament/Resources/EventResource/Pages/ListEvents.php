<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use Filament\Resources\Pages\ListRecords;

use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ListEvents extends ListRecords
{
    protected static string $resource = EventResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumb')->rounded(),
                Tables\Columns\TextColumn::make('title')->sortable(),
                Tables\Columns\TextColumn::make('type')->sortable(),
                Tables\Columns\TextColumn::make('start_date')->sortable(),
                Tables\Columns\SpatieTagsColumn::make('tags'),
                Tables\Columns\TextColumn::make('stars')->label(""),
                Tables\Columns\BooleanColumn::make('injested')
                    ->label('')
                    ->trueColor('success')
                    ->trueIcon('heroicon-s-switch-horizontal')
                    ->falseColor('secondary')
                    ->falseIcon('heroicon-s-pencil-alt'),
            ])
            ->defaultSort('start_date', 'desc')
            /* ->actions(array_merge(
                ($this->hasEditAction() ? [$this->getEditAction()] : []),
                ($this->hasDeleteAction() ? [$this->getDeleteAction()] : []),
            )); */
            
            ->filters([
                Tables\Filters\Filter::make('manual')->label('Manual')
                    ->query(fn (Builder $query): Builder => $query->where('connection_id', '<', 1)),
                Tables\Filters\Filter::make('automated')->label('Automated')
                    ->query(fn (Builder $query): Builder => $query->where('connection_id', '>', 0)),
            ]);
            
    }

    protected function getTableRecordUrlUsing(): ?\Closure {
        
        return function (Model $record): ?string {
            $resource = static::getResource();

            if (! ($resource::hasPage('edit') && $resource::canEdit($record))) {
                return null;
            }

            return $resource::getUrl('edit', ['record' => $record]);
        };
    }

}
