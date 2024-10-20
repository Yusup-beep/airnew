<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Orders;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class OrderResource extends Resource
{
    protected static ?string $model = Orders::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return __('Orders');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Repeater::make('items')
                    ->schema([
                        Forms\Components\TextInput::make('name')->translateLabel()->columnSpan(4),
                        Forms\Components\TextInput::make('amount')->translateLabel()->columnSpan(1),
                        Forms\Components\FileUpload::make('image')->deletable(0)->disabled()->downloadable(0)->translateLabel()->columnSpan(5),
                    ])->addable(false)->label(__('Products'))->columns(12),
                Forms\Components\Fieldset::make(__('Requisites'))
                    ->schema([
                        Forms\Components\TextInput::make('ur')->translateLabel(),
                        Forms\Components\TextInput::make('inn')->numeric()->translateLabel(),
                        Forms\Components\TextInput::make('uradr')->translateLabel(),
                        Forms\Components\TextInput::make('bank')->translateLabel(),
                        Forms\Components\TextInput::make('bik')->numeric()->translateLabel(),
                        Forms\Components\TextInput::make('chet')->numeric()->translateLabel(),
                        Forms\Components\Checkbox::make('need_delivery')->nullable()->translateLabel(),
                        Forms\Components\TextInput::make('delivery')->nullable()->translateLabel(),
                    ]),
                Forms\Components\Fieldset::make(__('Contact person'))
                    ->schema([
                        Forms\Components\TextInput::make('name')->translateLabel(),
                        Forms\Components\TextInput::make('phone')->tel()->translateLabel(),
                        Forms\Components\TextInput::make('email')->email()->translateLabel(),
                        Forms\Components\TextInput::make('comment')->nullable()->translateLabel(),
                        Forms\Components\Checkbox::make('need_call')->nullable()->translateLabel(),
                    ]),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ur')->searchable(),
                Tables\Columns\TextColumn::make('inn')->searchable(),
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
