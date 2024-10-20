<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    /**
     * @throws GuzzleException
     */
    public static function request($type, $url )
    {
        try {
            $response = Http::timeout(3)
                ->connectTimeout(3)
                ->withOptions([
                    'verify' =>  false,
                ])
                ->get($url);
            $imageContent = $response->body();
            $contentType = $response->getHeaderLine('Content-Type');

            $extension = '';
            if ($contentType === 'image/jpeg' || $contentType === 'image/jpg') {
                $extension = '.jpg';
            } elseif ($contentType === 'image/png') {
                $extension = '.png';
            } elseif ($contentType === 'image/gif') {
                $extension = '.gif';
            } else {
                throw new \Exception('Неподдерживаемый тип изображения: type -' . $contentType . ' url -' . $url);
            }
            $fileName = uniqid() . $extension;
            $res = Storage::disk('local')
                ->put('public/' . $type . '/' . $fileName, $imageContent);
            if (!$res) {
                throw new \Exception("Ошибка сохранения файла");
            } else {
                return '/storage/' . $type . '/' . $fileName;
            }
        }catch (\Exception $e) {
            //если не смог достучаться , вывожу заглушку
                return '/images/plug.png';
        }
    }

}
