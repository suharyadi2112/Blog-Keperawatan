<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class DokumentasiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('dokumentasis')
                ->select('nama_dokumentasi', 'foto_dokumentasi','created_at')
                ->orderBy('created_at', 'desc')
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn ='<button type="button" class="btn btn-sm round btn-outline-success shadow" title="Details">
                    <i class="fa fa-lg fa-fw fa-eye"></i>
                    </button>';
                    return $actionBtn;
                })
                ->editColumn('created_at', function ($row) {
                    Carbon::setLocale('id');
                    return Carbon::parse($row->created_at)->translatedFormat('l, d F Y');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.dokumentasi.index');
    }
}
