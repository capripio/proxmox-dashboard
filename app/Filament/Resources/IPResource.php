<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IPResource\Pages;
use App\Filament\Resources\IPResource\RelationManagers;
use App\Models\IP;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IPResource extends Resource
{
    protected static ?string $model = IP::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'IP';
    protected static ?string $singularLabel = 'IP';
    protected static ?string $pluralLabel = 'IPs';

    protected static ?string $slug = 'ips';
    protected static ?string $modelLabel = 'IP';

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
            'index' => Pages\ListIPS::route('/'),
            'create' => Pages\CreateIP::route('/create'),
            'edit' => Pages\EditIP::route('/{record}/edit'),
        ];
    }
}
