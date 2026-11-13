<?php

namespace App\Filament\Resources\Localities;

use App\Filament\Resources\Localities\Pages\CreateLocality;
use App\Filament\Resources\Localities\Pages\EditLocality;
use App\Filament\Resources\Localities\Pages\ListLocalities;
use App\Filament\Resources\Localities\Schemas\LocalityForm;
use App\Filament\Resources\Localities\Tables\LocalitiesTable;
use App\Models\Locality;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class LocalityResource extends Resource
{
    protected static ?string $model = Locality::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    protected static string | UnitEnum | null $navigationGroup = 'Community';

    public static function form(Schema $schema): Schema
    {
        return LocalityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LocalitiesTable::configure($table);
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
            'index' => ListLocalities::route('/'),
            'create' => CreateLocality::route('/create'),
            'edit' => EditLocality::route('/{record}/edit'),
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
