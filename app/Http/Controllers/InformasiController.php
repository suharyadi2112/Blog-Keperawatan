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
        ->select('name','email')
        ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $actionBtn = 'tes';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.informasi.informasi');
        
    }
}
