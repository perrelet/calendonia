<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;
    protected static ?string $recordTitleAttribute = 'title';
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function canDelete(Model $record): bool
    {
        return !$record->injested;
    }

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\TextInput::make('id'),
                Forms\Components\TextInput::make('title'),
                Forms\Components\TextInput::make('sub_title'),
                Forms\Components\TextInput::make('type'),
                Forms\Components\TextInput::make('importance'),
                Forms\Components\TextInput::make('connection_id'),
                Forms\Components\TextInput::make('external_id'),
                Forms\Components\TextInput::make('url'),
                Forms\Components\TextInput::make('start_date'),
                Forms\Components\TextInput::make('end_date'),
                Forms\Components\TextInput::make('image'),
                Forms\Components\TextInput::make('thumb'),
                Forms\Components\TextInput::make('virtual'),
                Forms\Components\TextInput::make('price'),
                Forms\Components\TextInput::make('currency'),
                Forms\Components\TextInput::make('created_at'),
                Forms\Components\TextInput::make('updated_at'),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
            'view' => Pages\ViewEvent::route('/{record}'),
        ];
    }
}
