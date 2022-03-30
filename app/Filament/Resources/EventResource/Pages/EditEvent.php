<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use Filament\Resources\Pages\EditRecord;

use Filament\Forms;
use Filament\Resources\Form;
class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

    public function form(Form $form): Form {

        $disable_fields = $this->record->injested;

        $importances = [];
        for ($i = 1; $i <= 9; $i++) $importances[$i] = $i;

        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required()->disabled($disable_fields),
                Forms\Components\TextInput::make('sub_title')->disabled($disable_fields),
                Forms\Components\Select::make('importance')->options($importances)->placeholder('Default'),
                Forms\Components\TextInput::make('url')->disabled($disable_fields),
                Forms\Components\Checkbox::make('virtual')->disabled($disable_fields)->label('This event is virtual / online.'),
                Forms\Components\DateTimePicker::make('start_date')->disabled($disable_fields)->required(),
                Forms\Components\DateTimePicker::make('end_date')->disabled($disable_fields),
                Forms\Components\TextInput::make('image')->disabled($disable_fields),
                Forms\Components\TextInput::make('thumb')->disabled($disable_fields),
                Forms\Components\TextInput::make('price')->disabled($disable_fields),
                Forms\Components\TextInput::make('currency')->disabled($disable_fields),
                Forms\Components\RichEditor::make('body')->disabled($disable_fields),
            ]);
    }

}
