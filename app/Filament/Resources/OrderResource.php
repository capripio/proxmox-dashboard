<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 5;
    protected static ?string $label = 'Order';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([
                        Select::make('user_id')
                            ->searchable(['name', 'email'])
                            ->relationship('user', 'name'),
                        Repeater::make('OrderItems')
                            ->relationship()
                            ->schema([
                                TextInput::make('quantity')
                                    ->default(1)
                                    ->numeric()
                                    ->required(),
                                TextInput::make('company')
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('company_slug', Str::slug($state)))
                                    ->required(),
                                TextInput::make('company_slug')->required(),
                                TextInput::make('country')->required(),
                                TextInput::make('state')->required(),
                                TextInput::make('price')->numeric()->required(),
                            ])
                            ->columnSpan('full')
                            ->label('Order Items')
                            ->addActionLabel('Add Order Item'),
                        TextInput::make('gross_total')->numeric()->required()
                            ->label('Gross Total'),
                        TextInput::make('net_total')->numeric()->required()
                            ->label('Net Total'),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user . name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('gross_total')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('net_total')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
