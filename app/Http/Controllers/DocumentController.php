<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenModel;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Str;
use  Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DokumenModel::orderby('created_at','desc')->get();
           

            return Datatables::of($data)
                ->addIndexColumn()
               
                ->addColumn('action', function ($row) {
                    $filePath=url('storage/'.$row->file);
                    $actionBtn ='<a href="'.$filePath.'" class="btn btn-sm round btn-outline-primary shadow mr-2" title="Download" target="_blank">
                    <i class="fa fa-fw fa-download"></i>
                    </a>';
                    $editAction=route('dokumen.edit',$row->id);
                    $actionBtn.='<a href="'.$editAction.'" class="btn btn-sm round btn-outline-warning shadow mr-2" title="Ubah">
                    <i class="fa fa-fw fa-edit "></i>
                    </a>';
                    $dataDelete=$row->id.",'".$row->nama."'";
                    $actionBtn.='  <a type="button" class="btn btn-sm round btn-outline-danger shadow" title="Hapus"   onclick="handleHapus('.$dataDelete.')"> <i class="fas  fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->editColumn('created_at', function ($row) {
                    Carbon::setLocale('id');
                    return Carbon::parse($row->created_at)->translatedFormat('l, d F Y');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.document.index');
    }

  
    public function create()
    {
        return view('admin.document.form_create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'namaDokumen'=>'required',
            'deskripsi'=>'required',
            'file'=>'required|mimes:xlsx,xls,csv,xlsm,docx,doc,pptx,ppt,pdf|max:2048'
        ],[
            'namaDokumen'=> 'Nama Dokumen Harus Diisi.',
            'deskripsi'=> 'Deskripsi Harus Diisi.',
            'file.required'=> 'File Harus Dipilih.',
            'file.max'=> 'Ukuran file terlalu besar. Disarankan maksimal 2 MB.',
            'file.mimes'=>'Format Dokumen tidak sesuai. Disarankan : doc, docx, xls, xlsx, ppt, pptx, txt, pdf, csv'
        ]);

       
        $name=Str::slug($request->namaDokumen).'-'.time().'.'.$request->file->extension();
        
     
        $path = $request->file('file')->storeAs('dokumen',$name);

        DokumenModel::create([
            'nama'=>$request->namaDokumen,
            'deskripsi'=>$request->deskripsi,
            'file'=>str_replace('public/','',$path),
            'id_user'=>auth()->user()->id,
        ]);

        session()->flash('success','Dokumen Berhasil Ditambah.');

        return redirect()->route('dokumen.index');
        // return response()->json(['success' => 'Dokumen berhasil ditambah']);
       
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        $dokumen=DokumenModel::find($id);
        if(!$dokumen) return redirect(route('dokumen.index'));



        return view('admin.document.form_edit')->with('dokumen',$dokumen);
    }

     
    public function update(Request $request, string $id)
    {

        $dokumen=DokumenModel::find($id);
        if(!$dokumen) return redirect(route('dokumen.index'));

        $request->validate([
            'nama'=>'required',
            'deskripsi'=>'required',
            'file'=>'mimes:xlsx,xls,csv,xlsm,docx,doc,pptx,ppt,pdf|max:2048'
        ],[
            'nama'=> 'Nama Dokumen Harus Diisi.',
            'deskripsi'=> 'Deskripsi Harus Diisi.',
            'file.required'=> 'File Harus Dipilih.',
            'file.max'=> 'Ukuran file terlalu besar. Disarankan maksimal 2 MB.',
            'file.mimes'=>'Format Dokumen tidak sesuai. Disarankan : doc, docx, xls, xlsx, ppt, pptx, txt, pdf, csv'
        ]);

        $data=$request->only(['nama','deskripsi']);
 
       if($request->file){
        $name=Str::slug($request->nama).'-'.time().'.'.$request->file->extension();
        $path = $request->file('file')->storeAs('dokumen',$name);
        $data['file']=str_replace('public/','',$path);  
        Storage::disk('public')->delete($dokumen->file);
       } 

        $dokumen->update($data);

        session()->flash('success','Dokumen Berhasil Diubah.');

        return redirect()->route('dokumen.index');
    }

     
    public function destroy(string $id)
    {
        $dokumen=DokumenModel::find($id);
        if(!$dokumen) return redirect(route('dokumen.index'));

        Storage::disk('public')->delete($dokumen->file);
        $dokumen->delete();
        session()->flash('success','Dokumen Berhasil Dihapus.');

        return redirect()->route('dokumen.index');
    }
}
