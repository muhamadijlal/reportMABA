@extends('master')

@push('css')
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.css"/> --}}

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css"/>
@endpush

@section('content')
<div class="col-lg-12 mb-4 order-0">
  <div class="card">
    <div class="d-flex align-items-end row">
      <div class="col-sm-7">
        <div class="card-body">
          <h5 class="card-title text-primary">Welcome! 🎉</h5>
          <p class="mb-4">You have done <span class="fw-bold">72%</span> more sales today. Check your new badge in your profile.</p>      
        </div>
      </div>
      <div class="col-sm-5 text-center text-sm-left">
        <div class="card-body pb-0 px-0 px-md-4">
          <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container my-4">
  <div class="row">
    <div class="col-lg-4 col-md-4 col-6 mb-3">
      <select id="PeriodeSelectFrom" name="period_from" class="form-select filter">
        <option>Periode From</option>
        @foreach ($data as $value)        
          <option value="{{ $value->periode }}">{{ $value->periode }}</option>
        @endforeach
      </select>          
    </div>
    <div class="col-lg-4 col-md-4 col-6 mb-3">       
      <select id="PeriodeSelectTo" name="period_to" class="form-select filter">
        <option>Periode To</option>
        @foreach ($data as $value)        
          <option value="{{ $value->periode }}">{{ $value->periode }}</option>
        @endforeach
      </select>          
    </div>
    <div class="col-lg-4 col-md-4 col-6 mb-3">
      <button class="btn btn-md btn-primary" id="show-table">Submit</button>
    </div>
  </div>
</div>

<div class="col-lg-12 mb-4 order-0">  
  <div class="card">
    <h5 class="card-header">Table Mahasiswa</h5>
    <div class="table-responsive text-nowrap px-4 pb-4">
      @if (session('status'))
        <div class="alert alert-success alert-dismissible" role="alert">
          {{ session('status') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if (isset($errors) && $errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
          @foreach ($errors->all() as $error)
            {{ $error }}
          @endforeach
        </div>
      @endif      
      @if (session()->has('failures'))
        <div class="alert alert-warning alert-dismissible" role="alert">
          There are <span class="text-bold">{{ session()->get('failures')->count() }}</span> duplicate data. Excel succed Import<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <div class="my-4">
        {{-- <a href="/export" class="btn btn-md btn-success">Export Excel</a> --}}
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
          Import Excel
        </button>
      </div>
      
      <table class="table table-striped" id="myTable">
        <thead>
          <tr>
            <th>No</th>
            <th>virtual Account</th>
            <th>Email</th>
            <th>Nomor Handphone</th>
            <th>Nomor Handphone Ayah</th>
            <th>Nomor Handphone Ibu</th>
            <th>Nama</th>
            <th>Sekolah</th>
            <th>Gelombang</th>
            <th>Tahun Lulus</th>
            <th>Pilihan Prodi</th>
            <th>Register</th>
            <th>Ujian</th>
            <th>Upload</th>
            <th>Ukuran Baju</th>
            <th>Periode</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0"></tbody>
      </table>
    </div>
  </div>
</div>
{{-- Datatable end --}}

{{-- Modal --}}
<div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="/import" enctype="multipart/form-data">
      @csrf
        <div class="modal-body">
          <div class="row">
              <div class="input-group">
                <input type="file" name="file" class="form-control">
              </div>
            </div>        
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Import</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('script')
{{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.js"></script> --}}

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
  $(document).ready( function () {
    let table = $('#myTable').DataTable({
      processing: true,
      dom:"lBfrtip",
      buttons: [
        'copy','excel'
      ],      
      // autoWidth: false,        
      serverSide: true,
      ajax: {
        url: '/json',
        type: 'POST',        
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      },
      columns: [
        { data: 'DT_RowIndex' },
        { data: 'virtual_account', name: 'virtual_account' },
        { data: 'email', name: 'email' },
        { data: 'no_hp', name: 'no_hp' },
        { data: 'no_hp_ayah', name: 'no_hp_ayah' },
        { data: 'no_hp_ibu', name: 'no_hp_ibu' },
        { data: 'nama', name: 'nama' },
        { data: 'sekolah', name: 'sekolah' },
        { data: 'gelombang', name: 'gelombang' },
        { data: 'tahun_lulus', name: 'tahun_lulus' },
        { data: 'pilihan_prodi', name: 'pilihan_prodi' },
        { data: 'register', name: 'register' },
        { data: 'ujian', name: 'ujian' },
        { data: 'upload', name: 'upload' },
        { data: 'ukuran_baju', name: 'ukuran_baju' },
        { data: 'periode', name: 'periode' },
      ]
    });    
  });
</script>
<script src="{{ asset('assets/js/ui-modals.js') }}"></script>
@endpush