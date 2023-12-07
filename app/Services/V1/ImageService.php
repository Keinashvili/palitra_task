<?php

namespace App\Services\V1;

class ImageService
{
    public function upload($request)
    {
        $path = storage_path('images/');
        !is_dir($path) &&
        mkdir($path, 0777, true);

        if ($file = $request->file('image')) {
            $filename = $file->getClientOriginalName();
            $file->storeAs('public/', $filename);

            return $filename;
        }

        return null;
    }
}
