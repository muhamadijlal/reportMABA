<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaBaru;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\ReportMahasiswaBaru;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      return view('layouts.report');
    }

    public function report_json(){

    $collections = ReportMahasiswaBaru::get();    

      return datatables()
        ->of($collections)
        ->addColumn('periode', function($row){
          return '<a href="/dashboard/report/detail/'.$row->id.'">'.$row->periode.'</a>';
        })
        ->addColumn('aksi', function($row){
          return '<div>
          <a href="/menu/report/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
          <button class="btn btn-icon btn-sm btn-danger" onclick="confirmDelete('.$row->id.')" ><span class="tf-icons bx bx-trash"></span></button>        
          </div>';
        })
        ->addColumn('laporan_pmb',function($row){
          return '<a target="_blank" href="' . asset('/storage/file_upload') . '/' . $row->laporan_pmb . '">Lihat bukti</a>';
        })
        ->addColumn('pendaftar', function($row){          
          $query = DB::table('ms_maba')
          ->select('periode', 
          DB::raw('count(if(prodi1 is not null, 1, NUll)) + 
                   count(if(prodi2 is not null, 1, NUll)) + 
                   count(if(prodi3 is not null, 1, NUll)) + 
                   count(if(prodi4 is not null, 1, NUll)) + 
                   count(if(prodi5 is not null, 1, NUll)) as total_prodi'))
          ->where('periode', $row->periode)
          ->groupBy('periode')
          ->get();          

          return $query[0]->total_prodi;
        })
        ->addColumn('status_kelulusan', function($row){
          return $row->Ms_maba->where('status_kelulusan','1')->count();
        })
        ->rawColumns([
            'aksi',
            'periode',
            'daya_tampung',
            'jumlah_maba_reguler',
            'jumlah_maba_transfer',
            'jumlah_mahasiswa_reguler',
            'jumlah_mahasiswa_transfer',
            'laporan_pmb',
          ])
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.add-report');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $validationPeriod = ReportMahasiswaBaru::select('periode')->get();

      foreach($validationPeriod as $periode)
      {
        if($periode->periode === $request->periode)
        {
          return redirect('/dashboard')->with('error',"Periode can't duplicate entry");
        }
      }

      $request->validate([
        'periode'                   => 'required|min:4|max:4',
        'daya_tampung'              => 'required',
        'jumlah_maba_reguler'       => 'required',
        'jumlah_maba_transfer'      => 'required',
        'jumlah_mahasiswa_reguler'  => 'required',
        'jumlah_mahasiswa_transfer' => 'required',
        'laporan_pmb'               => 'required|mimes:pdf|file|max:15000'
      ]);

      $file = $request->file('laporan_pmb');     
      $filename = date('YmdHis').str_replace(" ", "_", $file->getClientOriginalName());         
      Storage::putFileAs('file_upload', $file, $filename);

      $collections = new ReportMahasiswaBaru;

      $collections->periode                     = $request->periode;
      $collections->daya_tampung                = $request->daya_tampung;
      $collections->jumlah_maba_reguler         = $request->jumlah_maba_reguler;
      $collections->jumlah_maba_transfer        = $request->jumlah_maba_transfer;
      $collections->jumlah_mahasiswa_reguler    = $request->jumlah_mahasiswa_reguler;
      $collections->jumlah_mahasiswa_transfer   = $request->jumlah_mahasiswa_transfer;
      $collections->laporan_pmb                 = $filename;

      $collections->save();

      return redirect('/dashboard')->with('success','Add report success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // return redirect()->back();
      
      try {

        $data = ReportMahasiswaBaru::where('id', $id)->firstOrFail();
        $periode = $data->periode;

      } catch (\Exception $e) {
        
        return view('errors.404');
      }      

      $query = DB::table('ms_maba')
      ->select('periode','prodi1 as prodi', DB::raw('count(prodi1)+count(prodi2)+count(prodi3)+count(prodi4)+count(prodi5) as total_prodi'))
      ->where('periode', $periode)
      ->groupBy('periode','prodi1')
      ->get();

      return view('layouts.report-detail', compact('query','data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       try {
        $collection = ReportMahasiswaBaru::where('id', $id)->firstOrFail();
       } catch (\Exception $e) {
        return view('errors.404');
       }

       return view('layouts.edit-report', compact('collection'));
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
      $request->validate([
        'periode'                   => 'required|min:4|max:4',
        'daya_tampung'              => 'required',
        'jumlah_maba_reguler'       => 'required',
        'jumlah_maba_transfer'      => 'required',
        'jumlah_mahasiswa_reguler'  => 'required',
        'jumlah_mahasiswa_transfer' => 'required',
        'file'                      => 'mimes:pdf|file|max:15000'
      ]);

        $collection = ReportMahasiswaBaru::find($id);

      if($request->file('file'))
      {
        $file = $request->file('file');
        $filename = date('YmdHis').str_replace(" ", "_", $file->getClientOriginalName());
        // storing file
        Storage::putFileAs('/file_upload', $file, $filename);        
        // deleting file before
        Storage::delete('file_upload'.'/'.$collection->laporan_pmb);

        $collection->periode                     = $request->periode;
        $collection->daya_tampung                = $request->daya_tampung;
        $collection->jumlah_maba_reguler         = $request->jumlah_maba_reguler;
        $collection->jumlah_maba_transfer        = $request->jumlah_maba_transfer;
        $collection->jumlah_mahasiswa_reguler    = $request->jumlah_mahasiswa_reguler;
        $collection->jumlah_mahasiswa_transfer   = $request->jumlah_mahasiswa_transfer;
        $collection->laporan_pmb                 = $filename;

        $collection->save();
      }
      else
      {
        $collection->periode                     = $request->periode;
        $collection->daya_tampung                = $request->daya_tampung;
        $collection->jumlah_maba_reguler         = $request->jumlah_maba_reguler;
        $collection->jumlah_maba_transfer        = $request->jumlah_maba_transfer;
        $collection->jumlah_mahasiswa_reguler    = $request->jumlah_mahasiswa_reguler;
        $collection->jumlah_mahasiswa_transfer   = $request->jumlah_mahasiswa_transfer;

        $collection->save();
      }

      return redirect('/dashboard')->with('success','Data success update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {

        $collection = ReportMahasiswaBaru::findOrFail($id);
        $periode = $collection->periode;
        $data = MahasiswaBaru::where('periode', $periode)->first();
  
        if(!$data){
          $collection->delete();
          return redirect('/dashboard')->with('success','data deleted successfully!');      
        }
        
      } catch (\Exception $e) {
        return redirect('/dashboard')->with('error', $e->getMessage());  
      }

      return redirect('/dashboard')->with('error','Data on import periode '. $data->periode .' must be deleted first!');
    }
}
