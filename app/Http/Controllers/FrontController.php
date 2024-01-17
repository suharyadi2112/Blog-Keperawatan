<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenModel;
use App\Models\DokumenModel as ModelsDokumenModel;
use App\Models\Informasi;
use App\Models\Dokumentasi;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{

    public function indexfrontend()
    {
        $dokumens=DokumenModel::orderby('created_at','desc')->limit(5)->get();
        $informasi=Informasi::with('dokumentasis')->orderby('created_at','desc')->limit(3)->get();
        return view('frontend.index',)->with('dokumens',$dokumens)->with('informasi',$informasi);
    }
    public function indexDokumentasi(){
        return view('frontend.dokumentasi');
    }

    public function indexDokumen(){
        $dokumens=ModelsDokumenModel::orderby('created_at','desc')->get();
        return view('frontend.dokumen')->with('dokumens',$dokumens);;
    }

    public function dokumenDetail($id){
        $dokumen=DokumenModel::find($id);
        if(!$dokumen) return redirect(route('welcome'));
 
        return view('frontend.dokumen-detail')->with('dokumen',$dokumen);
    }
}
