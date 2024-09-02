<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Http\Requests\Frontend\ProfilePasswordUpdateRequest;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use Auth;


class ProfileController extends Controller
{
    //use function
    use FileUploadTrait;

    public function updateProfile (ProfileUpdateRequest $request) : RedirectResponse {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr()->success('Update User Profile Successfully.');

        return redirect()->back();
    }

    public function updatePassword (ProfilePasswordUpdateRequest $request) : RedirectResponse {
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        toastr()->success('Password Update Successfully.');

        return redirect()->back();
    }

    // Upload Images
    public function updateAvatar (Request $request) {
        //dd($request->all());
        $user = Auth::user();
        $imagePath = $this->uploadImage($request, 'avatar');

        $user->avatar = $imagePath;
        $user->save();

        return response(['status' => 'success', 'message' => 'Avatar Updated Successfully.']);
    }
}
