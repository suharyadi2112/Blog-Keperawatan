<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

class DokumentasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Dokumentasi::select('id','nama_dokumentasi', 'foto_dokumentasi','created_at')
                ->latest();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn ='<button type="button" class="mr-2 btn btn-sm round btn-outline-primary shadow" title="Edit" id="modalEdit" data-id="'.$row->id.'">
                    <i class="fa fa-lg fa-fw fa-edit"></i>
                    </button>';
                    $actionBtn .='<button type="button" class="btn btn-sm round btn-outline-danger shadow" title="Delete" id="modalDelete"
                    data-id="'.$row->id.'">
                    <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>';

                    return $actionBtn;
                })
                ->editColumn('foto_dokumentasi', function ($row) {
                    return '<img src="' . asset('storage/dokumentasi/' . $row->foto_dokumentasi) . '" alt="Foto Dokumentasi" width="50px" height="50px" style="object-fit: cover; object-position: center; border-radius: 10%;" id="modalImage" data-id="'.$row->id.'">';
                })
                ->editColumn('created_at', function ($row) {
                    Carbon::setLocale('id');
                    return Carbon::parse($row->created_at)->translatedFormat('l, d F Y - H:i:s');
                })
                ->rawColumns(['action', 'foto_dokumentasi'])
                ->make(true);
        }
        return view('admin.dokumentasi.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumentasi' => 'required|min:5|max:50',
            'foto_dokumentasi' => $request->id ? 'image|mimes:jpeg,png,jpg|max:1024' : 'required|image|mimes:jpeg,png,jpg|max:1024',
        ],[
            'nama_dokumentasi.required' => 'Nama dokumentasi tidak boleh kosong',
            'nama_dokumentasi.min' => 'Nama dokumentasi minimal 5 karakter',
            'nama_dokumentasi.max' => 'Nama dokumentasi maksimal 50 karakter',
            'foto_dokumentasi.required' => 'Foto dokumentasi tidak boleh kosong',
            'foto_dokumentasi.image' => 'Foto dokumentasi harus berupa gambar',
            'foto_dokumentasi.mimes' => 'Foto dokumentasi harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'foto_dokumentasi.max' => 'Foto dokumentasi maksimal berukuran 1 MB',
        ]);
    

        $nama_dokumentasi = $request->nama_dokumentasi;
        $nama_foto = null;

        if ($request->hasFile('foto_dokumentasi')) {
            if ($request->id) {
                $existingData = Dokumentasi::find($request->id);
                if ($existingData && $existingData->foto_dokumentasi) {
                    Storage::disk('public')->delete('/dokumentasi' . $existingData->foto_dokumentasi);
                }
            }

            $foto_dokumentasi = $request->file('foto_dokumentasi');
            $nama_foto = time() . "_" . $foto_dokumentasi->getClientOriginalName();
            $foto_dokumentasi->storeAs('/dokumentasi', $nama_foto, 'public');
        } elseif ($request->id) {
            $existingData = Dokumentasi::find($request->id);
            if ($existingData) {
                $nama_foto = $existingData->foto_dokumentasi;
            }
        }

        Dokumentasi::updateOrCreate(
            ['id' => $request->id],
            ['nama_dokumentasi' => $nama_dokumentasi, 'foto_dokumentasi' => $nama_foto]
        );

        return response()->json(['success' => 'Dokumentasi berhasil ditambahkan']);
    }

    public function show($id, Request $request)
    {
        $dokumentasi = Dokumentasi::where('id', $id)->first();
        if ($request->ajax()) {
            return response()->json($dokumentasi);
        } else {
            return redirect()->route('dokumentasi');
        }
    }

    public function destroy($id)
    {
        // return response()->json($id);
        $dokumentasi = Dokumentasi::where('id', $id)->first();
        if ($dokumentasi->foto_dokumentasi != null || Storage::disk('public')->exists('dokumentasi/' . $dokumentasi->foto_dokumentasi)) {
            Storage::disk('public')->delete('dokumentasi/' . $dokumentasi->foto_dokumentasi);
        }
        $dokumentasi->delete();
        return response()->json(['success' => 'Dokumentasi berhasil dihapus']);
    }
}
