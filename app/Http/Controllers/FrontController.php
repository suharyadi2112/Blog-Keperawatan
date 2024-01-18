<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenModel;
use App\Models\DokumenModel as ModelsDokumenModel;
use App\Models\Informasi;
use App\Models\Dokumentasi;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class FrontController extends Controller
{

    public function indexfrontend()
    {
        $dokumens=DokumenModel::orderby('created_at','desc')->limit(5)->get();
        $informasi=Informasi::with('dokumentasis')->orderby('created_at','desc')->limit(3)->get();
        return view('frontend.index',)->with('dokumens',$dokumens)->with('informasi',$informasi);
    }
    public function indexDokumentasi(){
        $dokumentasis=Dokumentasi::orderby('created_at','desc')->paginate(12);
        return view('frontend.dokumentasi')->with('dokumentasis',$dokumentasis);
    }

    public function indexDokumen(){
        $dokumens=ModelsDokumenModel::orderby('created_at','desc')->paginate(15);
        return view('frontend.dokumen')->with('dokumens',$dokumens);;
    }

    public function indexInformasi(){

        $informasi=Informasi::with('dokumentasis', 'dokumen')->orderby('created_at','desc')->paginate(6);

        return view('frontend.informasi', ['informasi' => $informasi])->with('informasis',$informasi);
    }

    public function detailInformasi(Request $request){

        $informasi=Informasi::with('dokumentasis', 'dokumen', 'user')->orderby('created_at','desc')->where('id','=',$request->id)->get();
        $latestInformasi = Informasi::find($request->id)->orderBy('created_at', 'desc')->take(3)->get();

        if ($request->ajax()) {
            return response()->json($informasi);
        }

        return view('frontend.informasi-detail', ['idInfo' => $request->id, 'informasi' => $informasi, 'latestInformasi' => $latestInformasi]);
    }
}
