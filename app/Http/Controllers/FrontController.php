<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\DokumenModel;
use App\Models\DokumenModel as ModelsDokumenModel;

class FrontController extends Controller
{

    public function indexfrontend()
    {
        $dokumens=ModelsDokumenModel::orderby('created_at','desc')->limit(5)->get();
        return view('frontend.index')->with('dokumens',$dokumens);
    }




    
   

    public function indexDokumentasi(){
        return view('frontend.dokumentasi');
    }
}
