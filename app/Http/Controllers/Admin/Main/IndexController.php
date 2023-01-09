<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use View;

class IndexController extends Controller
{
    public function __construct()
    {        
        $this->middleware('auth');
        $this->middleware('status');
    }

    public function __invoke(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->paginate(10);
        
        return view('admin.main.index', [
            'user' => $user
        ]);          
    }
   
}
