<?php


namespace App\Service\Image;


use App\Contract\Image\ImageManipulatorInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use  Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\Exception\CannotWriteFileException;
class ImageManipulator implements ImageManipulatorInterface
{

    public function uploadFile(UploadedFile $file, string $diskName): string
    {
        $imageName = Str::random(10) . '-' . time() . '.' . $file->extension();

        try {
            Storage::disk($diskName)->put($imageName,File::get($file));
        }catch (FileException $exception) {
            throw new CannotWriteFileException();
        }
        return $imageName;
    }

    public function delete(string $filename, string $diskName): void
    {
        if (Storage::disk($diskName)->exists($filename)){
            Storage::disk($diskName)->delete($filename);
        }
    }
}
