<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Filament\Forms;
use Forms\Components\TextInput;
use Forms\Components\SpatieTagsInput;
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
                TextInput::make('id'),
                TextInput::make('title'),
                TextInput::make('sub_title'),
                SpatieTagsInput::make('tags'),
                TextInput::make('type'),
                TextInput::make('importance'),
                TextInput::make('connection_id'),
                TextInput::make('external_id'),
                TextInput::make('url'),
                TextInput::make('start_date'),
                TextInput::make('end_date'),
                TextInput::make('image'),
                TextInput::make('thumb'),
                TextInput::make('virtual'),
                TextInput::make('country'),
                TextInput::make('host'),
                TextInput::make('organisers'),
                TextInput::make('artists'),
                TextInput::make('venue'),
                TextInput::make('company'),
                TextInput::make('address_1'),
                TextInput::make('address_2'),
                TextInput::make('address_3'),
                TextInput::make('post_code'),
                TextInput::make('country'),
                TextInput::make('lat_long'),
                TextInput::make('price'),
                TextInput::make('currency'),
                TextInput::make('created_at'),
                TextInput::make('updated_at'),
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
