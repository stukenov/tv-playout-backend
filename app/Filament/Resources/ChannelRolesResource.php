<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChannelRolesResource\Pages;
use App\Filament\Resources\ChannelRolesResource\RelationManagers;
use App\Models\ChannelRole;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChannelRolesResource extends Resource
{
    protected static ?string $model = ChannelRole::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListChannelRoles::route('/'),
            'create' => Pages\CreateChannelRoles::route('/create'),
            'edit' => Pages\EditChannelRoles::route('/{record}/edit'),
        ];
    }
}
