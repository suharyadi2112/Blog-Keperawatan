<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


use App\Models\Informasi;


class InformasiController extends Controller
{
    public function index(Request $request){

        if ($request->ajax()) {

        $data = Informasi::query();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $actionBtn = '
                <a>
                <button type="button" class="btn btn-sm round btn-outline-info shadow upInformasi" data-id="'.$row->id.'"><i class="fa fa-solid fa-pen"></i></button>
                </a>
                <a>
                <button type="button" class="btn btn-sm round btn-outline-danger shadow delInformasi" data-id='.$row->id.'><i class="fa fa-solid fa-trash"></i></button>
                </a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.informasi.informasi');
        
    }

    public function addInformasi(Request $request){
        
        try {

            $request->merge(['id_user' => Auth::id()]);
            $validator = $this->validateInformasi($request, 'insert');

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            DB::transaction(function () use ($request) {
                Informasi::create([
                    'id_user' => $request->id_user,
                    'judul_informasi' => $request->input('judul_informasi'),
                    'isi_informasi' => $request->input('isi_informasi'),
                ]);
            });

            return response()->json(['status' => 'success', 'message' => 'Informasi created', 'data' => $request->all()], 200);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'fail', 'message' => $e->errors(), 'data' => null], 400);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    public function deleteInformasi($id){
        try {
            $record = Informasi::find($id);
            $record->delete();
            return response()->json(['status' => 'success', 'message' => 'Informasi deleted', 'data' => null], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    public function informasiByID($id){
        try {
            $record = Informasi::find($id);
            return response()->json(['status' => 'success', 'message' => 'Informasi retrieved', 'data' => $record], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    private function validateInformasi(Request $request, $action = 'insert')
    {
        if($action == 'insert'){
            $validator = Validator::make($request->all(), [
                'id_user' => 'required|max:12',
                'judul_informasi' => 'required|string|max:100',
                'isi_informasi' => 'required|nullable|string|max:10000',
            ]);
        }
        return $validator;
    }

}
