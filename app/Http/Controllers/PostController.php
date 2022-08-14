<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaBaruExport;
use App\Imports\MahasiswaBaruImport;
use App\Models\MahasiswaBaru;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $data = MahasiswaBaru::select('periode')->distinct()->get();

       return view('layouts.dashboard',compact('data'));
    }

    public function json()
    {      
      $data = MahasiswaBaru::orderBy('id','desc')->get();

      return datatables()
          ->of($data)
          ->addIndexColumn()
          ->make(true);
    }

    // public function MahasiswaBaruExport()  
    // {
    //     return Excel::download(new MahasiswaBaruExport, 'mahasiswabaru.xlsx');       
    // }

    public function MahasiswaBaruImport(Request $request)
    {

      $request->validate([
          // validation file must excel file, required and maks size 15 mb
          'file' => 'required|mimes:xls,xlsx|max:15000'
      ]);

      $file = $request->file('file');
      $filename = date('YmdHis').str_replace(" ", "_", $file->getClientOriginalName());
      $request->file->move('file_upload',$filename);

      $import = new MahasiswaBaruImport;
      $import->import(public_path('/file_upload/'.$filename));        
      
      if($import->failures()->isNotEmpty()) {
          return back()->withFailures($import->failures());
      }

      return redirect('/dashboard')->withStatus('Excel file imported successfully');        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
