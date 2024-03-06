<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\File\UploadRequest;

class FilesController extends Controller
{

    public function upload(UploadRequest $request)
    {
        $file = $request->file('file');
        $filename = $file->hashName();

        $user = \Auth::user();
        $user->uploadFile($file);

        \Storage::disk('public')->putFileAs(config('app.uploads.path'), $file, $filename);

        return response()->json(['message' => 'File uploaded successfully',
            'url' => \Storage::disk('public')->url(config('app.uploads.path') . '/' . $filename),
        ], 201);
    }
}
