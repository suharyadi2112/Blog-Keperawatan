<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Informasi;

class FrontController extends Controller
{
    //
    public function indexfrontend()
    {
       
        return view('frontend.index');

    }
}
