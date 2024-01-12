<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProxmoxServerResource\Pages;
use App\Filament\Resources\ProxmoxServerResource\RelationManagers;
use App\Models\IP;
use App\Models\ProxmoxServer;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProxmoxServerResource extends Resource
{
    protected static ?string $model = ProxmoxServer::class;

    protected static ?string $navigationIcon = 'heroicon-o-server-stack';

    protected static ?int $navigationSort = 2;
    protected static ?string $label = 'Proxmox Server';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    TextInput::make('name')
                        ->autofocus()
                        ->required()
                        ->unique(ProxmoxServer::class, 'name', ignorable: fn($record) => $record)
                        ->label('Name'),
                    TextInput::make('ip_address')
                        ->required()
                        ->ip()
                        ->validationMessages([
                            'ip' => 'The IP must be a valid IP address.',
                        ])
                        ->unique(ProxmoxServer::class, 'ip_address', ignorable: fn($record) => $record)
                        ->label('IP Address'),
                    TextInput::make('token_id')
                        ->required()->label('Token ID'),
                    TextInput::make('token_secret')
                        ->mask('********-****-****-****-************')
                        ->required()->label('Token Secret'),
                    Repeater::make('ips')
                        ->label('IPs')
                        ->relationship()
                        ->cloneable()
                        ->addActionLabel('Add IP')
                        ->required()
                        ->schema([
                            TextInput::make('ip_address')
                                ->required()
                                ->ip()
                                ->unique(IP::class, 'ip_address', ignorable: fn($record) => $record)
                                ->label('IP Address'),
                            Select::make('status')
                                ->options([
                                    'available' => 'Available',
                                    'unavailable' => 'Unavailable',
                                ])
                                ->required()
                                ->default('available')
                                ->label('Status'),
                        ])->columnSpan('full'),

                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('ip_address')
                    ->searchable()
                    ->label('IP Address')
                    ->sortable(),
                TextColumn::make('token_id')
                    ->searchable()
                    ->label('Token ID')
                    ->sortable(),
                TextColumn::make('token_secret')
                    ->formatStateUsing(function ($state) {
                        return substr($state, 0, -12) . str_repeat('*', 12);
                    })
                    ->searchable()
                    ->label('Token Secret')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->searchable()
                    ->sortable()
                    ->label('Created At')
                    ->dateTime('d-m-Y H:i:s'),
                TextColumn::make('updated_at')
                    ->searchable()
                    ->sortable()
                    ->label('Updated At')
                    ->dateTime('d-m-Y H:i:s'),
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
