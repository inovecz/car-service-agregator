<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Resources\MediaResource;


class ImageUploadService
{
    public function process($object, $url, $collectionName = 'Images')
    {
        $media = $object->addMediaFromUrl($url)->toMediaCollection($collectionName);

        if ($media) {
            return true;
        } else {
            return [
                'response' => [
                    'message' => 'Chyba při ukládání souboru.'
                ],
                'statusCode' => 400
            ];
        }
    }
}
