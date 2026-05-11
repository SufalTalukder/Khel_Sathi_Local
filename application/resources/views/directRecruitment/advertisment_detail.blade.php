<!DOCTYPE html>
<html lang="en">

<head>
  <title>Advertisment Post Detail</title>
  <meta charset="utf-8">
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
  <style>
    .advhed {
      background-color: #0078c2 !important;
      color: #fff !important;
      font-size: 15px;
    }
  </style>
</head>

<body class="dashbg">
  <div class="contentwraper">
    <header class="header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-3 col-md-1 b-right">
            <img src="{{ asset('/public') }}/assets_admin/images/dash-logo.png" alt="" class="dash-logo" />
          </div>
          <div class="col-9 col-md-11">
            <div class="row modulebg">
              <div class="col">
                <h4 class="moudlename">Khel Sathi Portal / खेल साथी पोर्टल</h4>
              </div>
              <div class="col-auto">
                <nav class="navbar navbar-expand-lg topmenu">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
                </nav>
              </div>
              <nav class="navbar navbar-expand-lg mainmenu">
                <div class="container-fluid p-0">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
                  <div class="collapse navbar-collapse" id="Div1">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                        <a class="nav-link module-name" href="#">Online System for Former Sportspersons of UP to Seek Financial Assistance/Monthly Pension/वित्तीय सहायता/मासिक पेंशन प्राप्त करने हेतु उत्तर प्रदेश के पूर्व खिलाड़ियों के लिए ऑनलाइन प्रणाली</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="container-fluid pagecontentbody">
      <div class="tab-content">
        <div class="pagebody removebg-color">
          <div class="pageheader">
            <div class="row">
              <div class="col-md-10">
                <h4 class="mb-0">Advertisment Post Detail</h4>
              </div>
              <div class="col-md-2 d-grid">
                <!--<a class="btn btn-sm btn-dark" href="ApplicationForm.html"><i class="fa fa-plus"></i>&nbsp;&nbsp; Application Form</a>-->
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <table id="dataTable" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Mode of Recruitment</th>
                          <th>Examination Name</th>
                          <!-- <th>Start Date</th> -->
                          <th>Adevertisment Number,Date</th>
                          <th>Start Date</th>
                          <th>Form Submission Last Date</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($adv_list as $item)
                        <tr>
                          <td>Direct</td>
                          <td>Direct Recruitment</td>
                          <td>{{$item->post_name}},{{dmy($item->start_date)}}</td>
                          <td>{{dmy($item->start_date)}}</td>
                          <td>{{dmy($item->end_date)}}</td>
                          <td>
                            <?php
                            $date = date('d-m-Y');
                            $startdate = dmy($item->start_date);
                            $enddate =  dmy($item->end_date);
                            if ($startdate > $date && $date <= $enddate) { ?>
                              <a class="btn btn-primary btn-xs btn-block" href="javascript:void(0)">Not Open</a>
                            <?php } else if ($startdate <= $date && $date <= $enddate) { ?>
                              <a class="btn btn-primary btn-xs btn-block" href="{{route('drloginForm')}}">Apply</a>
                            <?php } else { ?>
                              <a class="btn btn-danger btn-xs btn-block" href="javascript:void(0)">Closed</a>
                            <?php } ?>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer>
      <div class="row">
        <div class="col-md-8">
          <ul class="foot-list">
            <li>Copyright &copy; Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश सरकार</li>
          </ul>
        </div>
        <!-- <div class="col-md-4">
          <ul class="foot-list float-end">
            <li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a></li>
          </ul>
        </div> -->
      </div>
    </footer>
    <script>
      var ajaxUrl = "{{ url('') }}";
    </script>
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
      $('body,html').click(function(e) {});
    </script>
    @stack('custom-scripts')
</body>

</html>
