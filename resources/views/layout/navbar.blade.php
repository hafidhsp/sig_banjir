
      <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
              <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                  <span class="mdi mdi-menu"></span>
              </button>
              <div class="navbar-brand-wrapper">
                  <a class="navbar-brand brand-logo" href="{{ url('dashboard') }}"><img src="{{ asset('image/logo_4.png') }}"
                          width="40px" height="auto" alt="logo" /></a>
                  {{-- <a class="navbar-brand brand-logo-mini" href="{{ url('dashboard') }}"><img
                          src="{{ asset('images/logo-mini.svg') }}" alt="logo" /></a> --}}
              </div>
              <h5 class="font-weight-bold mb-0 d-none d-md-block mt-0">Selamat datang, {{ $user->nama_lengkap }}</h5>
              <ul class="navbar-nav navbar-nav-right" id="navbar_profile">
                  <li class="nav-item">
                      <h6 class="mb-0 font-weight-bold d-none d-xl-block">{{ $today }}</h6>
                  </li>
                  <li class="nav-item nav-profile dropdown">
                      <a class="nav-link dropdown-toggle " href="#" data-toggle="dropdown" id="profileDropdown">
                          {{-- <img src="{{ asset('images/faces/face5.jpg') }}" alt="profile" width="30px"
                              height="auto" /> --}}
                          <i class="mdi mdi-account-box-outline" style="font-size: 30px;"></i>
                          <span class="nav-profile-name" style="font-size: 20px;">{{ $user->role }}</span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                          <button type="button" class="dropdown-item"  onclick="openModalUser()">
                              <i class="mdi mdi-account text-primary"></i>
                              Akun
                          </button>
                          <a class="dropdown-item" href="{{ url('logout') }}">
                              <i class="mdi mdi-logout text-primary"></i>
                              Keluar
                          </a>
                      </div>
                  </li>
                  {{-- <li class="nav-item">
                      <a href="#" class="nav-link icon-link">
                          <i class="mdi mdi-plus-circle-outline"></i>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link icon-link">
                          <i class="mdi mdi-web"></i>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link icon-link">
                          <i class="mdi mdi-clock-outline"></i>
                      </a>
                  </li> --}}
                  {{-- <li class="nav-item dropdown mr-1">
                      <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                          id="messageDropdown" href="#" data-toggle="dropdown">
                          <i class="mdi mdi-calendar mx-0"></i>
                          <span class="count bg-info">2</span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                          aria-labelledby="messageDropdown">
                          <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                          <a class="dropdown-item preview-item">
                              <div class="preview-thumbnail">
                                  <img src="{{ asset('images/faces/face4.jpg') }}" alt="image" class="profile-pic">
                              </div>
                              <div class="preview-item-content flex-grow">
                                  <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                                  </h6>
                                  <p class="font-weight-light small-text text-muted mb-0">
                                      The meeting is cancelled
                                  </p>
                              </div>
                          </a>
                          <a class="dropdown-item preview-item">
                              <div class="preview-thumbnail">
                                  <img src="{{ asset('images/faces/face2.jpg') }}" alt="image" class="profile-pic">
                              </div>
                              <div class="preview-item-content flex-grow">
                                  <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                                  </h6>
                                  <p class="font-weight-light small-text text-muted mb-0">
                                      New product launch
                                  </p>
                              </div>
                          </a>
                          <a class="dropdown-item preview-item">
                              <div class="preview-thumbnail">
                                  <img src="{{ asset('images/faces/face3.jpg') }}" alt="image" class="profile-pic">
                              </div>
                              <div class="preview-item-content flex-grow">
                                  <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                                  </h6>
                                  <p class="font-weight-light small-text text-muted mb-0">
                                      Upcoming board meeting
                                  </p>
                              </div>
                          </a>
                      </div>
                  </li>
                  <li class="nav-item dropdown mr-2">
                      <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
                          id="notificationDropdown" href="#" data-toggle="dropdown">
                          <i class="mdi mdi-email-open mx-0"></i>
                          <span class="count bg-danger">1</span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                          aria-labelledby="notificationDropdown">
                          <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                          <a class="dropdown-item preview-item">
                              <div class="preview-thumbnail">
                                  <div class="preview-icon bg-success">
                                      <i class="mdi mdi-information mx-0"></i>
                                  </div>
                              </div>
                              <div class="preview-item-content">
                                  <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                  <p class="font-weight-light small-text mb-0 text-muted">
                                      Just now
                                  </p>
                              </div>
                          </a>
                          <a class="dropdown-item preview-item">
                              <div class="preview-thumbnail">
                                  <div class="preview-icon bg-warning">
                                      <i class="mdi mdi-settings mx-0"></i>
                                  </div>
                              </div>
                              <div class="preview-item-content">
                                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                                  <p class="font-weight-light small-text mb-0 text-muted">
                                      Private message
                                  </p>
                              </div>
                          </a>
                          <a class="dropdown-item preview-item">
                              <div class="preview-thumbnail">
                                  <div class="preview-icon bg-info">
                                      <i class="mdi mdi-account-box mx-0"></i>
                                  </div>
                              </div>
                              <div class="preview-item-content">
                                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                  <p class="font-weight-light small-text mb-0 text-muted">
                                      2 days ago
                                  </p>
                              </div>
                          </a>
                      </div>
                  </li> --}}
              </ul>

              <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                  data-toggle="offcanvas">
                  <span class="mdi mdi-menu"></span>
              </button>
          </div>
          {{-- <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">
              <ul class="navbar-nav mr-lg-2">
                  <li class="nav-item nav-search d-none d-lg-block">
                      <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search Here..." aria-label="search"
                              aria-describedby="search">
                      </div>
                  </li>
              </ul>
              <ul class="navbar-nav navbar-nav-right">
                  <li class="nav-item nav-profile dropdown">
                      <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                          <img src="{{ asset('images/faces/face5.jpg') }}" alt="profile" />
                          <span class="nav-profile-name">Eleanor Richardson</span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                          <a class="dropdown-item">
                              <i class="mdi mdi-settings text-primary"></i>
                              Settings
                          </a>
                          <a class="dropdown-item">
                              <i class="mdi mdi-logout text-primary"></i>
                              Logout
                          </a>
                      </div>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link icon-link">
                          <i class="mdi mdi-plus-circle-outline"></i>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link icon-link">
                          <i class="mdi mdi-web"></i>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link icon-link">
                          <i class="mdi mdi-clock-outline"></i>
                      </a>
                  </li>
              </ul>
          </div> --}}
      </nav>

      <script>
        const scrollThreshold = 100;
        const navbar = document.getElementById('navbar_profile');
        const desktopWidth = 992;
        window.addEventListener('scroll', function () {
            if (window.scrollY > scrollThreshold && window.innerWidth >= desktopWidth) {
            navbar.style.marginRight = "15rem"; // Margin setelah scroll
            } else if(window.scrollY < scrollThreshold) {
            navbar.style.marginRight = "3rem";
            }else {
            navbar.style.marginRight = "3rem";
            }
        });
      </script>
