<?php

namespace App\Http\Controllers\User\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use View;
use App\Models\User;
use App\Models\Companies;
use App\Models\Payout;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function __constructor()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        
        $user = Auth::user();
        return view('user.main.index', [
            'user' => $user
        ]);
    
    }
   
}
