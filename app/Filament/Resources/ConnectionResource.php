<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConnectionResource\Pages;
use App\Filament\Resources\ConnectionResource\RelationManagers;
use App\Models\Connection;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ConnectionResource extends Resource
{
    protected static ?string $model = Connection::class;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationIcon = 'heroicon-s-lightning-bolt';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('active')->options(Connection::get_status_options())->disablePlaceholderSelection(),
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('url')->required(),
                Forms\Components\TextInput::make('tags')->required(),
                Forms\Components\TextInput::make('last_run')->disabled(true),
                Forms\Components\Textarea::make('error')->disabled(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListConnections::route('/'),
            'create' => Pages\CreateConnection::route('/create'),
            'edit' => Pages\EditConnection::route('/{record}/edit'),
        ];
    }
}
