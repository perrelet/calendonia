<?php

namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\TextInput;

class ManageGeneral extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = GeneralSettings::class;

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('site_name')->required(),
        ];
    }

    protected static function getNavigationLabel(): string
    {
        return "Settings";
    }

    protected function getHeading(): string
    {
        return "General Settings";
    }
}
