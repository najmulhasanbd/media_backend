<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

trait ImageUploadTrait
{
    /**
     * Upload an image, resize/scale optionally, and convert to WebP format.
     *
     * @param UploadedFile|string $file
     * @param string $path Destination directory relative to public_path
     * @param int|null $width
     * @param int|null $height
     * @param int $quality WebP quality (1-100)
     * @param bool $crop If true, crops/covers to exact dimensions; if false, scales down keeping aspect ratio
     * @return string|null Relative path to the saved WebP image (e.g. 'uploads/img_xxx.webp')
     */
    public function uploadImage(
        UploadedFile|string $file,
        string $path = 'uploads',
        ?int $width = null,
        ?int $height = null,
        int $quality = 80,
        bool $crop = false
    ): ?string {
        try {
            $destinationDir = public_path($path);
            if (!File::isDirectory($destinationDir)) {
                File::makeDirectory($destinationDir, 0755, true, true);
            }

            // Generate unique webp filename
            $filename = uniqid('img_', true) . '_' . time() . '.webp';
            $fullPath = $destinationDir . DIRECTORY_SEPARATOR . $filename;

            // Decode image from content or file path
            $source = $file instanceof UploadedFile ? $file->getContent() : (file_exists($file) ? file_get_contents($file) : $file);
            $image = Image::decode($source);

            // Handle resizing if width/height specified
            if ($width && $height) {
                if ($crop) {
                    $image->cover($width, $height);
                } else {
                    $image->scaleDown($width, $height);
                }
            } elseif ($width || $height) {
                $image->scaleDown($width, $height);
            }

            // Encode directly to WebP and save
            $encodedWebp = $image->encodeUsingFileExtension('webp')->toString();
            file_put_contents($fullPath, $encodedWebp);

            return $path . '/' . $filename;
        } catch (\Throwable $e) {
            report($e);
            return null;
        }
    }

    /**
     * Update an existing image: deletes old image and uploads new one as WebP.
     *
     * @param UploadedFile|string|null $file
     * @param string|null $oldPath
     * @param string $path
     * @param int|null $width
     * @param int|null $height
     * @param int $quality
     * @param bool $crop
     * @return string|null
     */
    public function updateImage(
        UploadedFile|string|null $file,
        ?string $oldPath = null,
        string $path = 'uploads',
        ?int $width = null,
        ?int $height = null,
        int $quality = 80,
        bool $crop = false
    ): ?string {
        if ($file) {
            $this->deleteImage($oldPath);
            return $this->uploadImage($file, $path, $width, $height, $quality, $crop);
        }

        return $oldPath;
    }

    /**
     * Delete an image from public directory.
     *
     * @param string|null $path
     * @return bool
     */
    public function deleteImage(?string $path): bool
    {
        if (!empty($path)) {
            $fullPath = public_path($path);
            if (File::exists($fullPath) && !File::isDirectory($fullPath)) {
                return File::delete($fullPath);
            }
        }

        return false;
    }
}
