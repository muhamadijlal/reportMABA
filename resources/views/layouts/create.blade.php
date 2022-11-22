@extends('master')

@section('content')

<div class="col-xl">
  <div class="nav justify-content-end">
    {{-- {{ Breadcrumbs::render('add-report') }} --}}
  </div>
  <div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Add data manualy</h5>
    </div>
    <div class="card-body">
      <p>(<span class="text-danger">*</span>) Wajib diisi</p>
      <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf          
        <div class="mb-3">
          <label class="form-label" for="basic-default-fullname">Nama Lengkap <span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="basic-default-fullname" placeholder="Input Nama Lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}">
          @error('nama_lengkap')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" for="basic-default-fullname">Program Studi Pilihan 1 <span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('prodi1') is-invalid @enderror" id="basic-default-fullname" placeholder="Input Program Studi Pilihan 1" name="prodi1" value="{{ old('prodi1') }}">
          @error('prodi1')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" for="basic-default-fullname">Program Studi Pilihan 2 <span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('prodi2') is-invalid @enderror" id="basic-default-fullname" placeholder="Input Program Studi Pilihan 2" name="prodi2" value="{{ old('prodi2') }}">
          @error('prodi2')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" for="basic-default-fullname">Program Studi Pilihan 3 <span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('prodi3') is-invalid @enderror" id="basic-default-fullname" placeholder="Input Program Studi Pilihan 3" name="prodi3" value="{{ old('prodi3') }}">
          @error('prodi3')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" for="basic-default-fullname">Program Studi Pilihan 4</label>
          <input type="text" class="form-control @error('prodi4') is-invalid @enderror" id="basic-default-fullname" placeholder="Input Program Studi Pilihan 4" name="prodi4" value="{{ old('prodi4') }}">
          @error('prodi4')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" for="basic-default-fullname">Program Studi Pilihan 5</label>
          <input type="text" class="form-control @error('prodi5') is-invalid @enderror" id="basic-default-fullname" placeholder="Input Program Studi Pilihan 5" name="prodi5" value="{{ old('prodi5') }}">
          @error('prodi5')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" for="basic-default-fullname">Periode <span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('periode') is-invalid @enderror" id="basic-default-fullname" placeholder="Input Periode" name="periode" value="{{ old('periode') }}">
          @error('periode')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>
</div>

@endsection