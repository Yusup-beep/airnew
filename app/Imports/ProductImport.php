<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use App\Services\ImageService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ProductImport implements ToModel, ShouldQueue, WithChunkReading
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     * @throws GuzzleException
     */
    public function model(array $row)
    {

        if(str_contains($row[0], 'ID элемента')) {
            return;
        }
//        dd(collect($row)->filter(function ($item) {
//            return str_contains($item, '[');
//        }));
        $categories = explode('/', $row[26]);

        $lastId = null;
        foreach ($categories as $category) {
            $c = Category::whereName($category)->firstOrCreate(['name' => $category, 'parent_id' => $lastId ?? 10]);
            $lastId = $c->id;
        }
        return new Product([
            'name' => $row[1],
            'category_id' => $lastId,
//            'ENVIRONMENT' => $row[25],
//            'TYPE_DESIGNS'  => $row[26],
//            'CAPACITY_ENGI'  => $row[27],
//            'PRESSURE_NOM'  => $row[28],
//            'PRESSURE_NOM_M'  => $row[29],
//            'PRODUCTIVITY_NOM'  => $row[30],
//            'PRESSURE_IN' => $row[31],
//            'RECEIVER_VOLUME' => $row[32],
//            'NOISE_LEVEL' => $row[33],
//            'CONNECTION'  => $row[34],
//            'CLASS_OF_PROTECTION'  => $row[35],
//            'CURRENT_CONSUMPTION3'   => $row[36],
//            'PRESSURE_POWER_SUP'  => $row[37],
//            'WEIGHT'   => $row[38],
//            'DIMENSIONS'   => $row[39],
            'DESCRIPTION'   => $row[30],
            'KEYWORDS'   => $row[31],
            'BIG_FOTO'   => ImageService::request(explode(';', $row[34])[0]),
//            'MIDDLE_FOTO'   => ImageService::request($row[43]),
//            'SMALL_FOTO'   => ImageService::request($row[44]),
            'ZAGOLOVOK'   => $row[32]
        ]);
    }
    public function chunkSize(): int
    {
        return 100;
    }
}
