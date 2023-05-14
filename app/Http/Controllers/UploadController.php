<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required|image'
        ]);
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $folder = uniqid() . '-' . now()->timestamp;
            $filename = $file->getClientOriginalName();
            $file->storeAs('company/tmp/' . $folder, $filename);

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
            File::deleteDirectory(storage_path("app\\company\\tmp\\$tempFile->folder"));
            $tempFile->delete();
        }
    }
}
