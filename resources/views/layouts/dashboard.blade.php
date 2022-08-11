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
      <table class="table table-striped" id="myTable">
        <thead>
          <tr>
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
@endsection

@push('script')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/b-2.2.3/b-html5-2.2.3/datatables.min.js"></script>
<script>
  $(document).ready( function () {
    $('.table').DataTable({
        processing: true,
        autoWidth: false,
        serverSide: true,
        ajax: '/json',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'program_studi', name: 'program_studi' },            
        ]
    });
  });
</script>
@endpush