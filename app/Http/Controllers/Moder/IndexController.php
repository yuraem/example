<?php

namespace App\Http\Controllers\Moder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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
        

        return view('moder.main.index', [
            'user' => $user
        ]);
    
    }
}
