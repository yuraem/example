<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBaseController extends Controller
{
    protected $perPage = 20;

    public function __construct ()
    {
        $this->middleware('auth');
        $this->middleware('status');
    }
}
