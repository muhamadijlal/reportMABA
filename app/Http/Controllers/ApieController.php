<?php

namespace App\Http\Controllers;

use App\Models\ReportMahasiswaBaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'message' => "Success",
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

        $rules = [
            'periode'                   => 'required|min:4|max:4',
            'daya_tampung'              => 'required',
            'jumlah_maba_reguler'       => 'required',
            'jumlah_maba_transfer'      => 'required',
            'jumlah_mahasiswa_reguler'  => 'required',
            'jumlah_mahasiswa_transfer' => 'required',
            'laporan_pmb'               => 'required|mimes:pdf|file|max:15000',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                'messages' => 'Validation Errors',
                'data'     => $validator->errors(),
                'status'   => 404,
            ], 404);
        }

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
            'message' => "Success",
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
                'message' => 'Success',
                'data'    => $model,
                'status'  => 200,
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => 'Failed',
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

            $rules = [
                'periode'                   => 'required|min:4|max:4',
                'daya_tampung'              => 'required',
                'jumlah_maba_reguler'       => 'required',
                'jumlah_maba_transfer'      => 'required',
                'jumlah_mahasiswa_reguler'  => 'required',
                'jumlah_mahasiswa_transfer' => 'required',
                // 'laporan_pmb'               => 'required|mimes:pdf|file|max:15000',
            ];
    
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                return response()->json([
                    'messages' => 'Validation Errors',
                    'data'     => $validator->errors(),
                    'status'   => 404,
                ], 404);
            }

            $model->periode                   = $request->periode;
            $model->daya_tampung              = $request->daya_tampung;
            $model->jumlah_maba_reguler       = $request->jumlah_maba_reguler;
            $model->jumlah_maba_transfer      = $request->jumlah_maba_transfer;
            $model->jumlah_mahasiswa_reguler  = $request->jumlah_mahasiswa_reguler;
            $model->jumlah_mahasiswa_transfer = $request->jumlah_mahasiswa_transfer;
            $model->laporan_pmb               = $request->laporan_pmb;
            $model->save();

            return response()->json([
                'message' => 'Success',
                'status'  => 200,
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => 'Failed',
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
                'message'  => 'Success',
                'status'   => 200,
            ], 200);
        }
        else
        {
            return response()->json([
                'message'  => 'Failed',
                'status'   => 404,
            ], 404);
        }
    }
}
