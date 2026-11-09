<?php

namespace App\Filament\Resources\DeathRecords\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DeathRecordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('death_record_ref_no')
                    ->required(),
                Select::make('member_id')
                    ->relationship('member', 'id')
                    ->required(),
                DatePicker::make('date_of_death')
                    ->required(),
                Textarea::make('place_of_death')
                    ->required()
                    ->columnSpanFull(),
                Select::make('death_cause_type')
                    ->options([
            'Accidental' => 'Accidental',
            'Illness or disease' => 'Illness or disease',
            'Suicide' => 'Suicide',
            'Homicide' => 'Homicide',
            'Disaster-related' => 'Disaster related',
            'Undetermined' => 'Undetermined',
        ])
                    ->required(),
                Textarea::make('cause_of_death')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('death_cert_number'),
                FileUpload::make('death_cert_image')
                    ->image(),
                Textarea::make('remarks')
                    ->columnSpanFull(),
                TextInput::make('created_by')
                    ->required()
                    ->numeric(),
            ]);
    }
}
