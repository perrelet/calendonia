<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Models\Event;

use App\Filament\Resources\EventResource;
use Filament\Resources\Pages\EditRecord;

use Filament\Forms;
use Filament\Resources\Form;
class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

    public function form(Form $form): Form {

        $disable = $this->record->injested;

        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required()->disabled($disable),
                Forms\Components\TextInput::make('sub_title')->disabled($disable),
                Forms\Components\Select::make('importance')->options(Event::get_importance_options())->placeholder('Default'),
                Forms\Components\TextInput::make('url')->label(Event::get_url_label())->disabled($disable),
                Forms\Components\Select::make('virtual')->options(Event::get_virtual_options())->disablePlaceholderSelection()->label(Event::get_virtual_label()),
                Forms\Components\DateTimePicker::make('start_date')->disabled($disable)->required(),
                Forms\Components\DateTimePicker::make('end_date')->disabled($disable),
                Forms\Components\TextInput::make('image')->disabled($disable),
                Forms\Components\TextInput::make('thumb')->disabled($disable),
                Forms\Components\TextInput::make('price')->disabled($disable),
                Forms\Components\TextInput::make('currency')->disabled($disable),
                /* Forms\Components\TextInput::make('tags')->disabled($disable), */
                Forms\Components\RichEditor::make('body')->disabled($disable),
            ]);
    }

}
