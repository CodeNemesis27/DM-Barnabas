<?php

namespace App\Filament\Resources\Members\Schemas;

use App\Models\Member;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MemberInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('first_name'),
                TextEntry::make('middle_name'),
                TextEntry::make('last_name'),
                TextEntry::make('suffix')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('gender')
                    ->badge(),
                TextEntry::make('date_of_birth')
                    ->date(),
                TextEntry::make('civil_status')
                    ->badge(),
                TextEntry::make('occupation'),
                TextEntry::make('address')
                    ->columnSpanFull(),
                TextEntry::make('phone_no'),
                TextEntry::make('alternate_phone_no')
                    ->placeholder('-'),
                TextEntry::make('facebook_account')
                    ->placeholder('-'),
                TextEntry::make('church.id')
                    ->label('Church'),
                TextEntry::make('class')
                    ->badge(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('remarks')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_by')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Member $record): bool => $record->trashed()),
            ]);
    }
}
