<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;
    public $keys = array();

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
    // protected function mutateFormDataBeforeFill(array $data): array
    // {
    //     $category = $this->getRecord();
    //     $cat = $category;
    //     while (blank($cat->products->first())) $cat = $cat->childrens->first();
    //     $keys = $cat->products->first()->values;
    //     $sk = $category->show_keys;
    //     $k = array_map(function ($k, $v) use ($sk) {
    //         if (array_key_exists($k, $sk)) return [$k => $v['name']];
    //         else if (array_key_exists($v['name'], $sk)) return [$k => $v['name']];
    //     }, array_keys($keys), $keys);
    //     $k = array_filter($k);
    //     foreach ($k as $v) $this->keys += $v;
    //     foreach ($data['show_keys'] as $k => $v) {
    //         if (array_key_exists($k, $this->keys)) $ret[$this->keys[$k]] = $v;
    //         else $ret[$k] = $v;
    //     }
    //     if (isset($ret)) $data['show_keys'] = $ret;

    //     return $data;
    // }
    // public function save(bool $shouldRedirect = true, bool $shouldSendSavedNotification = true): void
    // {
    //     foreach ($this->data['show_keys'] as $key => $value) {
    //         if (is_array($value)) {
    //             $this->data['show_keys'][$key . '.' . array_key_first($value)] = $value[array_key_first($value)];
    //             unset($this->data['show_keys'][$key]);
    //         }
    //     }
    //     if ($this->data['show_keys']) foreach ($this->data['show_keys'] as $k => $v) {
    //         foreach ($this->keys as $key => $value) {
    //             if ($k == $value) {
    //                 $ret[$key] = $v;
    //             }
    //         }
    //     }
    //     if (isset($ret)) $this->data['show_keys'] = $ret;
    //     parent::save($shouldRedirect, $shouldSendSavedNotification);
    //     $this->data = $this->mutateFormDataBeforeFill($this->data);
    // }
    public function getHeading(): string
    {
        return 'Редактирование: ' . $this->getRecord()->name;
    }
}
