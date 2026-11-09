<?php

namespace App\Filament\Resources\MemberContributions;

use App\Filament\Resources\MemberContributions\Pages\CreateMemberContribution;
use App\Filament\Resources\MemberContributions\Pages\EditMemberContribution;
use App\Filament\Resources\MemberContributions\Pages\ListMemberContributions;
use App\Filament\Resources\MemberContributions\Schemas\MemberContributionForm;
use App\Filament\Resources\MemberContributions\Tables\MemberContributionsTable;
use App\Models\MemberContribution;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberContributionResource extends Resource
{
    protected static ?string $model = MemberContribution::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return MemberContributionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MemberContributionsTable::configure($table);
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
            'index' => ListMemberContributions::route('/'),
            'create' => CreateMemberContribution::route('/create'),
            'edit' => EditMemberContribution::route('/{record}/edit'),
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
