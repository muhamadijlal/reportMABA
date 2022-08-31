<?php

namespace App\Http\Controllers;

use App\Models\ReportMahasiswaBaru;
use Illuminate\Http\Request;

class ApieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = ReportMahasiswaBaru::get();

        return response()->json([
            'message' => "Ente kadang kadang",
            'data'    => $collections,
            'status'  => 200,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $model = new ReportMahasiswaBaru;

        $model->periode                   = $request->periode;
        $model->daya_tampung              = $request->daya_tampung;
        $model->jumlah_maba_reguler       = $request->jumlah_maba_reguler;
        $model->jumlah_maba_transfer      = $request->jumlah_maba_transfer;
        $model->jumlah_mahasiswa_reguler  = $request->jumlah_mahasiswa_reguler;
        $model->jumlah_mahasiswa_transfer = $request->jumlah_mahasiswa_transfer;
        $model->laporan_pmb               = $request->laporan_pmb;
        $model->save();
        
        return response()->json([
            'message' => "Ente kadang kadang",
            'status'  => 200,
        ], 200);
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
        $model = ReportMahasiswaBaru::find($id);

        if($model) {
            return response()->json([
                'message' => 'Ente kadang kadang',
                'data'    => $model,
                'status'  => 200,
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => 'Duarrrr',
                'status'  => 404,
            ], 404);
        }
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
        $model = ReportMahasiswaBaru::find($id);

        if($model){

            $model->periode                   = $request->periode;
            $model->daya_tampung              = $request->daya_tampung;
            $model->jumlah_maba_reguler       = $request->jumlah_maba_reguler;
            $model->jumlah_maba_transfer      = $request->jumlah_maba_transfer;
            $model->jumlah_mahasiswa_reguler  = $request->jumlah_mahasiswa_reguler;
            $model->jumlah_mahasiswa_transfer = $request->jumlah_mahasiswa_transfer;
            $model->laporan_pmb               = $request->laporan_pmb;
            $model->save();

            return response()->json([
                'message' => 'Ente kadang kadang',
                'status'  => 200,
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => 'Duarrrrr',
                'status'  => 404,
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ReportMahasiswaBaru::find($id);

        if($model){

            $model->delete(0);

            return response()->json([
                'message'  => 'wassiuwassi',
                'status'   => 200,
            ], 200);
        }
        else
        {
            return response()->json([
                'message'  => 'uwawauwuauwuauw',
                'status'   => 404,
            ], 404);
        }
    }
}
