<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Digitz | Home</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{url('')}}/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{{url('')}}/assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{url('')}}/assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="{{url('')}}/assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="{{url('')}}/assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="{{url('')}}/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="{{url('')}}/assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{url('')}}/assets/images/favicon.png" />

  <meta name="anymoney-site-verification" content="6Z6LHi2MDYAn_5K9zujm_PkVPijaeV9II9uIjQxjbaoE9kWUjMWsa1ae7ahqxs617R8H">


</head>


<body>


  <div class="container-scroller">


    <div class="row p-0 m-0 proBanner" id="proBanner">
      <div class="col-md-12 p-0 m-0">
        <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
          <div class="ps-lg-1">
            <div class="d-flex align-items-center justify-content-between">
              <p class="mb-0 font-weight-medium me-3 buy-now-text">Toolz Bank for all your toolz to move on....</p>
              <a href="https://wa.me/2348105317336" target="_blank" class="btn me-2 buy-now-btn border-0">Chat with us</a>
            </div>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <a href="https://wa.me/2348105317336"><i class="mdi mdi-home me-3 text-white"></i></a>
            <button id="bannerClose" class="btn border-0 p-0">
              <i class="mdi mdi-close text-white me-0"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="dashboard"><img src="{{url('')}}/assets/images/logo.png"
            alt="logo" /></a>
        <a class="sidebar-brand brand-logo-mini" href="dashboard"><img src="{{url('')}}/assets/images/logo-mini.png"
            alt="logo" /></a>
      </div>
      <ul class="nav">
        <li class="nav-item profile">
          <div class="profile-desc">
            <div class="profile-pic">
              <div class="count-indicator">
                <img class="img-xs rounded-circle" alt="Image placeholder"
                  src="{{ Auth::user()->avatar == null ? 'https://ui-avatars.com/api/?name='.Auth::user()->name : asset(Auth::user()->avatar) }}">
                <span class="count bg-success"></span>
              </div>
              <div class="profile-name">
                <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
                <span>Welcome to Digitiz</span>
              </div>
            </div>
          
          </div>
        </li>
        <li class="nav-item nav-category">
          <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
          <a class="nav-link" href="dashboard">
            <span class="menu-icon">
              <i class="mdi mdi-speedometer"></i>
            </span>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>


        {{-- <li class="nav-item menu-items">
          <a class="nav-link" data-bs-toggle="collapse" href="#" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-icon">
              <i class="mdi mdi-laptop"></i>
            </span>
            <span class="menu-title">Basic UI Elements</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
              <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
              <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
            </ul>
          </div>
        </li> --}}



        {{-- <li class="nav-item menu-items">
          <a class="nav-link" href="pages/forms/basic_elements.html">
            <span class="menu-icon">
              <i class="mdi mdi-playlist-play"></i>
            </span>
            <span class="menu-title">Form Elements</span>
          </a>
        </li> --}}



        {{--
        <li class="nav-item menu-items">
          <a class="nav-link" href="pages/tables/basic-table.html">
            <span class="menu-icon">
              <i class="mdi mdi-table-large"></i>
            </span>
            <span class="menu-title">Tables</span>
          </a>
        </li> --}}


        {{--

        <li class="nav-item menu-items">
          <a class="nav-link" href="pages/charts/chartjs.html">
            <span class="menu-icon">
              <i class="mdi mdi-chart-bar"></i>
            </span>
            <span class="menu-title">Charts</span>
          </a>
        </li> --}}



        {{--
        <li class="nav-item menu-items">
          <a class="nav-link" href="pages/icons/mdi.html">
            <span class="menu-icon">
              <i class="mdi mdi-contacts"></i>
            </span>
            <span class="menu-title">Icons</span>
          </a>
        </li> --}}



        <li class="nav-item menu-items">
          <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <span class="menu-icon">
              <i class="mdi mdi-contacts"></i>
            </span>
            <span class="menu-title">Logs</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="logs">View Log</a></li>
              <li class="nav-item"> <a class="nav-link" href="device"> Buy Log </a></li>
            </ul>
          </div>
        </li>




        <li class="nav-item menu-items">
          <a class="nav-link" href="https://wa.me/2348105317336">
            <span class="menu-icon">
              <i class="mdi mdi-file-document-box"></i>
            </span>
            <span class="menu-title">Contact us</span>
          </a>
        </li>
      </ul>
    </nav>




    <!-- partial -->
    <div class="container-fluid page-body-wrapper">


      <!-- partial:partials/_navbar.html -->
      <nav class="navbar p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
          <a class="navbar-brand brand-logo-mini" href="dashboard"><img src="{{url('')}}/assets/images/logo-mini.png"
              alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>




          <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
              <h4>NGN {{ number_format($wallet, 2) }}</h4>
            </li>
          </ul>





          <ul class="navbar-nav navbar-nav-right">


            <li class="nav-item dropdown">
              <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">


                <div class="navbar-profile">
                  <img class="img-xs rounded-circle" alt="Image placeholder"
                    src="{{ Auth::user()->avatar == null ? 'https://ui-avatars.com/api/?name='.Auth::user()->name : asset(Auth::user()->avatar) }}">
                  <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}</p>
                  <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                aria-labelledby="profileDropdown">
                <h6 class="p-3 mb-0">Profile</h6>
                <div class="dropdown-divider"></div>


                <a class="dropdown-item preview-item"
                  href="{{ Request::is('user/*') ? url('/user/profile') : url('/admin/profile') }}">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Settings</p>
                  </div>
                </a>



                <div class="dropdown-divider"></div>
                <a href="logout" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-logout text-danger"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Log out</p>
                  </div>
                </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->

      @yield('content')


      <!-- partial:partials/_footer.html -->
      <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Digitz 2023
          </span>
          <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Get <a
              href="https://wa.me/message/2YLDDISL57EXM1" target="_blank">similar website</a></span>
        </div>
      </footer>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>




  <script>

    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus')
    })


  </script>





  <script type="text/javascript">
    (function () {
        var options = {
           
            whatsapp: "+2348105317336", // WhatsApp number
            call_to_action: "Message us", // Call to action
            button_color: "#129BF4", // Color of button
            position: "right", // Position may be 'right' or 'left'
            order: "facebook,whatsapp", // Order of buttons
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>





  



</body>


<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{url('')}}/assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{url('')}}/assets/vendors/chart.js/Chart.min.js"></script>
<script src="{{url('')}}/assets/vendors/progressbar.js/progressbar.min.js"></script>
<script src="{{url('')}}/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="{{url('')}}/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{url('')}}/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
<script src="{{url('')}}/assets/js/jquery.cookie.js" type="text/javascript"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{url('')}}/assets/js/off-canvas.js"></script>
<script src="{{url('')}}/assets/js/hoverable-collapse.js"></script>
<script src="{{url('')}}/assets/js/misc.js"></script>
<script src="{{url('')}}/assets/js/settings.js"></script>
<script src="{{url('')}}/assets/js/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{url('')}}/assets/js/dashboard.js"></script>
<!-- End custom js for this page -->

</html>