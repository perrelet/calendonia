<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use App\Models\Event;
use Filament\Resources\Pages\CreateRecord;

use Filament\Forms;
use Filament\Resources\Form;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array {

        $data['connection_id'] = 0;
        $data['external_id'] = 0;
     
        return $data;
        
    }

    public function form(Form $form): Form {

        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\TextInput::make('sub_title'),
                Forms\Components\SpatieTagsInput::make('tags'),
                Forms\Components\Select::make('type')->options(Event::get_type_options())->placeholder('Select an Event Type')->required(),
                Forms\Components\Select::make('importance')->options(Event::get_importance_options())->placeholder('Default'),
                Forms\Components\TextInput::make('url')->label(Event::get_url_label()),
                Forms\Components\Select::make('virtual')->options(Event::get_virtual_options())->disablePlaceholderSelection()->label(Event::get_virtual_label()),
                Forms\Components\DateTimePicker::make('start_date')->required(),
                Forms\Components\DateTimePicker::make('end_date'),
                Forms\Components\TextInput::make('image'),
                Forms\Components\TextInput::make('thumb'),
                Forms\Components\TextInput::make('price'),
                Forms\Components\TextInput::make('currency'),
                /* Forms\Components\TextInput::make('tags'), */
                Forms\Components\RichEditor::make('body'),                
            ]);
    }
}
