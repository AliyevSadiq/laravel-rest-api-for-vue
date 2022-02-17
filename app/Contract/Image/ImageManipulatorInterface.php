<?php

declare(strict_types=1);

namespace App\Contract\Image;


use Illuminate\Http\UploadedFile;

interface ImageManipulatorInterface
{
    public function uploadFile(UploadedFile $file, string $diskName): string;
    public function delete(string $filename, string $diskName): void;
}
