<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProxmoxServerResource\Pages;
use App\Filament\Resources\ProxmoxServerResource\RelationManagers;
use App\Models\ProxmoxServer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProxmoxServerResource extends Resource
{
    protected static ?string $model = ProxmoxServer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            'index' => Pages\ListProxmoxServers::route('/'),
            'create' => Pages\CreateProxmoxServer::route('/create'),
            'edit' => Pages\EditProxmoxServer::route('/{record}/edit'),
        ];
    }
}
