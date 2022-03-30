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

        $event_types = Event::distinct()->get(['type']);
        $types = [];
        foreach ($event_types as $event_type) $types[$event_type->type] = $event_type->type;
        $types['SOMM'] = 'SOMM';

        $importances = [];
        for ($i = 1; $i <= 9; $i++) $importances[$i] = $i;

        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\TextInput::make('sub_title'),
                Forms\Components\Select::make('type')->options($types)->placeholder('Select an Event Type')->required(),
                Forms\Components\Select::make('importance')->options($importances)->placeholder('Default'),
                Forms\Components\TextInput::make('url'),
                Forms\Components\Checkbox::make('virtual')->label('This event is virtual / online.'),
                Forms\Components\DateTimePicker::make('start_date')->required(),
                Forms\Components\DateTimePicker::make('end_date'),
                Forms\Components\TextInput::make('image'),
                Forms\Components\TextInput::make('thumb'),
                Forms\Components\TextInput::make('price'),
                Forms\Components\TextInput::make('currency'),
                Forms\Components\RichEditor::make('body'),
                
            ]);
    }
}
