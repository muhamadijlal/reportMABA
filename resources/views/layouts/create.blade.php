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
          <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="basic-default-fullname" placeholder="Input Nama Lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" autocomplete="off">
          @error('nama_lengkap')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" for="basic-default-fullname">Program Studi Pilihan 1 <span class="text-danger">*</span></label>
          <select id="prodi1" name="prodi1" class="form-select filter @error('prodi1') is-invalid @enderror">
            <option value="">-- Pilih --</option>
            @foreach ($ms_prodi as $prodi)
              <option {{old('prodi1') == $prodi->kode_prodi ? 'selected' : ''}} value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
            @endforeach
          </select>
          @error('prodi1')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" for="basic-default-fullname">Program Studi Pilihan 2 <span class="text-danger">*</span></label>
          <select id="prodi2" name="prodi2" class="form-select filter @error('prodi2') is-invalid @enderror">
            <option value="">-- Pilih --</option>
            @foreach ($ms_prodi as $prodi)
              <option {{old('prodi2') == $prodi->kode_prodi ? 'selected' : ''}} value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
            @endforeach
          </select>
          @error('prodi2')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" for="basic-default-fullname">Program Studi Pilihan 3 <span class="text-danger">*</span></label>
          <select id="prodi3" name="prodi3" class="form-select filter @error('prodi3') is-invalid @enderror">
            <option value="">-- Pilih --</option>
            @foreach ($ms_prodi as $prodi)
              <option {{old('prodi3') == $prodi->kode_prodi ? 'selected' : ''}} value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
            @endforeach
          </select>
          @error('prodi3')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" for="basic-default-fullname">Program Studi Pilihan 4 <span class="text-danger">*</span></label>
          <select id="prodi4" name="prodi4" class="form-select filter @error('prodi4') is-invalid @enderror">
            <option value="">-- Pilih --</option>
            @foreach ($ms_prodi as $prodi)
              <option {{old('prodi4') == $prodi->kode_prodi ? 'selected' : ''}} value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
            @endforeach
          </select>
          @error('prodi4')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" for="basic-default-fullname">Program Studi Pilihan 5 <span class="text-danger">*</span></label>
          <select id="prodi5" name="prodi5" class="form-select filter @error('prodi5') is-invalid @enderror">
            <option value="">-- Pilih --</option>
            @foreach ($ms_prodi as $prodi)
              <option {{old('prodi5') == $prodi->kode_prodi ? 'selected' : ''}}  value="{{ $prodi->kode_prodi }}">{{ $prodi->nama_prodi }}</option>
            @endforeach
          </select>
          @error('prodi5')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" for="basic-default-fullname">Gelombang<span class="text-danger">*</span></label>
          <select id="gelombang" name="gelombang" class="form-select filter @error('gelombang') is-invalid @enderror">
            <option value="">-- Pilih --</option>
              <option {{old('gelombang') == 1 ? 'selected' : ''}} value="1">Gelombang 1</option>
              <option {{old('gelombang') == 2 ? 'selected' : ''}} value="2">Gelombang 2</option>
              <option {{old('gelombang') == 3 ? 'selected' : ''}} value="3">Gelombang 3</option>
              <option {{old('gelombang') == 4 ? 'selected' : ''}} value="4">Gelombang 4</option>
              <option {{old('gelombang') == 5 ? 'selected' : ''}} value="5">Gelombang 5</option>
              <option {{old('gelombang') == 6 ? 'selected' : ''}} value="6">Gelombang 6</option>
              <option {{old('gelombang') == 7 ? 'selected' : ''}} value="7">Gelombang 7</option>
              <option {{old('gelombang') == 8 ? 'selected' : ''}} value="8">Gelombang 8</option>
          </select>
          @error('gelombang')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label class="form-label" for="basic-default-fullname">Periode <span class="text-danger">*</span></label>
          <select {{ $periode->count() == 0 ? 'disabled' : '' }}  id="periode" name="periode" class="form-select filter @error('periode') is-invalid @enderror">
            @if($periode->count() > 0)
            <option value="">-- Pilih --</option>
            @endif
            @forelse ($periode as $periode)
              <option {{old('periode') == $periode->periode ? 'selected' : ''}} value="{{ $periode->periode }}">{{ $periode->periode }}</option>
              @empty
              <option>Tidak terdapat periode</option>
              @endforelse
            </select>
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