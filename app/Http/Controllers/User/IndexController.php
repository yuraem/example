<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('status');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('user');
    // }

     public function index(Request $request)
    {
dd($request);
        $user = User::where('id', Auth::user()->id)->paginate(10);
        

        return view('user.main.index', [
            'user' => $user
        ]);
    
    }
}
