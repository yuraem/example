<?php

namespace App\Http\Controllers\Manager\Main;

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
        
        $user = Auth::user();

        return view('manager.main.index', [
            'user' => $user
        ]);
    
    }
   
}
