<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Services\ImageService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImportCategoriesBitrix extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-categories-bitrix {url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import categories bitrix
    example =  docker compose exec app-air php artisan app:import-categories-bitrix http://everylore.smartoilazs.ru/bitrixExport.php
    ';

    protected $method = 'categories';
    /**
     * Execute the console command.
     * @throws GuzzleException
     */
    public function handle()
    {
        $this->info('Start Import Categories');
        $response = Http::withoutVerifying()->withOptions([
            'debug' => true,
            'protocols' =>  'http',
            'verify' =>  false,
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ])->get($this->argument('url'), [
            'method'    =>  $this->method
        ]);
        $categories = collect(json_decode($response->body()));
        $progressBar = $this->output->createProgressBar(count($categories));
        $progressBar->start();

        $categories->each(function ($category) use ($progressBar) {
            $imgPath = ($category->image_path !== '') ? ImageService::request('categories' , $category->image_path) : '';
            $categoryRes = Category::query()->create([
                'name'  =>  $category->name,
                'slug'  =>  $category->slug,
                'image_path'    =>  $imgPath,
                'description'   =>  $category->description,
            ]);
            if(isset($category->section)){
                foreach ($category->section as $section){

                    $imgSubPath = ($section->image_path !== '') ? ImageService::request('categories' , $section->image_path) : '';
                    $sectionId = Category::query()->create([
                        'title' =>  $section->title,
                        'name'  =>  $section->name,
                        'slug'  =>  $section->slug,
                        'parent_id' =>  $categoryRes->id,
                        'image_path'    =>  $imgSubPath,
                        'description'   =>  $section->description,
                        'info'  =>  $section->info,
                        'keywords'  =>  $section->keywords,
                        'announcement'  =>  $section->announcement,
                    ]);
                }
            }
            if(isset($category->subsection)){
                foreach ($category->subsection as $subSection){
                    $imgSubSectPath = ($subSection?->image_path !== '') ? ImageService::request('categories' , $subSection?->image_path) : '';
                    $categorySub = Category::query()->create([
                        'title' =>  $subSection->title,
                        'name'  =>  $subSection->name,
                        'slug'  =>  $subSection->slug,
                        'parent_id' =>  $sectionId->id,
                        'image_path'    =>  $imgSubSectPath,
                        'description'   =>  $subSection->description,
                        'info'  =>  $subSection->info,
                        'keywords'  =>  $subSection->keywords,
                        'announcement'  =>  $subSection->announcement,
                    ]);
                }
            }

            $progressBar->advance();
        });
        $progressBar->finish();
    }
}
