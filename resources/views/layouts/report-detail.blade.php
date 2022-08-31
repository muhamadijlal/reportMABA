@extends('master')

@section('content')
{{-- {{ Breadcrumbs::render('edit-report', $collection->id) }} --}}
<div class="col-lg-12">
  <div class="nav justify-content-end">
  </div>
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Detail Data Periode {{ $data->periode }}</h5>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Periode</th>
            <th>PI</th>            
            <th>IF</th>            
            <th>TI</th>            
            <th>TM</th>            
            <th>SI</th>            
            <th>FM</th>            
            <th>MN</th>            
            <th>AK</th>            
            <th>PSI</th>            
            <th>HK</th>            
            <th>PGSD</th>            
            <th>PPKN</th>            
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>{{ $data->periode }}</td>
            <td>{{ $data->Ms_maba->where('prodi1','Pendidikan Agama Islam')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','Teknik Informatika')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','Teknik Industri')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','Teknik Mesin')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','Sistem Informasi')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','Farmasi')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','Manajemen')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','Akuntansi')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','Psikologi')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','Ilmu Hukum')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','Pendidikan Guru Sekolah Dasar')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','Pend. Pancasila & Kewarganegaraan')->count() }}</td>            
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection