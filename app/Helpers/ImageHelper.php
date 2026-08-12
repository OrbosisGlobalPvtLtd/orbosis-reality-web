<?php

namespace App\Helpers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class ImageHelper
{
    /**
     * Safely process and save an uploaded image file.
     * Supports WebP conversion with automatic fallback for AVIF, SVG, HEIC, etc.
     *
     * @param \Illuminate\Http\UploadedFile|mixed $file
     * @param string $prefix
     * @param string $directory
     * @param int $quality
     * @return string|null Relative image path
     */
    public static function saveImageSafely($file, $prefix = 'img', $directory = 'uploads/custom-images', $quality = 80)
    {
        if (!$file) {
            return null;
        }

        $dir_path = public_path($directory);
        if (!File::exists($dir_path)) {
            File::makeDirectory($dir_path, 0777, true, true);
        }

        $date_suffix = date('-Y-m-d-h-i-s-') . rand(999, 9999);
        $webp_filename = $prefix . $date_suffix . '.webp';
        $relative_path = $directory . '/' . $webp_filename;

        try {
            Image::make($file)
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('webp', $quality)
                ->save(public_path($relative_path));

            return $relative_path;
        } catch (\Throwable $e) {
            if (is_string($file)) {
                return $file;
            }
            $orig_ext = method_exists($file, 'getClientOriginalExtension') ? strtolower($file->getClientOriginalExtension()) : 'png';

            if (in_array($orig_ext, ['heic', 'heif'])) {
                $tempPath = method_exists($file, 'getRealPath') ? $file->getRealPath() : null;
                if ($tempPath && file_exists($tempPath)) {
                    $destPath = public_path($relative_path);
                    $cmd = sprintf('python -c "from PIL import Image; import pillow_heif; pillow_heif.register_heif_opener(); img = Image.open(r\'%s\'); img.save(r\'%s\', \'WEBP\')" 2>&1', $tempPath, $destPath);
                    @exec($cmd);
                    if (file_exists($destPath) && filesize($destPath) > 0) {
                        return $relative_path;
                    }
                }
            }

            if (empty($orig_ext)) {
                $orig_ext = 'png';
            }
            $fallback_filename = $prefix . $date_suffix . '.' . $orig_ext;
            if (method_exists($file, 'move')) {
                $file->move($dir_path, $fallback_filename);
                return $directory . '/' . $fallback_filename;
            }

            return null;
        }
    }

    /**
     * Save property-specific media inside uploads/properties/property-{id}/{type}/
     *
     * @param \Illuminate\Http\UploadedFile|mixed $file
     * @param int|string $property_id
     * @param string $type ('thumbnail', 'sliders', 'plans', 'video-thumb')
     * @param int $quality
     * @return string|null Relative image path
     */
    public static function savePropertyMedia($file, $property_id, $type = 'thumbnail', $quality = 80)
    {
        if (!$file || !$property_id) {
            return null;
        }

        $directory = "uploads/properties/{$property_id}/{$type}";
        $prefix = match($type) {
            'thumbnail' => 'thumb',
            'sliders' => 'slider',
            'plans' => 'plan',
            'video-thumb' => 'vthumb',
            default => $type
        };

        return self::saveImageSafely($file, $prefix, $directory, $quality);
    }

    /**
     * Delete entire property media directory upon property deletion.
     *
     * @param int|string $property_id
     * @return void
     */
    public static function deletePropertyDirectory($property_id)
    {
        if (!$property_id) {
            return;
        }

        $dir = public_path("uploads/properties/{$property_id}");
        if (File::exists($dir)) {
            File::deleteDirectory($dir);
        }
    }
}
