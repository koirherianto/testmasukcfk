<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if (view()->exists('example/' . $request->path())) {
            return view('example/' . $request->path());
        }
        return view('errors.404');
    }

    public function home()
    {
        return view('index');
    }

}
