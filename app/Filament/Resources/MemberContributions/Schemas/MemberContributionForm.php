<?php

namespace App\Filament\Resources\MemberContributions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MemberContributionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('member_id')
                    ->relationship('member', 'id')
                    ->required(),
                TextInput::make('contribution_ref_no')
                    ->required(),
                Select::make('payment_method')
                    ->options(['Cash' => 'Cash', 'GCash' => 'G cash'])
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Textarea::make('remarks')
                    ->columnSpanFull(),
                TextInput::make('transaction_ref_no'),
                TextInput::make('proof_of_payment'),
                Select::make('status')
                    ->options(['Submitted' => 'Submitted', 'Approved' => 'Approved', 'Rejected' => 'Rejected'])
                    ->default('Submitted')
                    ->required(),
                TextInput::make('approved_by')
                    ->numeric(),
                DateTimePicker::make('approved_at'),
                TextInput::make('created_by')
                    ->required()
                    ->numeric(),
            ]);
    }
}
