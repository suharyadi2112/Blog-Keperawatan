<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=DB::table('users')->get();
        $dokumentasi=DB::table('dokumentasis')->get();
        $informasi=DB::table('informasis')->get();
        return view('home',['user'=>$user,'dokumentasi'=>$dokumentasi,'informasi'=>$informasi]);
    }
}
