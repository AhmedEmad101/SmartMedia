<?php

namespace App\Actions\Image;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class storeImageAction
{
    /**
     * Store an uploaded image in the public storage.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder  (default: 'uploads')
     * @return string|null  The relative path (e.g. 'posts/filename.jpg')
     */
    public function execute(UploadedFile $file, string $folder = 'uploads'): ?string
    {
        try {
            // Create folder if not exists and store image
            $path = $file->store($folder, 'public'); // saves to storage/app/public/{folder}
            return $path; // e.g. posts/abc123.jpg
        } catch (\Exception $e) {
            \Log::error('Image upload failed: ' . $e->getMessage());
            return null;
        }
    }
}
