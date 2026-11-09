<?php

namespace App\Filament\Resources\Claims\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ClaimInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('claim_ref_no'),
                TextEntry::make('deathRecord.id')
                    ->label('Death record'),
                TextEntry::make('claimant_name'),
                TextEntry::make('claimant_relationship'),
                TextEntry::make('claimant_phone_no'),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('remarks')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('approved_by')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('approved_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('requested_by')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
