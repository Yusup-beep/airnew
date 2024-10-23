<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection
{
    /**
     * @param Collection $rows
     *
     * @return void
     */
    public function collection(Collection $rows)
    {
        //Get characteristic's names
        $valueNames = $rows->first()->slice(8);
        $valueNames->pop();
        //Remove headers
        $rows->shift();

        //Get ids and delete products
        $ids = $rows->filter(function ($product) {
            return $product->last() === 0;
        })->map(function ($product) {
            return $product->first();
        });
        Product::whereIn('id', $ids)->delete();

        //Get new products and create them
        $newProducts = $rows->filter(function (Collection $productsRow) {
            return $productsRow->first() === null;
        })->map(function ($product) {
            $product->pop();
            return $product;
        });

        if ($newProducts->isNotEmpty()) {
            $this->createProducts($newProducts, $valueNames);
        }
    }

    private function createProducts(Collection $products, Collection $valueNames)
    {
        $newValues = $products->map(fn($product) => $product->slice(8));
        $products->each(function ($product, $index) use ($newValues, $valueNames) {
            $values = collect($newValues->get($index)->map(function ($value, $index) use ($valueNames) {
                $parts = explode('-', $valueNames->get($index));
                return [$parts[1] => [
                    'name' => $parts[0],
                    'code' => $parts[1],
                    'value' => $value
                ]];
            }))->flatMap(fn($item) => $item);
            $d = new Product([
                'category_id' => $product[1],
                'name' => $product[2],
                'description' => $product[3],
                'image_path' => $product[4] ?? "plug.png",
                'published' => $product[7],
                'values' => $values
            ]);
            $d->save();
        });
    }
}
