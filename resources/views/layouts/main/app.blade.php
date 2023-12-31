<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ env('APP_NAME') }}</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset(get_option('primary_data',true)->favicon ?? '') }}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assets2/vendor/nucleo/css/nucleo.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets2/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets2/css/uicons-regular-straight.css') }}">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  @stack('topcss')
  <link rel="stylesheet" href="{{ asset('assets2/css/argon.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets2/css/custom.css') }}" type="text/css">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets2/plugins/toastify-js/src/toastify.css') }}">

  <link rel="stylesheet" type="text/css" href="{{ asset('assets2/plugins/pace/pace-theme-default.min.css') }}">
  @stack('css')
</head>

<body>

  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="{{ url('/login') }}">
          <img src="{{ asset(get_option('primary_data',true)->logo ?? '') }}" class="navbar-brand-img" alt="...">
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          @include('layouts.main.sidebar')
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    @include('layouts.main.header')
    @yield('head')
    <!-- Page content -->
    <div class="container-fluid mt--6">

     @yield('content')

     <!-- Footer -->
     @include('layouts.main.footer')
   </div>
 </div>
 <form action="{{ route('logout') }}" method="post" id="logout-form">@csrf</form>

 <!-- Core -->
 <script src="{{ asset('assets2/vendor/jquery/dist/jquery.min.js') }}"></script>
 <script src="{{ asset('assets2/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('assets2/vendor/js-cookie/js.cookie.js') }}"></script>
 <script src="{{ asset('assets2/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
 <script src="{{ asset('assets2/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
 @stack('topjs')  
 <script src="{{ asset('assets2/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
 <!-- Plugins  -->
 <script src="{{ asset('assets2/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
 <script src="{{ asset('assets2/plugins/toastify-js/src/toastify.js') }}"></script>
 <script src="{{ asset('assets2/plugins/form.js?v=2') }}"></script>
 <script src="{{ asset('assets2/js/jquary.js') }}"></script>
 @stack('js')
 <script src="{{ asset('assets2/plugins/pace/pace.min.js') }}"></script>
 <script src="{{ asset('assets2/js/argon.js?v=1.1.1') }}"></script>
 @stack('bottomjs')
 @if(Request::is('user/*'))
 <script src="{{ asset('assets2/js/pages/notifications.js') }}"></script>
 @endif





 <script>
  $(document).ready(function(){
   $('select[name="item"]').on('change',function(){
       var item_id= $(this).val();
       if (item_id) {
        $.ajax({
           url: "{{url('/getItem/')}}/"+item_id,
         type: "GET",
         dataType: "json",
         success: function(data){
           console.log(data);
           $('select[name="area_code"]').empty();
           $.each(data,function(key,value){
               $('select[name="area_code"]').append('<option value="'+key+'">'+value+'</option>');

           });
         }
        });
       }else {
            $('select[name="area_code"]').empty();
      }
  });
    
  });
</script>




</body>
</html>

