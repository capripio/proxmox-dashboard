<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IPResource\Pages;
use App\Filament\Resources\IPResource\RelationManagers;
use App\Models\IP;
use App\Models\ProxmoxServer;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IPResource extends Resource
{
    protected static ?string $model = IP::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $label = 'IP';
    protected static ?string $singularLabel = 'IP';
    protected static ?string $pluralLabel = 'IPs';

    protected static ?string $slug = 'ips';
    protected static ?string $modelLabel = 'IP';
    protected static ?int $navigationSort = 3;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('ip_address')
                    ->required()
                    ->unique(IP::class, 'ip_address', ignorable: fn($record) => $record)
                    ->label('IP Address'),
                Select::make('proxmox_server_id')
                    ->relationship('proxmoxServer', 'name')
                    ->required()
                    ->label('Proxmox Server'),
                Select::make('status')
                    ->options([
                        'available' => 'Available',
                        'unavailable' => 'Unavailable',
                    ])
                    ->required()
                    ->label('Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('proxmoxServer.name')
                    ->label('Proxmox Server')
                    ->searchable(),
                TextColumn::make('ip_address')
                    ->searchable()
                    ->sortable()
                    ->label('IP Address'),
                TextColumn::make('status')
                    ->searchable()
                    ->sortable()
                    ->label('Status')
                    ->formatStateUsing(fn($state) => ucfirst($state)),
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
