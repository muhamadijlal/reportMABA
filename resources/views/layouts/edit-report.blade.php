@extends('master')

@section('content')
<div class="col-lg-12">
  <div class="nav justify-content-end">
    {{ Breadcrumbs::render('edit-report', $collection->id) }}
  </div>
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Edit Report</h5>
      {{-- <small class="text-muted float-end">Default label</small> --}}
    </div>
    <div class="card-body">
      <form action="/menu/report/update/{{ $collection->id }}" method="POST" enctype="multipart/form-data">
        @csrf          
        <div class="mb-3">
          <label class="form-label" for="basic-default-fullname">Periode</label>
          <input type="text" class="form-control @error('periode') is-invalid @enderror" id="basic-default-fullname" placeholder="Input Periode" name="periode" value="{{ $collection->periode }}">
          @error('periode')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="mb-3">
          <label class="form-label" for="basic-default-fullname">Daya Tampung</label>
          <input type="text" class="form-control @error('daya_tampung') is-invalid @enderror" id="basic-default-fullname" placeholder="Input Periode" name="daya_tampung" value="{{ $collection->daya_tampung }}">
          @error('daya_tampung')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="row my-3">
          <h4>Jumlah Mahasiswa Baru</h4>
          <div class="col-lg-6 col-mb-4">
            <div class="mb-3">
              <label class="form-label" for="basic-default-company">Reguler</label>
              <input type="text" class="form-control @error('jumlah_maba_reguler') is-invalid @enderror" id="basic-default-company" placeholder="Input Pogram Studi" name="jumlah_maba_reguler" value="{{ $collection->jumlah_maba_reguler }}">
              @error('jumlah_maba_reguler')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="col-lg-6 col-mb-4">
            <div class="mb-3">
              <label class="form-label" for="basic-default-company">Transfer</label>
              <input type="text" class="form-control @error('jumlah_maba_transfer') is-invalid @enderror" id="basic-default-company" placeholder="Input Pogram Studi" name="jumlah_maba_transfer" value="{{ $collection->jumlah_maba_transfer }}">
              @error('jumlah_maba_transfer')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
        <div class="row my-3">
          <h4>Jumlah Mahasiswa (Student Body)</h4>
          <div class="col-lg-6 col-md-4">
            <div class="mb-3">
              <label class="form-label" for="basic-default-company">Reguler</label>
              <input type="text" class="form-control @error('jumlah_mahasiswa_reguler') is-invalid @enderror" id="basic-default-company" placeholder="Input Jumlah" name="jumlah_mahasiswa_reguler" value="{{ $collection->jumlah_mahasiswa_reguler }}">
              @error('jumlah_mahasiswa_reguler')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>          
          </div>
          <div class="col-lg-6 col-md-4">
            <div class="mb-3">
              <label class="form-label" for="basic-default-company">Transfer</label>
              <input type="text" class="form-control @error('jumlah_mahasiswa_transfer') is-invalid @enderror" id="basic-default-company" placeholder="Input Jumlah" name="jumlah_mahasiswa_transfer" value="{{ $collection->jumlah_mahasiswa_transfer }}">
              @error('jumlah_mahasiswa_transfer')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>          
          </div>
        </div>         
        <div class="mb-3">
          <label class="form-label" for="basic-default-company">lampiran</label>
          <input type="file" class="form-control @error('file') is-invalid @enderror" id="basic-default-company" placeholder="Input bukti berupa file .pdf" name="file">            
          @error('file')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="my-3">
          <a target="_blank" href="{{ asset('/storage/file_upload') . '/' . $collection->laporan_pmb }}"><span class="bx bx-file"></span> Lihat file yang tersedia</a>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection