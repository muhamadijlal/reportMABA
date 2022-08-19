@extends('master')

@section('content')

<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tambah Report</h5>
        {{-- <small class="text-muted float-end">Default label</small> --}}
      </div>
      <div class="card-body">
        <form>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Periode</label>
            <input type="text" class="form-control" id="basic-default-fullname" placeholder="Input Periode">
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-company">Program Studi</label>
            <input type="text" class="form-control" id="basic-default-company" placeholder="Input Pogram Studi">
          </div>          
          <div class="row">
            <div class="col-lg-6 col-md-4">
              <div class="mb-3">
                <label class="form-label" for="basic-default-company">Siswa Reguler</label>
                <input type="text" class="form-control" id="basic-default-company" placeholder="Input Jumlah">
              </div>          
            </div>
            <div class="col-lg-6 col-md-4">
              <div class="mb-3">
                <label class="form-label" for="basic-default-company">Siswa Transfer</label>
                <input type="text" class="form-control" id="basic-default-company" placeholder="Input Jumlah">
              </div>          
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-company">Total Mahasiswa</label>
            <input type="text" class="form-control" id="basic-default-company" placeholder="Total Mahasiswa">
          </div>          
          <div class="mb-3">
            <label class="form-label" for="basic-default-company">lampiran</label>
            <input type="file" class="form-control" id="basic-default-company" placeholder="Input bukti berupa file .pdf">
          </div>          
          <button type="submit" class="btn btn-primary">Send</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection