<?php

namespace App\Filament\Resources\DeathRecords;

use App\Filament\Resources\DeathRecords\Pages\CreateDeathRecord;
use App\Filament\Resources\DeathRecords\Pages\EditDeathRecord;
use App\Filament\Resources\DeathRecords\Pages\ListDeathRecords;
use App\Filament\Resources\DeathRecords\Schemas\DeathRecordForm;
use App\Filament\Resources\DeathRecords\Tables\DeathRecordsTable;
use App\Models\DeathRecord;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class DeathRecordResource extends Resource
{
    protected static ?string $model = DeathRecord::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static string | UnitEnum | null $navigationGroup = 'Mortuary';

    public static function form(Schema $schema): Schema
    {
        return DeathRecordForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DeathRecordsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDeathRecords::route('/'),
            'create' => CreateDeathRecord::route('/create'),
            'edit' => EditDeathRecord::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
