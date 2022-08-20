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
          <h3 class="card-title text-primary">Selamat Datang! 🎉</h3>
          <p class="mb-4">Selamat datang di web rekap data mahasiswa baru.
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

<div class="col-lg-12 mb-4 order-0">  
  <div class="card">
    <h5 class="card-header">Tabel Seleksi Mahasiswa Baru</h5>
    <div class="table-responsive text-nowrap px-4 pb-4">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
          {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
          {{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      <table class="table table-striped" id="myTable">
        <thead>
          <tr>            
            <th rowspan="2">Aksi</th>
            <th rowspan="2">Tahun Akademik</th>
            <th rowspan="2">Daya Tampung</th>
            <th colspan="2">Jumlah Calon Mahasiswa</th>
            <th colspan="2">Jumlah Mahasiswa Baru</th>
            <th colspan="2">Jumlah Mahasiswa (Student Body)</th>            
            <th rowspan="2">lampiran</th>
          </tr>
          <tr>
            <th>Pendaftar</th>
            <th>Lulus Seleksi</th>
            <th>Reguler</th>
            <th>Transfer</th>
            <th>Reguler</th>
            <th>Transfer</th>
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

{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

<script>
  let table = $('#myTable').DataTable({
    processing: true,
    dom:"lBfrtip",
    order: [[1, 'asc']],
    buttons: [
      'copy','excel'
    ],
    aLengthMenu: [
      [25, 50, 100, 200, -1],
      [25, 50, 100, 200, "All"]
    ],
    autoWidth: false,        
    serverSide: true,
    ajax: {
      url: '/report/json',
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    },
    columns: [      
      { data: 'aksi',                      name: 'aksi' },
      { data: 'periode',                   name: 'periode' },
      { data: 'daya_tampung',              name: 'daya_tampung' },
      { data: 'jumlah_maba_reguler',       name: 'jumlah_maba_reguler' },
      { data: 'jumlah_maba_transfer',      name: 'jumlah_maba_transfer' },
      { data: 'jumlah_mahasiswa_reguler',  name: 'jumlah_mahasiswa_reguler' },
      { data: 'jumlah_mahasiswa_transfer', name: 'jumlah_mahasiswa_transfer' },
      { data: 'lampiran',                  name: 'lampiran' },
    ]
  });
</script>
{{-- Sweetalert delete --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function confirmDelete(data_id) {
  swal({
    title: "Delete Report ?",
    text: "Data will permanently deleted!",
    icon: "warning",
    buttons: true,  
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      window.location.href = ("/report/destroy/"+data_id);
    } else {
      swal("Deleting Canceled");
    }
  });
}
</script>
<script src="{{ asset('assets/js/ui-modals.js') }}"></script>
@endpush