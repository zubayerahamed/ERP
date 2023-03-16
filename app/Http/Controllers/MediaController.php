<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
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

        $image = $request->file('file');
        $mediaType = $image->getMimeType();
        $originalName = $image->getClientOriginalName();
        $extention = pathinfo($originalName, PATHINFO_EXTENSION);

        $uploadPath = 'upload/media/' . date('Y') . '/' . date('m') . '/' . date('d');
        $fullDirectory = public_path($uploadPath);
        $newFileName = uniqid() . '.' . $extention;

        $image->move($fullDirectory, $newFileName);

        $media = new Media();
        $media->title = $newFileName;
        $media->original_name = $originalName;
        $media->media_type = $mediaType;
        $media->file_path = '/' . $uploadPath . '/';

        $saved = $media->save();

        if ($saved) {
            return response()->json([
                'status' => 'success',
                'message' => 'File uploaded successfully',
                'filename' => $media->file_path . $media->title
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'File not uploaded']);
    }
}
