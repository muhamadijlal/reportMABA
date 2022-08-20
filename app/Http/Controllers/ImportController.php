<?php

namespace App\Http\Controllers;

// use App\Exports\MahasiswaBaruExport;
// use Maatwebsite\Excel\Facades\Excel;
// use App\Models\Post;
use App\Imports\MahasiswaBaruImport;
use App\Models\MahasiswaBaru;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index()
  {
    $data = MahasiswaBaru::select('periode')->distinct()->get();

      return view('layouts.import',compact('data'));
  }

  public function import_json(Request $request)
  {              
    if($request->input('periodFrom') != null){
      $from = $request->periodFrom;
      $to = $request->periodTo;
      $data = MahasiswaBaru::whereBetween('periode',[$from, $to])
                            ->orderBy('id','desc')
                            ->get();
    }
    else
    {
      $data = MahasiswaBaru::get();
    }

    return datatables()
          ->of($data)
          ->addIndexColumn()
          ->make(true);
  }


  public function MahasiswaBaruImport(Request $request)
  {

    // dd($request->periode);
    $request->validate([
        // validation file must excel file, required and maks size 15 mb
        'file' => 'required|mimes:xls,xlsx|max:15000',
        'periode' => 'required|min:4|max:4'
    ]);    

    $file = $request->file('file');
    $filename = date('YmdHis').str_replace(" ", "_", $file->getClientOriginalName());
    $request->file->move('file_upload',$filename);

    $import = new MahasiswaBaruImport;
    $import->import(public_path('/file_upload/'.$filename));

    if($import->failures()->isNotEmpty()) {
      return back()->withFailures($import->failures());
    }

    return redirect('/import-mahasiswa')->withStatus('Excel file imported successfully');
  }
}
