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
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Periode</th>  
              @foreach ($all as $item)
                <th>{{ $item->prodi }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>{{ $data->periode }}</td>          
              @foreach ($all as $item)            
                <td>{{ $item->total_prodi }}</td>
              @endforeach
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Detail Data Periode mahasiswa reguler {{ $data->periode }}</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Periode</th>
              @foreach ($reguler as $item)
                <th>{{ $item->prodi }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>{{ $data->periode }}</td>          
              @foreach ($reguler as $item)            
                <td>{{ $item->total_prodi }}</td>
              @endforeach        
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Detail Data Periode mahasiswa transfer {{ $data->periode }}</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Periode</th>
              @foreach ($transfer as $item)
                <th>{{ $item->prodi }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>{{ $data->periode }}</td>          
              @foreach ($transfer as $item)            
                <td>{{ $item->total_prodi }}</td>
              @endforeach        
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
</div>
@endsection