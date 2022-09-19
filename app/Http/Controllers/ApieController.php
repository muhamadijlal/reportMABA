<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\ReportMahasiswaBaru;
use Illuminate\Support\Facades\DB;
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
        $validationPeriod = ReportMahasiswaBaru::select('periode')->get();

        foreach($validationPeriod as $periode)
        {
            if($periode->periode === $request->periode)
            {
                return response()->json([
                    'message' => "Failed duplicate entry",
                    'status'  => 404,
                ], 404);
            }
        }

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

        $file = $request->file('laporan_pmb');     
        $filename = date('YmdHis').str_replace(" ", "_", $file->getClientOriginalName());         
        Storage::putFileAs('file_upload', $file, $filename);

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
        $data = ReportMahasiswaBaru::where('id', $id)->firstOrFail();
        $periode = $data->periode;        
        $query = DB::table('ms_maba')
            ->select('periode','prodi1 as prodi', DB::raw('count(prodi1)+count(prodi2)+count(prodi3)+count(prodi4)+count(prodi5) as total_prodi'))
            ->where('periode', $periode)
            ->groupBy('periode','prodi1')
            ->get();

        return response()->json([
            'message' => "Success",
            'data' => $query  
        ], 200);
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
            $model = ReportMahasiswaBaru::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status'  => 404,
            ], 404);
        }

        // if($model) {
            return response()->json([
                'message' => 'Success',
                'data'    => $model,
                'status'  => 200,
            ], 200);
        // }
        // else
        // {
        //     return response()->json([
        //         'message' => 'Failed',
        //         'status'  => 404,
        //     ], 404);
        // }
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
        $rules = [
            'periode'                   => 'required|min:4|max:4',
            'daya_tampung'              => 'required',
            'jumlah_maba_reguler'       => 'required',
            'jumlah_maba_transfer'      => 'required',
            'jumlah_mahasiswa_reguler'  => 'required',
            'jumlah_mahasiswa_transfer' => 'required',
            'file'                      => 'required|mimes:pdf|file|max:15000',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                'messages' => 'Validation Errors',
                'data'     => $validator->errors(),
                'status'   => 404,
            ], 404);
        }

        try {
            $model = ReportMahasiswaBaru::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'messages' => $e->getMessage(),                
                'status'   => 404,
            ], 404);
        }
        
        // if($model){
            if($request->file('file'))
            {
                $file = $request->file('file');
                $filename = date('YmdHis').str_replace(" ", "_", $file->getClientOriginalName());
                // storing file
                Storage::putFileAs('/file_upload', $file, $filename);        
                // deleting file before
                Storage::delete('file_upload'.'/'.$model->laporan_pmb);
    
                $model->periode                   = $request->periode;
                $model->daya_tampung              = $request->daya_tampung;
                $model->jumlah_maba_reguler       = $request->jumlah_maba_reguler;
                $model->jumlah_maba_transfer      = $request->jumlah_maba_transfer;
                $model->jumlah_mahasiswa_reguler  = $request->jumlah_mahasiswa_reguler;
                $model->jumlah_mahasiswa_transfer = $request->jumlah_mahasiswa_transfer;
                $model->laporan_pmb               = $filename;
                $model->save();
            }
            else
            {
                $model->periode                   = $request->periode;
                $model->daya_tampung              = $request->daya_tampung;
                $model->jumlah_maba_reguler       = $request->jumlah_maba_reguler;
                $model->jumlah_maba_transfer      = $request->jumlah_maba_transfer;
                $model->jumlah_mahasiswa_reguler  = $request->jumlah_mahasiswa_reguler;
                $model->jumlah_mahasiswa_transfer = $request->jumlah_mahasiswa_transfer;
                $model->save();
            }
            
            return response()->json([
                'message' => 'Success',
                'status'  => 200,
            ], 200);
        // }
        // else
        // {
        //     return response()->json([
        //         'message' => 'Failed',
        //         'status'  => 404,
        //     ], 404);
        // }
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
            $model = ReportMahasiswaBaru::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'message'  => $e->getMessage(),
                'status'   => 404,
            ], 404);
        }

        // if($model){

            $model->delete();

            return response()->json([
                'message'  => 'Success',
                'status'   => 200,
            ], 200);
        // }
        // else
        // {
        //     return response()->json([
        //         'message'  => 'Failed',
        //         'status'   => 404,
        //     ], 404);
        // }
    }
}