<?php

namespace HR\Http\Controllers;

use Folklore\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class uploaderController extends Controller
{
    public function __construct() {

        $this->middleware(['auth']);
    }

    public function imageUpload(Request $request)
    {
        switch ($request['name'])
        {
            case 'avatar':
                $this->validate($request, [
                    'file' => 'image|max:1024'
                ]);
                if ($request->file('file')->isValid()) {

                    $image = $request->file('file');
                    $fileName = time() . '.' . $image->getClientOriginalExtension();

                    $img = Image::make($image->getRealPath());
                    $img->resize(300, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->stream();
                    Storage::disk('uploads')->put('users/' . Auth::user()->id . '/avatar' . '/' . $fileName, $img, 'public');

                    $user = Auth::user();
                    if(Storage::disk('uploads')->exists($user->avatar))
                        Storage::disk('uploads')->delete($user->avatar);

                    $user->avatar = '/users/' . Auth::user()->id . '/avatar' . '/' . $fileName;
                    $user->save();
                    $result = '/users/' . Auth::user()->id . '/avatar' . '/' . $fileName;
                    echo json_encode(array('file' => $result));
                } else
                    echo json_encode(array('status' => 'no'));
                break;

            case 'cover':
                $this->validate($request, [
                    'file' => 'image|max:2048'
                ]);
                if ($request->file('file')->isValid()) {

                    $image = $request->file('file');
                    $fileName = time() . '.' . $image->getClientOriginalExtension();

                    $img = Image::make($image->getRealPath());
                    $img->resize(1024, 300, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->stream();
                    Storage::disk('uploads')->put('users/' . Auth::user()->id . '/cover' . '/' . $fileName, $img, 'public');

                    $user = Auth::user();
                    if(Storage::disk('uploads')->exists(substr($user->cover, 8)))
                        Storage::disk('uploads')->delete(substr($user->cover, 8));

                    $user->cover = '/users/' . Auth::user()->id . '/cover' . '/' . $fileName;
                    $user->save();
                    $result = '/users/' . Auth::user()->id . '/cover' . '/' . $fileName;
                    echo json_encode(array('file' => $result));
                } else
                    echo json_encode(array('status' => 'no'));
                break;
            default:
                echo 'stupid';
                break;
        }
    }

    public function imageRemove(Request $request)
    {

    	switch ($request['name'])
        {
            case 'avatar':
                $user = Auth::user();
	            if(Storage::disk('uploads')->exists($user->avatar))
		            Storage::disk('uploads')->delete($user->avatar);
                $user->avatar = '/GolrangSystem-File-Manager/photos/1/default/noimage_profile.png';
                $user->save();
                $result = '/GolrangSystem-File-Manager/photos/1/default/noimage_profile.png';
                echo json_encode(array('file' => $result));
                break;
            case 'cover':
                $user = Auth::user();
	            if(Storage::disk('uploads')->exists($user->avatar))
		            Storage::disk('uploads')->delete($user->avatar);
                $user->cover = '/GolrangSystem-File-Manager/photos/1/default/noimage_cover.jpg';
                $user->save();
                $result = '/GolrangSystem-File-Manager/photos/1/default/noimage_cover.jpg';
                echo json_encode(array('file' => $result));
                break;
            default:
                echo 'stupid';
                break;
        }
    }
}
