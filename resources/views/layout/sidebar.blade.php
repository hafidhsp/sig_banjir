    <nav class="sidebar sidebar-offcanvas" id="sidebar" style="padding-top: 100px;">
        <ul class="nav">
            <li class="nav-item sidebar-category">
                {{-- <p>Navigation</p>
                <span></span> --}}
                <div class="border-top"></div>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="mdi mdi-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                    {{-- <div class="badge badge-info badge-pill">2</div> --}}
                </a>
            </li>
            @if($user->role =='admin') :
                <li class="nav-item sidebar-category">
                    <div class="border-top"></div>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ url('user') }}">
                        <i class="mdi mdi-account menu-icon"></i>
                        <span class="menu-title">Data User</span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('master-data') }}">
                        <i class="bi bi-archive menu-icon"></i>
                        {{-- <i class="bi bi-building-fill-exclamation menu-icon"></i> --}}
                        <span class="menut-title">Master Data</span>
                    </a>
                </li>
                <li class="nav-item sidebar-category">
                    <div class="border-top"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('data-laporan-banjir') }}">
                        <i class="fa-solid fa-water menu-icon"></i>
                        <span class="menu-title">Data Laporan Banjir</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('data-penanggulangan') }}">
                        <i class="bi bi bi-check-circle menu-icon"></i>
                        <span class="menu-title">Data Penanggulangan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('data-penanganan') }}">
                        <i class="bi bi-exclamation-triangle-fill menu-icon"></i>
                        <span class="menu-title">Data Penanganan</span>
                    </a>
                </li>
            @endif
            @if ($user->role =='user')
                <li class="nav-item sidebar-category">
                    <div class="border-top"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('data-banjir') }}">
                        <i class="bi bi-water menu-icon"></i>
                        <span class="menu-title">Data Banjir</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ url('laporkan-banjir') }}">
                        <i class="fa-solid fa-house-flood-water-circle-arrow-right menu-icon"></i>
                        <span class="menu-title">Laporkan Banjir</span>
                    </a>
                </li>
            @endif
            @if ($user->role =='kepala')
                <li class="nav-item sidebar-category">
                    <div class="border-top"></div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('informasi-banjir') }}">
                        <i class="bi bi-water menu-icon"></i>
                        <span class="menu-title">Informasi Banjir</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ url('penanggulangan-banjir') }}">
                        <i class="bi bi-house-gear-fill menu-icon"></i>
                        <span class="menu-title">Penanggulangan Banjir</span>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)" onclick="openModalPanduan()">
                    <i class="mdi mdi-book-open-page-variant menu-icon"></i>
                    <span class="menu-title">Panduan Lokasi</span>
                </a>
            </li>
            {{-- <li class="nav-item sidebar-category">
                <p>Components</p>
                <span></span>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="mdi mdi-palette menu-icon"></i>
                    <span class="menu-title">UI Elements</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                        <li class="nav-item"> <a class="nav-link"
                                href="pages/ui-features/typography.html">Typography</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/forms/basic_elements.html">
                    <i class="mdi mdi-view-headline menu-icon"></i>
                    <span class="menu-title">Form elements</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/charts/chartjs.html">
                    <i class="mdi mdi-chart-pie menu-icon"></i>
                    <span class="menu-title">Charts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/tables/basic-table.html">
                    <i class="mdi mdi-grid-large menu-icon"></i>
                    <span class="menu-title">Tables</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/icons/mdi.html">
                    <i class="mdi mdi-emoticon menu-icon"></i>
                    <span class="menu-title">Icons</span>
                </a>
            </li>
            <li class="nav-item sidebar-category">
                <p>Pages</p>
                <span></span>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="mdi mdi-account menu-icon"></i>
                    <span class="menu-title">User Pages</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item sidebar-category">
                <p>Apps</p>
                <span></span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="docs/documentation.html">
                    <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                    <span class="menu-title">Documentation</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://www.bootstrapdash.com/demo/spica/template/">
                    <button class="btn bg-danger btn-sm menu-title">Upgrade to pro</button>
                </a>
            </li> --}}
        </ul>
    </nav>
