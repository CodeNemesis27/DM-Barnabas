<?php

namespace App\Filament\Resources\Districts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DistrictForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('district_name')
                    ->required(),
                TextInput::make('district_code')
                    ->required(),
                Select::make('locality_id')
                    ->relationship('locality', 'id')
                    ->required(),
            ]);
    }
}
