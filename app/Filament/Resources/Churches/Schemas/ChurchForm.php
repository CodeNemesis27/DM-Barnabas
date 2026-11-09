<?php

namespace App\Filament\Resources\Churches\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ChurchForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('church_name')
                    ->required(),
                TextInput::make('church_code')
                    ->required(),
                Select::make('type')
                    ->options(['Church' => 'Church', 'Company' => 'Company'])
                    ->required(),
                Select::make('locality_id')
                    ->relationship('locality', 'id')
                    ->required(),
                Select::make('district_id')
                    ->relationship('district', 'id')
                    ->required(),
                TextInput::make('church_members')
                    ->numeric(),
            ]);
    }
}
