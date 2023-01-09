<?php

namespace App\Http\Controllers\Moder\Main;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use View;

class IndexController extends Controller
{
    public function __constructor()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        
        $user = User::where('id', Auth::user()->id)->paginate(10);
        // dd(Auth::user());

        return view('moder.main.index', [
            'user' => $user
        ]);
        // return view('user.main.index');
    
    }
   
}
