<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class ProfilController extends Controller
{
    protected $avatarsPath = '/uploads/users/avatars/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('user.profil.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        
        $user = User::findOrFail(Auth::user()->id ?? null); //Get role specified by id
        
        $rule = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'image' => 'mimes:jpeg,jpg,png|max:10240',
        ];

        $this->validate($request, $rule);

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->payid = $request->payid;
        $user->email = $request->email;
        $user->paysystem = $request->paysystem;

        $oldAvatar = $user->avatar;

        $user->save();

        $avatar = $request->file('avatar');

        if ($avatar) {
            $image = Image::make($avatar);
            $image->resize(90, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->encode('jpg', 95);

            $newAvatarName = Auth::user()->id . '_' . time() . '.jpg';
            $newImagePath = $this->avatarsPath . '/' . $newAvatarName;
            $user->avatar = $newAvatarName;

            Storage::put($newImagePath, $image);
            if ($oldAvatar) {
                Storage::delete($this->avatarsPath . '/' . $oldAvatar);
            }

            $user->save();
        }

        return redirect()->route('user.index')->with('info', 'Профиль изменён');
    }    
}
