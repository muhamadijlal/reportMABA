@extends('master')

@section('content')
<div class="col-lg-12 mb-4 order-0">  
    <div class="card">
      <h5 class="card-header">Tabel Data Mahasiswa Baru {{ $periode }}</h5>
      <div class="table-responsive text-nowrap px-4 pb-4">
        <table class="table table-striped">
          <thead>
            <tr>
              <th rowspan="2">Nama Prodi</th>
              @foreach ($data->unique('gelombang') as $item)
                <th colspan="3" class="text-center">Gelombang {{ $item->gelombang }}</th>
              @endforeach
              <th colspan="3" class="text-center">Total</th>
            </tr>
            <tr>
              @foreach($data->unique('gelombang') as $item)
                <th>D</th>
                <th>U</th>
                <th>R</th>
              @endforeach
              <th>D</th>
              <th>U</th>
              <th>R</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($data->unique('kode_prodi') as $collection)
            <tr>
              <td>{{ $collection->prodi }}</td>
              @foreach ($data as $item)
                @if($item->kode_prodi == $collection->kode_prodi)
                  <td>({{ $item->D }}</td>
                  <td>{{ $item->U }}</td>
                  <td>{{ $item->R }})</td>
                @endif
              @endforeach
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td>Total</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
              <td>0</td>
            </tr>
          </tfoot>
        </table>
        <small>D = Calon Mahasiswa yang telah mendaftar</small><br>
        <small>U = Calon Mahasiswa yang telah melakukan ujian PMB</small><br>
        <small>R = Mahasiswa Baru yang telah melakukan registrasi dan telah mendapatkan NIM</small>
      </div>
    </div>
  </div>
@endsection