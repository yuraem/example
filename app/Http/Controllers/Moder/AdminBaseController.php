<?php

namespace App\Http\Controllers\Moder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBaseController extends Controller
{
    protected $perPage = 15;

    public function __construct ()
    {
        $this->middleware('auth');
        $this->middleware('status');
    }
}
