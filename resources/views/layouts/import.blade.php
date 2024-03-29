@extends('master')

@push('css')
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.css"/> --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css"/>
@endpush

@section('content')

<div class="col-lg-12 mb-4 order-0">
  <div class="nav justify-content-end">
    {{ Breadcrumbs::render('import') }}
  </div>
  <div class="card">
    <div class="d-flex align-items-end row">
      <div class="col-sm-7">
        <div class="card-body">
          <h5 class="mb-4">Silahkan import data rekap mahasiswa baru dibawah ini, dan format file nya <span class="fw-bold text-success">.xlsx</span> atau <span class="fw-bold text-success">.xls</span> ya.</h5>
          <a href="{{ asset('assets/template/template-rekapPMB.xlsx') }}">Download template disini.</a>
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
    <div class="col-lg-2 col-md-4 col-6 mb-3">
      <select id="PeriodeSelectFrom" name="period_from" class="form-select filter">
        <option value="">Periode From</option>
        @foreach ($data as $value)        
          <option value="{{ $value->periode }}">{{ $value->periode }}</option>
        @endforeach
      </select>          
    </div>
    <div class="col-lg-2 col-md-4 col-6 mb-3">       
      <select id="PeriodeSelectTo" name="period_to" class="form-select filter">
        <option value="">Periode To</option>
        @foreach ($data as $value)        
          <option value="{{ $value->periode }}">{{ $value->periode }}</option>
        @endforeach
      </select>          
    </div>
    <div class="col-lg-2 col-md-4 col-6 mb-3">
      <button class="btn btn-md btn-primary buttonFilter" id="show-table">Submit</button>
    </div>
    <div class="col-lg-2 col-md-4 col-6 mb-3">
      <select id="deletePeriode" name="delete_periode" class="form-select filterDelete">
        <option value="">Delete Periode</option>
        @foreach ($data as $value)
          <option value="{{ $value->periode }}">{{ $value->periode }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-lg-2 col-md-4 col-6 mb-3">
      <button class="btn btn-md btn-danger" id="btnDeletePeriode" type="submit">Delete</button>
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
      @if (session('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
          {{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
          Import Excel
        </button>
        <a href="{{ route('create') }}" class="btn btn-outline-success"><i class="bx bx-plus-medical"></i> data manualy</a>
      </div>
      
      <table class="table table-striped" id="myTable">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Pilihan Prodi 1</th>
            <th>Pilihan Prodi 2</th>
            <th>Pilihan Prodi 3</th>
            <th>Pilihan Prodi 4</th>
            <th>Pilihan Prodi 5</th>
            <th>Gelombang</th>>
            <th>Transfer</th>
            <th>Status Kelulusan</th>
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
      <form method="POST" action="/menu/import" enctype="multipart/form-data">
      @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="formFile" class="form-label">Input file <span style="color: red; font-size: 10px; font-style: italic; text-transform: lowercase;">file must be .xslx .xls and max 15mb</span></label>
            <input type="file" name="file" class="form-control" id="formFile">
          </div>
          <div class="mb-3">
            <label for="periode" class="form-label">Input Periode</label>
            {{-- <input type="text" name="periode" class="form-control" id="periode"> --}}
            <select id="periode" name="periode" class="form-select filter">
              <option value="">Pilih Periode</option>
              @foreach ($periode as $item)        
                <option value="{{ $item->periode }}">{{ $item->periode }}</option>
              @endforeach
            </select>
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
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

<script>
  let periodFrom = $('#PeriodeSelectFrom').val();
  let periodTo = $('#PeriodeSelectTo').val();
  let deletePeriode = $('#deletePeriode').val();

  let table = $('#myTable').DataTable({
    processing: true,
    dom:"lBfrtip",
    order: [[0, 'asc']],
    buttons: [
      'copy','excel'
    ],
    aLengthMenu: [
      [25, 50, 100, 200, -1],
      [25, 50, 100, 200, "All"]
    ],
    // autoWidth: false,        
    serverSide: true,
    ajax: {
      url: '/menu/import-mahasiswa',
      type: 'POST',
      data: function(d){
        d.periodFrom = periodFrom;
        d.periodTo = periodTo;          
        d.deletePeriode = deletePeriode;          
        return d;
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    },
    columns: [
      { data: 'DT_RowIndex' },    
      { data: 'nama_lengkap', name: 'nama_lengkap' },
      { data: 'prodi1', name: 'prodi1' },
      { data: 'prodi2', name: 'prodi2' },
      { data: 'prodi3', name: 'prodi3' },
      { data: 'prodi4', name: 'prodi4' },
      { data: 'prodi5', name: 'prodi5' },
      { data: 'gelombang', name: 'gelombang' },
      { data: 'transfer', name: 'transfer' },
      { data: 'status_kelulusan', name: 'status_kelulusan' },
      { data: 'periode', name: 'periode' },
    ]
  });
  $('.buttonFilter').on('click', function(){
    periodFrom = $('#PeriodeSelectFrom').val();
    periodTo = $('#PeriodeSelectTo').val();
    table.ajax.reload(null,false);
  });
  $("#btnDeletePeriode").on('click', function(){
    deletePeriode = $('#deletePeriode').val();
    table.ajax.reload(null,false); 
  });
</script>
<script src="{{ asset('assets/js/ui-modals.js') }}"></script>
@endpush