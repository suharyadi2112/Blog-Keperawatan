<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class InformasiController extends Controller
{
    public function index(Request $request){

        if ($request->ajax()) {

        $data = DB::table('users')
        ->select('id','name','email')
        ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $actionBtn = '
                <a href="/informasi/edit/'.$row->id.'">
                <button type="button" class="btn btn-sm round btn-outline-info shadow"><i class="fa fa-solid fa-pen"></i></button>
                </a>
                <a href="/informasi/del/'.$row->id.'">
                <button type="button" class="btn btn-sm round btn-outline-danger shadow"><i class="fa fa-solid fa-trash"></i></button>
                </a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.informasi.informasi');
        
    }
}
