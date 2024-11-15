<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;


class CategoryObserver
{
    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        $originalKeys = collect($category->getOriginal('show_keys')); // Преобразуем в коллекцию для удобства
        $keys = collect($category->show_keys); // Текущее состояние также в коллекцию

        $changes = $keys->diffKeys($originalKeys);
        $values = $changes->mapWithKeys(function ($value, $key) {
            $slug = Str::slug($key);
            return [
                $slug => [
                    "name" => $key,
                    "code" => $slug,
                    "value" => ""
                ]
            ];
        })->toArray();
        $products = $category->products()->get();
        $products->each(function ($product) use ($values) {
            $product->values = array_merge($product->values ?? [], $values);
            $product->save();
        });
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
