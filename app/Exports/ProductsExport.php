<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Mockery\Undefined;

class ProductsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $categoryId;
    protected $products;

    // Конструктор для передачи category_id
    public function __construct($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->products = Product::where('category_id', '=', $this->categoryId)->get()->setHidden(['slug']);
    }

    public function collection()
    {
        return $this->products->map(function ($product) {
            $mainData = [
                $product->id,
                $product->category_id,
                $product->name,
                $product->description,
                $product->image_path,
                $product->created_at,
                $product->updated_at,
                $product->published,
            ];
            return array_merge($mainData, array_values($this->mapValues($product->values)->toArray()));
        });
    }

    public function headings(): array
    {
        $mainHeadings =  [
            'ID',
            'Category ID',
            'Name',
            'Description',
            'Image Path',
            'Created At',
            'Updated At',
            'Published',
        ];
        return array_merge($mainHeadings, array_values($this->getHeadings($this->products)->toArray()), ['Action']);
    }

    private function getHeadings($products)
    {
        $characteristics = $products[0]->values;
        return collect($characteristics)->map(function ($characteristic) {
            return $characteristic['name'] . "-" . $characteristic['code'];
        });
    }

    private function mapValues($values)
    {

        return collect($values)->map(function ($v) {

            if (isset($v['value']) && $v['value'] === null) {
                return '';
            } else if (isset($v['value']) && is_array($v['value'])) {
                return implode(', ', $v['value']);
            }
            return $v['value'] ?? '';
        });
    }
}
