<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $folder = uniqid() . '-' . now()->timestamp;
            $filename = $file->getClientOriginalName();
            $file->storeAs('img/tmp/' . $folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename
            ]);

            return $folder;
        }

        return '';
    }

    public function destroy(Request $request)
    {
        $tempFile = TemporaryFile::where('folder', $request->getContent())->first();
        if ($tempFile) {
            File::deleteDirectory(storage_path("app\\img\\tmp\\$tempFile->folder"));
            $tempFile->delete();
        }
    }
}
