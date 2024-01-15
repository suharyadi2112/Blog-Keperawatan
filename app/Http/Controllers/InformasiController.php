<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

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

    public function addInformasi(Request $request){
        
        try {
            $validator = $this->validateInformasi($request, 'insert');

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            DB::transaction(function () use ($request) {
                Informasi::create([
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

    private function validateInformasi(Request $request, $action = 'insert')
    {
        if($action == 'insert'){
            $validator = Validator::make($request->all(), [
                'judul_informasi' => 'required|string|max:100',
                'isi_informasi' => 'required|nullable|string|max:5000',
            ]);
        }
        return $validator;
    }

}
