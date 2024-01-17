<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\Informasi;
use App\Models\Dokumentasi;
use App\Models\DokumenModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class InformasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        if ($request->ajax()) {

        $data = Informasi::with(['dokumentasis', 'dokumen'])->orderBy('id', 'DESC');

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){

                $actionBtn = '
                <a href="'.Route('informasiShowUpdate', ['id' => $row->id]).'">
                <button type="button" class="btn btn-sm round btn-outline-info shadow"><i class="fa fa-solid fa-pen"></i></button>
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

                //file dokumentasi -----------------
                $uploadedFiles = [];
                if ($request->hasFile('file_dokumentasi')) {
                    $files_dokumentasi = $request->file('file_dokumentasi');
                    
                    foreach ($files_dokumentasi as $file) {
                        $nama_foto = time() . "_" . $file->getClientOriginalName();
                        $file->storeAs('dokumentasi', $nama_foto, 'public');

                        $uploadedFiles[] = [
                            'nama_dokumentasi' => 'informasi',
                            'foto_dokumentasi' => $nama_foto
                        ];
                    }
                }
                
                $dokumentasiIds = [];
                foreach ($uploadedFiles as $file) {
                    $dokumentasiIds[] = Dokumentasi::create($file)->id;
                }

                //file dokumen --------------------
                $uploadedFilesDokumen = [];
                if ($request->hasFile('file_dokumen')) {
                    $files_dokumen = $request->file('file_dokumen');
                    
                    foreach ($files_dokumen as $file) {
                        
                        $nama_foto=Str::slug($file->getClientOriginalName()).'-'.time().'.'.$file->extension();
                        // $name = time() . "_" . $file->getClientOriginalName();
                        $path =  $file->storeAs('dokumen', $nama_foto, 'public');

                        $uploadedFilesDokumen[] = [
                            'id_user' => Auth::id(),
                            'deskripsi' => 'dokumen informasi', 
                            'nama' => 'informasi',
                            'file' => str_replace('public/','',$path),
                        ];
                    }
                }
                
                $dokumenIds = [];
                foreach ($uploadedFilesDokumen as $fileDokumen) {
                    $dokumenIds[] = DokumenModel::create($fileDokumen)->id;
                }
                
                //-- Transaksi ----------------------------------
                $informasi = Informasi::create([
                    'id_user' => $request->id_user,
                    'judul_informasi' => $request->input('judul_informasi'),
                    'isi_informasi' => $request->input('isi_informasi'),
                ]);
                Dokumentasi::whereIn('id', $dokumentasiIds)->update(['id_informasi' => $informasi->id]);
                DokumenModel::whereIn('id', $dokumenIds)->update(['id_informasi' => $informasi->id]);


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
            
            $dokumen=DokumenModel::where('id_informasi', $id)->first();
            Storage::disk('public')->delete($dokumen->file);
            $dokumen->delete();

            $dokumentasi = Dokumentasi::where('id_informasi', $id)->first();
            if ($dokumentasi->foto_dokumentasi != null || Storage::disk('public')->exists('dokumentasi/' . $dokumentasi->foto_dokumentasi)) {
                Storage::disk('public')->delete('dokumentasi/' . $dokumentasi->foto_dokumentasi);
            }
            $dokumentasi->delete();

            return response()->json(['success' => 'Dokumentasi berhasil dihapus']);

            return response()->json(['status' => 'success', 'message' => 'Informasi deleted', 'data' => null], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    public function informasiByID($id){
        try {
            $record = Informasi::find($id);
            return view('admin.informasi.detail_informasi', ['detailinfo' => $record->isi_informasi, 'judulInfo' => $record->judul_informasi]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    public function informasiShowUpdate($id){
        try {
            $data = Informasi::find($id);

            return view('admin.informasi.edit_informasi', ['informasi' => $data]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage(), 'data' => null], 500);
        }
    }

    public function upDateInformasi(Request $request, $id){

        $informasi = Informasi::find($id);
        $informasi->update(['judul_informasi' => $request->judul_informasi, 'isi_informasi' => $request->isi_informasi]);

        return response()->json(['status' => 'success', 'message' => 'Informasi updated', 'data' => null], 200);

    }

    public function delFileDokumentasi(Request $request){

        try {

            if ($request->tipe == 'dokumentasi') {
                $dokumentasi = Dokumentasi::where('id', $request->idFile)->first();
                if ($dokumentasi->foto_dokumentasi != null || Storage::disk('public')->exists('dokumentasi/' . $dokumentasi->foto_dokumentasi)) {
                    Storage::disk('public')->delete('dokumentasi/' . $dokumentasi->foto_dokumentasi);
                }
                $dokumentasi->delete();
            }else if($request->tipe == 'dokumen'){
                $dokumen=DokumenModel::where('id', $request->idFile)->first();
                Storage::disk('public')->delete($dokumen->file);
                $dokumen->delete();
            }

            return response()->json(['status' => 'success', 'message' => 'Dokumentasi file deleted', 'data' => null], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage(), 'data' => null], 500);
        }

    }

    public function upFileDok(Request $request){
        try {

            if ($request->tipeFile == 'dokumentasi') {
                if ($request->hasFile('file_dok')) {
                    if ($request->idFiless) {
                        $existingData = Dokumentasi::find($request->idFiless);
                        if ($existingData && $existingData->foto_dokumentasi) {
                            Storage::disk('public')->delete('/dokumentasi' . $existingData->foto_dokumentasi);
                        }
                    }
           
                    $foto_dokumentasi = $request->file('file_dok');
                    $nama_foto = time() . "_" . $foto_dokumentasi->getClientOriginalName();
                    $foto_dokumentasi->storeAs('/dokumentasi', $nama_foto, 'public');
    
                    $informasi = Dokumentasi::find($request->idFiless);
                    $informasi->update(['foto_dokumentasi' => $nama_foto]);   
                }
            }else if($request->tipeFile == 'dokumen'){

                if($request->hasFile('file_dok')){
                    $dokumen=DokumenModel::find($request->idFiless);
                    
                    $file_dokumen = $request->file('file_dok');
                    $name=Str::slug($file_dokumen->getClientOriginalName()).'-'.time().'.'.$file_dokumen->extension();
                    $path = $file_dokumen->storeAs('dokumen',$name);
                    $data['file']=str_replace('public/','',$path);  
                    Storage::disk('public')->delete($dokumen->file);
                    
                    $dokumen->update($data);
                } 
            
            }

            return response()->json(['status' => 'success', 'message' => 'Dok file deleted', 'data' => null], 200);

        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage(), 'data' => null], 500);
        }

            
        return response()->json(['status' => 'success', 'message' => '', 'data' => $request->all()], 200);
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
