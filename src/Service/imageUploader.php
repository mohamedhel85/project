<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
class ImageUploader
{
    public function uploadImageToCloudinary(UploadedFile $file)
    {
        $fileName = $file->getRealPath();

        \Cloudinary::config([
            "cloud_name" => getenv('firascloud'),
            'api_key' => getenv('955166492124659'),
            "api_secret" => getenv('g04OtgHzu2hYWYKXu7kZmCvl7Pc')
        ]);

        $imageUploaded = \Cloudinary\Uploader::upload($fileName);

        return $imageUploaded['secure_url'];
    }
}
