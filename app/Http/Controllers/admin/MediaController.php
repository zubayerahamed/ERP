<?php

namespace App\Http\Controllers\admin;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends KitController
{
    public function index()
    {
        return view('admin.media', [
            'medias' => Media::all()
        ]);
    }

    public function addNewPage()
    {
        return view('admin.media-create');
    }

    public function save(Request $request)
    {
        $uploadedFile = $request->file('file');
        $mediaType = $uploadedFile->getMimeType();
        $fileOriginalName = $uploadedFile->getClientOriginalName();
        $fileExtention = $uploadedFile->getClientOriginalExtension();

        if (!in_array('.' . $fileExtention, Media::supportedFileExt)) return response()->json(['status' => 'error', 'message' => 'File not supported']);

        $uploadPath = 'uploads/media/' . date('Y') . '/' . date('m') . '/' . date('d');

        $newFileName = uniqid() . '.' . $fileExtention;

        $uploadone = $uploadedFile->storeAs($uploadPath, $newFileName, 'public');
        if (!$uploadone) return response()->json(['status' => 'error', 'message' => 'File not uploaded']);

        $media = new Media();
        $media->title = $newFileName;
        $media->original_name = $fileOriginalName;
        $media->media_type = $mediaType;
        $media->file_path = '/' . $uploadPath . '/';
        $media->use_for_global = true;
        $media->user_id = auth('admin')->id();

        $saved = $media->save();
        if (!$saved) {
            // Delete file from storage
            unlink($uploadone);
            return response()->json(['status' => 'error', 'message' => 'File not uploaded']);
        }

        return response()->json(['status' => 'error', 'message' => 'File uploaded', 'media' => $media]);
    }
}
