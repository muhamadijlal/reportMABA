@extends('master')

@section('content')
<div class="nav justify-content-end">
  {{ Breadcrumbs::render('detail-report', $data->id) }}
</div>
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
            <td>{{ $data->Ms_maba->where('prodi1','PI')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','IF')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','TI')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','TM')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','SI')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','FM')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','MN')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','AK')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','PSI')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','HK')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','PGSD')->count() }}</td>            
            <td>{{ $data->Ms_maba->where('prodi1','PPKN')->count() }}</td>            
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection