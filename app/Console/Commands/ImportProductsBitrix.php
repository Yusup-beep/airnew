<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use App\Services\ImageService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImportProductsBitrix extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-products-bitrix {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import products bitrix
    example =  docker compose exec app-air php artisan app:import-products-bitrix http://everylore.smartoilazs.ru/bitrixExport.php
    ';

    protected $baseMethod = 'products';
    protected $method = 'countElSection';

    /**
     * Execute the console command.
     * @throws GuzzleException
     */
    public function handle()
    {
        $this->info('Start Import Products');
        $url = $this->argument('url');
        $categories = Category::query()->select('id','slug')
            ->whereNotNull('parent_id')->get();
        //получаю категории у которых есть родитель
        $countEls = 0;
        $progressBar = $this->output->createProgressBar(count($categories));
        $progressBar->start();
        foreach ($categories as $category){
            //получаю общее кол-во элементов в секции
            $countElsAndIds = $this->getCountProducts($category->slug);

            $countPage = 0;
            $countElementQuery = 10;
            Log::debug('total_count' , [$countElsAndIds, $category->slug]);
            $residue = $countElsAndIds['total_count'] % $countElementQuery;
            $countPage = intdiv($countElsAndIds['total_count'], $countElementQuery);
            if (isset($residue)){
                $countPage++;
            }
            $curEl = 0;
            for ($x = 0; $x < $countPage; $x++){
                $products = $this->getProducts(
                    $countElsAndIds['iblockId'],
                    $countElsAndIds['iblockSectId'],
                    $countElementQuery,
                    $curEl
                );
                $newProducts = $this->updateImagePath($products);

                $productsMessSave = [];
                foreach ($newProducts as $productKey => $product){
                    $productsMessSave[] = new Product([
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'description' => $product->description,
                        'category_id' => $category->id,
                        'values' => $product->props,
                    ]);
                }
                $category->products()->saveMany($productsMessSave);
                $curEl = $curEl + $countElementQuery - 1;
            }
            $progressBar->advance();
        }
        $progressBar->finish();
    }
    public function updateImagePath($collection)
    {
        return $collection->map(function ($item) {
            if(isset($item->props->image_path->patch)){
                $newPaths = [];
                foreach ($item->props->image_path->patch as $key => $patch){
                    $newPaths[] =  ($patch !== '') ? ImageService::request('products' , $patch) : '';
                }
                $item->props->image_path->patch = $newPaths;
            }

            return $item;
        });
    }
    public function getProducts($iblock_id , $sections_id, $nPageSize, $iNavStartIndex){
        $response = Http::withoutVerifying()->withOptions([
            'debug' => true,
            'protocols' =>  'http',
            'verify' =>  false,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ])->get($this->argument('url'), [
            'iblock_id'  =>  $iblock_id,
            'sections_id'  =>  $sections_id,
            'nPageSize'  =>  $nPageSize,
            'iNavStartIndex'  =>  $iNavStartIndex,
            'method'  =>  $this->baseMethod,
        ]);
        $products = collect(json_decode($response->body()));
        return $products;
    }

    public function getCountProducts($slug){
        $response = Http::withoutVerifying()->withOptions([
            'debug' => true,
            'protocols' =>  'http',
            'verify' =>  false,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ])->get($this->argument('url'), [
            'section_code'  =>  $slug,
            'method'  =>  $this->method,
        ]);
        $countProd = collect(json_decode($response->body()));
        return $countProd;
    }
}
