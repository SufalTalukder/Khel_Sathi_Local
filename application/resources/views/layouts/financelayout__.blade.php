<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <title>Finance Assistance</title>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <base href="{{ url('/public') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="shortcut icon" href="favicon.png" />
  <link href="{{ asset('/public') }}/assets_admin/css/bootstrap.css" rel='stylesheet' />
  <link href="{{ asset('/public') }}/assets_admin/css/all.css" rel="stylesheet" />
  <link href="{{ asset('/public') }}/assets_admin/css/dataTables.bootstrap5.min.css" rel='stylesheet' />
  <link href="{{ asset('/public') }}/assets_admin/css/custom_theme.css" rel='stylesheet' />
  <link href="{{ asset('/public') }}/assets_admin/css/draggle.css" rel="stylesheet">
  <link href="{{ asset('/public') }}/assets_admin/css/responsive.css" rel='stylesheet' />
  <link href="{{ asset('/public') }}/assets_admin/css/datepicker.css" rel="stylesheet" media="all" />
  <link href="{{ asset('/public') }}/assets_admin/css/toast.css" rel='stylesheet' />
  <script type="text/javascript" src="{{ asset('/public') }}/js/jquery-min.js"></script>
</head>
<body class="dashbg">
  <div class="contentwraper">
    <header class="header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-1 b-right">
            <img src="{{ asset('') }}/assets_admin/images/logo.png" alt="" class="dash-logo dash-resp" />
          </div>
          <div class="col-md-11">
            <div class="row modulebg">
              <div class="col">
              <h4 class="moudlename">Khel Sathi Portal / खेल साथी पोर्टल</h4>
              </div>
             <x-financenavbar />
            </div>
          </div>
        </div>
      </div>
    </header>
    <br>
    <div class="container-fluid pagecontentbody">
      @yield('content')
    </div>
   
    <footer>
      <div class="row">
        <div class="col-md-10">
          <ul class="foot-list">
            <li>Copyright &copy; Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश सरकार</li>
          </ul>
        </div>
        <div class="col-md-2">
          <ul class="foot-list">
            <li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
  <script> var ajaxUrl = "{{ url('') }}"; </script>
  
  <!-- <script type="text/javascript" src="{{ asset('/public') }}/js/jquery-min.js"></script> -->
  <script type="text/javascript" src="{{ asset('/public') }}/js/bootstrap.js"></script>
  <script type="text/javascript" src="{{ asset('/public') }}/js/jquery.nanoscroller.min.js"></script>
  <script type="text/javascript" src="{{ asset('/public') }}/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="{{ asset('/public') }}/js/dataTables.bootstrap5.min.js"></script>
  <script type="text/javascript" src="{{ asset('/public') }}/js/builder.js"></script>
  <script type="text/javascript" src="{{ asset('/public') }}/js/beautifyhtml.js"></script>
  <script type="text/javascript" src="{{ asset('/public') }}/js/dragble.js"></script>
  <script type="text/javascript" src="{{ asset('/public') }}/js/datepicker.js"></script>
  <script type="text/javascript" src="{{ asset('/public') }}/js/datepicker.en.js"></script>
  <script type="text/javascript" src="{{ asset('/public') }}/js/theme-script.js"></script>
  <!-- <script type="text/javascript" src="{{ asset('') }}/js/sweetalert.js"></script> -->
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
  <script type="text/javascript" src="{{ asset('') }}/js/toast.js"></script>
  <script type="text/javascript" src="{{ asset('') }}/js/custom.js"></script>
  
  
  <x-message />

  <script>
    $(".toggle-password").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
    $('body,html').click(function(e){
      
      // if ($(".sidebar ").hasClass("sidebar-width") ) {
        // alert($("sidebar").length );
      // $(".sidebar").removeClass("sidebar-width");
      // $(".header").removeClass("header-width");
      // }
});
  </script>
  @stack('custom-scripts')

</body>
</html>
