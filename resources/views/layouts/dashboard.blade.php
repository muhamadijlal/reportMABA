@extends('master')

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.css"/>
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

{{-- Datatable start --}}
<div class="col-lg-12 mb-4 order-0">  
  <div class="card">
    <h5 class="card-header">Table Mahasiswa</h5>
    <div class="table-responsive text-nowrap px-4 pb-4">
      <div class="my-4">
        <a href="/export" class="btn btn-md btn-success">Export Excel</a>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter">
          Import Excel
        </button>
      </div>
      <table class="table table-striped" id="myTable">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>nim</th>
            <th>program studi</th>
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
      <form action="">
        <div class="modal-body">
        <div class="row">
          <div class="input-group">
            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">            
          </div>
        </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Close
        </button>
        <button type="button" class="btn btn-primary">Import</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('script')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.js"></script>
<script>
  $(document).ready( function () {
    $('#myTable').DataTable({
        processing: true,
        autoWidth: false,        
        serverSide: true,
        ajax: '/json',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'nim', name: 'nim' },
            { data: 'program_studi', name: 'program_studi' },            
        ]
    });
  });
</script>
<script src="{{ asset('assets/js/ui-modals.js') }}"></script>
@endpush