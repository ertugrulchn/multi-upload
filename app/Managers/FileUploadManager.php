<?php

namespace App\Managers;

use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class FileUploadManager {

    public static string $disk = 'local';

    public static string $dirName = 'uploads';

    public static function single(FormRequest $request, string $fieldName = 'file', ?Model $imageable = null) {
        $path = self::proceed($request->$fieldName);
        $model = self::createModel($path, Auth::user(), $imageable);
        $model->save();

        return $model;
    }

    public static function multiple(FormRequest $request, string $fieldName = 'files', ?Model $imageable = null) {
        $images = collect([]);
        foreach ($request->file($fieldName) as $file) {
            $path = self::proceed($file);
            $model = self::createModel($path, Auth::user(), $imageable);
            $model->save();
            $images->add($model);
        }

        return $images;
    }

    public static function createNewFileName() {
        return Str::upper(Str::uuid() . '-' . uniqid());
    }

    public static function getStoragePath() {
        if (is_dir(storage_path('public/' . self::$dirName))) {
            mkdir(storage_path('public/' . self::$dirName));
        }

        return 'public/' . self::$dirName;
    }

    protected static function createModel(string $filePath, ?User $user = null, ?Model $imageable = null) {
        return new Image([
            'path' => $filePath,
            'user_id' => !is_null($user) ? $user->id : null,
            'imageable_type' => !is_null($imageable) ? get_class($imageable) : null,
            'imageable_id' => !is_null($imageable) ? $imageable->id : null,
        ]);
    }

    protected static function proceed(UploadedFile $file) {
        return Storage::disk(self::$disk)
            ->putFileAs(self::getStoragePath(),
                $file, self::createNewFileName() . '.' . $file->getClientOriginalExtension(), [
                    'visibility' => 'public',
                ]);
    }

}
