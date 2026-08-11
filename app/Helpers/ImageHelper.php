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
                ->encode('webp', $quality)
                ->save(public_path($relative_path));

            return $relative_path;
        } catch (\Throwable $e) {
            // Fallback for AVIF, SVG, HEIC or GD driver incompatible formats
            $orig_ext = strtolower($file->getClientOriginalExtension());
            if (empty($orig_ext)) {
                $orig_ext = 'png';
            }
            $fallback_filename = $prefix . $date_suffix . '.' . $orig_ext;
            $file->move($dir_path, $fallback_filename);

            return $directory . '/' . $fallback_filename;
        }
    }
}
