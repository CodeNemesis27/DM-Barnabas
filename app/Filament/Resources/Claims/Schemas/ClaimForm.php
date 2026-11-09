<?php

namespace App\Filament\Resources\Claims\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ClaimForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('claim_ref_no')
                    ->required(),
                Select::make('death_record_id')
                    ->relationship('deathRecord', 'id')
                    ->required(),
                TextInput::make('claimant_name')
                    ->required(),
                TextInput::make('claimant_relationship')
                    ->required(),
                TextInput::make('claimant_phone_no')
                    ->tel()
                    ->required(),
                Select::make('status')
                    ->options([
            'Pending' => 'Pending',
            'Approved' => 'Approved',
            'Rejected' => 'Rejected',
            'Disbursed' => 'Disbursed',
            'Cancelled' => 'Cancelled',
        ])
                    ->default('Pending')
                    ->required(),
                Textarea::make('remarks')
                    ->columnSpanFull(),
                TextInput::make('approved_by')
                    ->numeric(),
                DateTimePicker::make('approved_at'),
                TextInput::make('requested_by')
                    ->required()
                    ->numeric(),
            ]);
    }
}
