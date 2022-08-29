<?php

namespace App\Http\Controllers;

use App\Imports\MahasiswaBaruImport;
use App\Models\MahasiswaBaru;
use App\Models\ReportMahasiswaBaru;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index()
  {
    $data = MahasiswaBaru::select('periode')->distinct()->orderBy('periode','asc')->get();
    $periode = ReportMahasiswaBaru::select('*')->distinct()->orderBy('periode','asc')->get();

    return view('layouts.import', compact('data','periode'));
  }

  public function import_json(Request $request)
  {
    if($request->input('deletePeriode') != null)
    {
      $periode = $request->deletePeriode;
      $data =  MahasiswaBaru::where('periode', $periode)->delete();    
    }
    
    if($request->input('periodFrom') != null)
    {
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
    $request->validate([
      // validation file must excel file, required and maks size 15 mb
      'file' => 'required|mimes:xls,xlsx|max:15000',
      'periode' => 'required'
    ]);    

    $data = MahasiswaBaru::where('periode', $request->periode)->first();
    $isset = ReportMahasiswaBaru::where('periode', $request->periode)->first(); 
    // validation periode if the periode is exists on database
    if($data)
    {
      return redirect()->back()->with('error','Period already exists!');
    }
    // Validation periode report maba is exist or not
    else
    {
      $file = $request->file('file');
      $filename = date('YmdHis').str_replace(" ", "_", $file->getClientOriginalName());
      $request->file->move('file_upload',$filename);

      $import = new MahasiswaBaruImport;
      $import->import(public_path('/file_upload/'.$filename));

      if($import->failures()->isNotEmpty()) {
        return back()->withFailures($import->failures());
      }
      return redirect('/menu/import-mahasiswa')->withStatus('Excel file imported successfully');
    }
    // else
    // {
    //   return redirect()->back()->with("error","Periode doesn't exist! you must input data on menu Tambah Report first!");
    // }
  }

  public function destroy(Request $request)
  {
    $collection = MahasiswaBaru::where('periode', $request->delete_periode)->get();

    foreach($collection as $collect)
    {
      $collect->delete();
    }

    return redirect('/menu/import-mahasiswa')->with('status','Data periode <p class="font-bold">'. $request->delete_periode.'</p> has been deleted permanently!');
  }
}
