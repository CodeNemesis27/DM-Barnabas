<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                TextInput::make('first_name')
                    ->required(),
                TextInput::make('middle_name')
                    ->required(),
                TextInput::make('last_name')
                    ->required(),
                Select::make('suffix')
                    ->options(['II' => 'I i', 'III' => 'I i i', 'Jr.' => 'Jr.', 'Sr.' => 'Sr.']),
                Select::make('gender')
                    ->options(['Male' => 'Male', 'Female' => 'Female'])
                    ->required(),
                DatePicker::make('date_of_birth')
                    ->required(),
                Select::make('civil_status')
                    ->options([
            'Single' => 'Single',
            'Married' => 'Married',
            'Separated' => 'Separated',
            'Widowed' => 'Widowed',
        ])
                    ->required(),
                TextInput::make('occupation')
                    ->required(),
                Textarea::make('address')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('phone_no')
                    ->tel()
                    ->required(),
                TextInput::make('alternate_phone_no')
                    ->tel(),
                TextInput::make('facebook_account'),
                Select::make('church_id')
                    ->relationship('church', 'id')
                    ->required(),
                Select::make('class')
                    ->options(['A' => 'A', 'B' => 'B'])
                    ->required(),
                Select::make('status')
                    ->options(['Active' => 'Active', 'Deceased' => 'Deceased'])
                    ->required(),
                Textarea::make('remarks')
                    ->columnSpanFull(),
                TextInput::make('created_by')
                    ->required()
                    ->numeric(),
            ]);
    }
}
