<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use App\Forms\Components\MyKeyValue;
use Filament\Forms\Form;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\URL;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected $queryString = [
        'tableFilters',
        'tableSearchQuery' => ['except' => ''],
        'tableColumnSearchQueries',
    ];
    public static function getNavigationLabel(): string
    {
        return __('Categories');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make()->schema([
                    TextInput::make('title'),
                    TextInput::make('name'),
                    TextInput::make('slug'),
                    Select::make('parent_id')->relationship('parent', 'name'),
                    Fieldset::make()->schema([
                        FileUpload::make('image_path')->image()->imageEditor()->imagePreviewHeight('100%')->directory('categories')->columnSpan('full'),
                        Checkbox::make('wide')->columnSpan('full')->translateLabel(),
                    ])->columnSpan(1),
                    RichEditor::make('info'),
                ]),
                Fieldset::make()->schema([
                    Fieldset::make()
                        ->schema([
                            RichEditor::make('up_text'),
                            RichEditor::make('down_text1'),
                            RichEditor::make('down_text2'),
                        ])->columns(1),
                    Fieldset::make()
                        ->schema([
                            KeyValue::make('show_keys')
                                ->addable()
                                ->deletable()
                                ->editableKeys(),
                        ])->columns(1),
                ])->columns(3),
                RichEditor::make('description')->columnSpanFull(),
                Repeater::make('description_inside_page')
                    ->schema([
                        TextInput::make('caption'),
                        Textarea::make('left')->rows(8),
                        Textarea::make('right')->rows(8),
                    ])->columnSpanFull(),
                Textarea::make('keywords')->rows(10),
                RichEditor::make('announcement'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->columns([
                TextColumn::make('name')->searchable()->translateLabel()->limit(40),
                TextColumn::make('parent.name')->translateLabel(),
                IconColumn::make('published')->boolean()->width('5%'),
            ])
            ->filters([
                SelectFilter::make('parent_id')->relationship('parent', 'name'),
            ])
            ->actions([
                Action::make('Экспорт')->url(fn($record) => URL::temporarySignedRoute(
                    'export.products',
                    now()->addMinutes(30), // Время действия ссылки
                    ['category_id' => $record->id] // Передаем ID категории
                ))->disabled(fn($record) => $record->parent_id === null),
                EditAction::make(),
                Action::make('publish')
                    ->action(function (Category $record) {
                        $record->published = true;
                        $record->save();
                    })->translateLabel()
                    ->hidden(fn(Category $record): bool => $record->published),
                Action::make('unpublish')
                    ->action(function (Category $record) {
                        $record->published = false;
                        $record->save();
                    })->translateLabel()
                    ->visible(fn(Category $record): bool => $record->published),
            ])->actionsColumnLabel('Actions')->actionsPosition()
            ->groupedBulkActions([
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
