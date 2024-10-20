<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        $heads = array_slice($rows->toArray()[0], 8);
        $characteristics = collect($heads)->map(function ($row) {
            $parts = explode('-', $row);

            return [
                "name" => $parts[0],
                "code" => $parts[1],
                "value" => null
            ];
        });

        $newProducts = $rows->filter(function (Collection $productsRow) {
            return $productsRow->toArray()[0] === null;
        });

        $this->createNewProducts($newProducts, $characteristics);
    }


    private function createNewProducts($newProducts, $characteristics)
    {
        foreach ($newProducts->toArray() as $product) {
            $values = array_slice($product, 8);
            $mergedCollection = $characteristics->map(function ($item, $index) use ($values) {
                $value = $values[$index] ?? $item['value'];

                // Если значение — это строка с запятыми, преобразуем её в массив
                if (is_string($value) && strpos($value, ',') !== false) {
                    $value = array_map('trim', explode(',', $value)); // Преобразуем строку в массив, удаляя пробелы
                }

                $item['value'] = $value;
                return $item;
            });
            $d = new Product([
                'name' => $product[2],
                'category_id' => $product[1],
                'image_path' => $product[4],
                'published' => $product[7],
                'values' => $mergedCollection->toArray()
            ]);

            $d->save();
        }
    }
}
