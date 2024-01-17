<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function indexfrontend()
    {
        return view('frontend.index');
    }

    public function indexDokumentasi(){
        return view('frontend.dokumentasi');
    }
}
