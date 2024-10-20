<?php

namespace App\Filament\Resources;

use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

// use Illuminate\Database\Eloquent\Collection;

use function Pest\Laravel\options;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected $queryString = [
        'tableFilters',
        'tableSearchQuery' => ['except' => ''],
        'tableColumnSearchQueries',
    ];
    public static function getNavigationLabel(): string
    {
        return __('Products');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                TextInput::make('name'),
                TextInput::make('slug'),
                Select::make('category_id')->relationship('category', 'name')
                    ->afterStateUpdated(function (Set $set, Get $get) {
                        $fields = Category::find($get('category_id'))->products->first();
                        if (is_null($fields)) {
                            $fields['error']['name'] = 'В категории нет товаров!';
                        } else {
                            $fields = $fields->values;
                            foreach ($fields as $k => $v) {
                                $v['value'] = '';
                                $fields[$k] = $v;
                            }
                        }
                        $set('values', $fields);
                    })
                    ->live(),
                Repeater::make('values')
                    ->schema([
                        Forms\Components\TextInput::make('name')->hidden(),
                        Forms\Components\TextInput::make('code')->hidden(),
                        Forms\Components\TextInput::make('value'),
                    ])
                    ->grid(3)->addable(false)->deletable(false)->reorderable(false)->key('values')
                    ->itemLabel(fn(array $state): ?string => $state['name'] ?? null),
                FileUpload::make('image_path')->image()->imageEditor()->imagePreviewHeight('100%')->directory('categories'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('category.name'),
                IconColumn::make('published')->boolean()->width('5%'),
            ])
            ->filters([
                Filter::make('published')->query(fn(Builder $query) => $query->where('published', true))->translateLabel(),
                Filter::make('unpublished')->query(fn(Builder $query) => $query->where('published', false))->translateLabel(),
                SelectFilter::make('category_id')->relationship('category', 'name')->translateLabel()->label('Category'),
            ])
            ->actions([
                EditAction::make(),
                Action::make('publish')
                    ->action(function (Product $record) {
                        $record->published = true;
                        $record->save();
                    })->translateLabel()
                    ->hidden(fn(Product $record): bool => $record->published),
                Action::make('unpublish')
                    ->action(function (Product $record) {
                        $record->published = false;
                        $record->save();
                    })->translateLabel()
                    ->visible(fn(Product $record): bool => $record->published),
            ])->actionsColumnLabel('Actions')->actionsPosition()
            ->groupedBulkActions([
                ExportAction::make()->exports([
                    ExcelExport::make()->withWriterType(\Maatwebsite\Excel\Excel::XLSX),
                ]),
                BulkAction::make('publish')
                    ->action(function (Collection $records) {
                        foreach ($records as $record) {
                            $record->published = true;
                            $record->save();
                        }
                    })->translateLabel()->deselectRecordsAfterCompletion(),
                BulkAction::make('unpublish')
                    ->action(function (Collection $records) {
                        foreach ($records as $record) {
                            $record->published = false;
                            $record->save();
                        }
                    })->translateLabel()->deselectRecordsAfterCompletion(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
