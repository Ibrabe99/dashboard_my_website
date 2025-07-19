<?php

use Illuminate\Support\Str;


function uploadImage($folder, $image)
{
    if (!$image || !$image->isValid()) {
        throw new \Exception('Invalid image file');
    }

    $filename = time() . '_' . $image->getClientOriginalName();

    $path = $image->storeAs($folder, $filename, 'public'); // ← يخزنها في storage/app/public/{folder}

    return 'storage/' . $path; // ← لو عامل storage:link
}


function uploadVideo($folder, $video)
{
    $video->store('/', $folder);
    $filename = $video->hashName();
    $filePath = 'assets/video/' . $folder . '/' . $filename;
    return $filePath;
}
