<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 
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
        ->addColumn('aksi', function($row){
          return '<div>
          <a href="/report/edit/'. $row->id .'" class="btn btn-icon btn-sm btn-warning"><span class="tf-icons bx bx-edit-alt"></span></a>
          <button class="btn btn-icon btn-sm btn-danger" onclick="confirmDelete('.$row->id.')" ><span class="tf-icons bx bx-trash"></span></button>
          </div>';            
        })
        ->addColumn('lampiran',function($row){
          return '<a target="_blank" href="' . asset('file_lampiran') . '/' . $row->lampiran . '">Lihat bukti</a>';
        })
        ->rawColumns([
            'aksi',
            'periode',
            'daya_tampung',
            'jumlah_maba_reguler',
            'jumlah_maba_transfer',
            'jumlah_mahasiswa_reguler',
            'jumlah_mahasiswa_transfer',
            'lampiran',
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

      $validationPeriod = DB::table('report_maba')
                            ->select('periode')
                            ->get();

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
        'file'                      => 'required|mimes:pdf|file|max:15000'
      ]);        

      $file = $request->file('file');
      $filename = date('YmdHis').str_replace(" ", "_", $file->getClientOriginalName());
      $request->file->move('file_lampiran',$filename);

      $collections = new ReportMahasiswaBaru;

      $collections->periode                     = $request->periode;
      $collections->daya_tampung                = $request->daya_tampung;
      $collections->jumlah_maba_reguler         = $request->jumlah_maba_reguler;
      $collections->jumlah_maba_transfer        = $request->jumlah_maba_transfer;
      $collections->jumlah_mahasiswa_reguler    = $request->jumlah_mahasiswa_reguler;
      $collections->jumlah_mahasiswa_transfer   = $request->jumlah_mahasiswa_transfer;
      $collections->lampiran                    = $filename;

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
       $collection = ReportMahasiswaBaru::where('id', $id)->first();       

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

      if($request->file)
      {
        $file = $request->file('file');
        $filename = date('YmdHis').str_replace(" ", "_", $file->getClientOriginalName());
        $request->file->move('file_lampiran',$filename);
        $file->getClientOriginalName();
        $destinationPath = 'file_lampiran';
        File::delete($destinationPath.'/'.$collection->lampiran);

        $collection->periode                     = $request->periode;
        $collection->daya_tampung                = $request->daya_tampung;
        $collection->jumlah_maba_reguler         = $request->jumlah_maba_reguler;
        $collection->jumlah_maba_transfer        = $request->jumlah_maba_transfer;
        $collection->jumlah_mahasiswa_reguler    = $request->jumlah_mahasiswa_reguler;
        $collection->jumlah_mahasiswa_transfer   = $request->jumlah_mahasiswa_transfer;
        $collection->lampiran                    = $filename;

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
      $collection = ReportMahasiswaBaru::find($id);

      $collection->delete();

      return redirect('/dashboard')->with('success','data deleted successfully!');
    }
}
