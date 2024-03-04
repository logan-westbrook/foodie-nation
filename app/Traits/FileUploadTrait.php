<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;

trait FileUploadTrait
{
    public static function uploadFile(
        Request $request,
        string $inputName,
        ?string $oldPath = null,
        string $path = '/uploads'
    ): ?string {
        if (!$request->hasFile($inputName)) {
            return null;
        }
        
        self::removeImage($oldPath);
        $image = $request->{$inputName};
        $imageName = 'media_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path($path), $imageName);

        return "$path/$imageName";
    }

    public static function removeImage(?string $path): void
    {
        if ($path && File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}

