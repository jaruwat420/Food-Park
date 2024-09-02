<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Http\Requests\Admin\ProfilePasswordUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use Auth;


class ProfileController extends Controller
{
    //use function
    use FileUploadTrait;

    function index(Request $request)  {
        return view('admin.profile.index',[
            'user' => $request->user(),
        ]);
    }

    // Profile Update
    public function updateProfile(ProfileUpdateRequest $request) : RedirectResponse {

        $user = Auth::user();
        $imagePath = $this->uploadImage($request, 'avatar');

        //dd($imagePath);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = isset($imagePath) ? $imagePath : $user->avatar;
        $user->save();

        toastr('Update User Successfully.', 'success');

        return redirect()->back();
    }

    // Password Update
    public function updatePassword (ProfilePasswordUpdateRequest $request) : RedirectResponse {

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->avatar = $request->$avatar;
        $user->save();

        toastr()->success('Password Update Successfully.');

        return redirect()->back();
    }
}
