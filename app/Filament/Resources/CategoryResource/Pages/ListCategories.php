<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Imports\ProductsImport;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Action::make('Импорт')->form([
                FileUpload::make('file')
            ])->action(function ($data) {

                /** @var UploadedFile $file */
                $file = $data['file'];
                // Получаем реальный путь к загруженному файлу
                $filePath = storage_path("app/public/$file");

                // Выполняем импорт используя реальный путь файла
                Excel::import(new ProductsImport, $filePath);

                Notification::make()
                    ->title('Импорт завершён')
                    ->success()
                    ->send();
            }),

            Actions\CreateAction::make(),
        ];
    }
}
