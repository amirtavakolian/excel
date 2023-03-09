<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;

class UploadService
{
    public static function upload($file)
    {
        $extention = $file->getClientOriginalExtension();
        return $file->storeAs('', Carbon::now()->timestamp . Str::random(12) . "." . $extention, 'public');
    }
}
