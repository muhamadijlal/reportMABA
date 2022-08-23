<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <div class="app-brand demo">
    <a href="index.html" class="app-brand-link">
      <span class="app-brand-logo demo">        
        <img src="{{ asset('assets/img/logo/ubp.png') }}" alt="" style="height: 50px; width: 50px;">
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2">UBP aja</span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item @if(Request::segment(1) == "dashboard") active @endif">
      <a href="/dashboard" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Pages</span>
      </li>
      <li class="menu-item @if(Request::segment(1) == "menu") active open @endif">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-dock-top"></i>
          <div data-i18n="Account Settings">Menus</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item @if(Request::segment(2) == "add-report") active @endif">
            <a href="/menu/add-report" class="menu-link">
              <div data-i18n="Notifications">Tambah Report</div>
            </a>
          </li>         
          <li class="menu-item @if(Request::segment(2) == "import-mahasiswa") active @endif">
            <a href="/menu/import-mahasiswa" class="menu-link">
              <div data-i18n="Notifications">Import Data</div>
            </a>
          </li>         
        </ul>
      </li>      
    </li>    
  </ul>

</aside>
<!-- / Menu -->

@push('script')
  <script src="{{ asset('assets/js/my.js') }}"></script>
@endpush