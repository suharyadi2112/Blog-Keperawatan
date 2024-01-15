<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
        return view('admin.document.index');
    }

  
    public function create()
    {
        return view('admin.document.form_create');
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        return view('admin.document.form_edit');
    }

     
    public function update(Request $request, string $id)
    {
        //
    }

     
    public function destroy(string $id)
    {
        //
    }
}
