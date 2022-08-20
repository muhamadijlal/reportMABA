<?php

namespace App\Http\Controllers;

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
        $request->validate([
            'periode'       => 'required|min:4|max:4',
            'daya_tampung'  => 'required',
            'program_studi' => 'required',
            'reguler'       => 'required',
            'transfer'      => 'required',
            'total'         => 'required',
            'file'          => 'required|mimes:pdf|file|max:15000'
        ]);

        $file = $request->file('file');
        $filename = date('YmdHis').str_replace(" ", "_", $file->getClientOriginalName());
        $request->file->move('file_lampiran',$filename);

        $collections = new ReportMahasiswaBaru;

        $collections->periode         = $request->periode;
        $collections->daya_tampung    = $request->daya_tampung;
        $collections->program_studi   = $request->program_studi;
        $collections->siswa_reguler   = $request->reguler;
        $collections->siswa_transfer  = $request->transfer;
        $collections->total_mahasiswa = $request->total;
        $collections->lampiran        = $filename;

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
