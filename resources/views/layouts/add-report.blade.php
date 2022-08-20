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
        <form action="/add-report/store" method="POST" enctype="multipart/form-data">
          @csrf          
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Periode</label>
            <input type="text" class="form-control @error('periode') is-invalid @enderror" id="basic-default-fullname" placeholder="Input Periode" name="periode">
            @error('periode')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-fullname">Daya Tampung</label>
            <input type="text" class="form-control @error('daya_tampung') is-invalid @enderror" id="basic-default-fullname" placeholder="Input Periode" name="daya_tampung">
            @error('daya_tampung')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-company">Program Studi</label>
            <input type="text" class="form-control @error('program_studi') is-invalid @enderror" id="basic-default-company" placeholder="Input Pogram Studi" name="program_studi">
            @error('program_studi')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>          
          <div class="row">
            <div class="col-lg-6 col-md-4">
              <div class="mb-3">
                <label class="form-label" for="basic-default-company">Siswa Reguler</label>
                <input type="text" class="form-control @error('reguler') is-invalid @enderror" id="basic-default-company" placeholder="Input Jumlah" name="reguler">
                @error('reguler')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>          
            </div>
            <div class="col-lg-6 col-md-4">
              <div class="mb-3">
                <label class="form-label" for="basic-default-company">Siswa Transfer</label>
                <input type="text" class="form-control @error('transfer') is-invalid @enderror" id="basic-default-company" placeholder="Input Jumlah" name="transfer">
                @error('transfer')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>          
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="basic-default-company">Total Mahasiswa</label>
            <input type="text" class="form-control @error('total') is-invalid @enderror" id="basic-default-company" placeholder="Total Mahasiswa" name="total">
            @error('total')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>          
          <div class="mb-3">
            <label class="form-label" for="basic-default-company">lampiran</label>
            <input type="file" class="form-control @error('file') is-invalid @enderror" id="basic-default-company" placeholder="Input bukti berupa file .pdf" name="file">
            @error('file')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>          
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection