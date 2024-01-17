<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenModel;
 


use Illuminate\Support\Facades\DB;
use App\Models\Informasi;

class FrontController extends Controller
{

    public function indexfrontend()
    {
        $dokumens=DokumenModel::orderby('created_at','desc')->limit(5)->get();
        return view('frontend.index')->with('dokumens',$dokumens);
    }




    
   

    public function indexDokumentasi(){
        return view('frontend.dokumentasi');
    }

    public function indexDokumen(){
        return view('frontend.dokumen');
    }
    public function dokumenDetail($id){
        $dokumen=DokumenModel::find($id);
        if(!$dokumen) return redirect(route('welcome'));
 
        return view('frontend.dokumen-detail')->with('dokumen',$dokumen);
    }
}
