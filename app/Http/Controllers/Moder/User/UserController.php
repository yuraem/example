<?php

namespace App\Http\Controllers\Moder\User;

// use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminBaseController;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends AdminBaseController
{
    protected $avatarsPath = '/uploads/users/avatars/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $whereQuery = [];

        $statusFilter = $request->input('filter');
        if ($statusFilter) {
            switch ($statusFilter) {
                case 'active':
                    $whereQuery[] = ['blocked', 0];
                    break;
                case 'blocked':
                    $whereQuery[] = ['blocked', 1];
                    break;
                default:
                    break;
            }
        }

        $searchQuery = $request->input('q');
        if ($searchQuery) {
            $searchFilter[] = ['name', 'like', '%' . $searchQuery . '%'];
        }
        $roles = User::getRoles();
        $users = User::where($whereQuery)->where(function ($query) use ($searchQuery) {
            if ($searchQuery) {               
                $query->orWhere('name', 'like', '%' . $searchQuery . '%');
                $query->orWhere('email', 'like', '%' . $searchQuery . '%');                
            }
        })->orderBy('created_at', 'desc')->paginate($this->perPage);

        // dd($users);
        return view('moder.user.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = User::getRoles();
        return view('moder.user.create', [
            'user' => new User,
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([           
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',            
            'image' => 'mimes:jpeg,jpg,png|max:10240',
        ]);

        $requestData = $request->all();

        $requestData['password'] = Hash::make($requestData['password']);

        $avatar = $requestData['avatar'] ?? false;
        unset($requestData['avatar']);

        $model = new User($requestData);
        $model->save();

        if ($avatar) {
            $image = Image::make($avatar);
            $image->resize(90, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->encode('jpg', 95);

            $newAvatarName = $model->id . '_' . time() . '.jpg';
            $newImagePath = $this->avatarsPath . $newAvatarName;
            $model->avatar = $newAvatarName;

            Storage::put($newImagePath, $image);

            $model->save();
        }

        return redirect()->route('moder.user.index')->with('success', trans('users/index.crud_messagedscreated'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $roles = User::getRoles();
        return view('moder.user.edit', [
            'user' => User::find(intval($id)),
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd( $id);
        $user = User::findOrFail( $id ?? null); //Get role specified by id
        // dd($user);
        $request->validate([
            // 'login' => 'required|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,'. $user->id,
            'user_id' => 'integer|exists:users,id',
            'image' => 'mimes:jpeg,jpg,png|max:10240',
        ]);

        $requestData = $request->all();
        $requestData['password'] = Hash::make($requestData['password']);
        $avatar = $requestData['avatar'] ?? false;
        unset($requestData['avatar']);

        $model = User::find(intval($id));
        $model->update($requestData);

        if ($avatar) {
            $oldAvatar = $model->avatar;

            $image = Image::make($avatar);
            $image->resize(90, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->encode('jpg', 95);

            $newAvatarName = $id . '_' . time() . '.jpg';
            $newImagePath = $this->avatarsPath . '/' . $newAvatarName;
            $model->avatar = $newAvatarName;

            Storage::put($newImagePath, $image);
            if ($oldAvatar) {
                Storage::delete($this->avatarsPath . '/' . $oldAvatar);
            }

            $model->save();
        }

        return redirect()->route('moder.user.index')->with('success', trans('users/index.crud_messages.edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = User::find(intval($id));
        $model->delete();

        return redirect()->route('moder.user.index')->with('success', trans('users/index.crud_messages.removed'));
    }
}
