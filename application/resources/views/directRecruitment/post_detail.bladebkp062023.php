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
  <link href="{{ asset('/public') }}/admin/css/bootstrap.css" rel='stylesheet' />
  <link href="{{ asset('/public') }}/admin/css/all.css" rel="stylesheet" />
  <link href="{{ asset('/public') }}/admin/css/dataTables.bootstrap5.min.css" rel='stylesheet' />
  <link href="{{ asset('/public') }}/admin/css/custom_theme.css" rel='stylesheet' />
  <link href="{{ asset('/public') }}/admin/css/draggle.css" rel="stylesheet">
  <link href="{{ asset('/public') }}/admin/css/responsive.css" rel='stylesheet' />
  <link href="{{ asset('/public') }}/admin/css/datepicker.css" rel="stylesheet" media="all" />
  <link href="{{ asset('/public') }}/admin/css/toast.css" rel='stylesheet' />
  <script type="text/javascript" src="{{ asset('/public') }}/js/jquery-min.js"></script>
  <style>
    .advhed{background-color: #0078c2 !important;
    color: #fff !important;
    font-size: 15px;}
  </style>
</head>

<body class="dashbg">
  <div class="contentwraper">
    <header class="header">
      <div class="container-fluid">
        <div class="row">

          <div class="col-3 col-md-1 b-right">
            <img src="{{ asset('/public') }}/admin/images/dash-logo.png" alt="" class="dash-logo" />
          </div>
					<div class="col-9 col-md-11">
						<div class="row modulebg">
              <div class="col">
                <h4 class="moudlename">Khel Sathi Portal / खेल साथी पोर्टल</h4>
              </div>
              <div class="col-auto">
                <nav class="navbar navbar-expand-lg topmenu">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item active"><a class="nav-link" href="dashboard.html"><span class="icons icon-speedometer"></span>Dashboard/डैशबोर्ड</a></li>
                      <li class="nav-item"><a href="#" class="profileicon">
                          <img src="{{ asset('/public') }}/admin/images/profile2.jpg" /></a>
                        <div class="sidebar">
                          <div class="profiletitle">Avinash Verma <span class="text-uppercase">Applicant</span> <span>Last Login : 06/11/2022 at 05:30 PM </span></div>
                          <div class="scrollwrap">
                            <div >
                              <ul class="navsidebar">
                                <!--<li class="nav-item"><a href="user-profile.html"><span class="icons icon-user"></span> Profile</a> </li>-->
                                <li class="nav-item"><a href="#"><span class="icons icon-lock"></span>Change Password/पासवर्ड बदलें</a> </li>
                              </ul>
                            </div>
                          </div>
                          <div class="logoutbutton"><a href="#"><span class="fas fa-power-off"></span>&nbsp;&nbsp;Logout/लॉगआउट करें</a></div>
                        </div>
                      </li>
                    </ul>
                  </div>
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
                    <table  id="dataTable" class="table table-bordered table-striped">
                      <?php
                      $i = 0;
                      $date = date('d/m/Y');
                      //dd($data);
                      foreach ($data as $val) {
                        echo "<thead><tr>";
                        echo "<th colspan='5' class='advhed'><b>Adevertisment Number -</b> " . $val['advt'] . "</th>";
                        echo "</tr>
                            <tr>
                              <th>Post Name</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Document</th>
                              <th>Action</th>
                            </tr>
                        </thead>";
                        foreach ($val['data'] as $val2) {
                          $i++; ?>
                          <tbody>
                            <tr>
                              <td><?php echo $val2->post_name; ?></td>
                              <td><?php echo $val2->start_date;  ?></td>
                              <td><?php echo $val2->end_date; ?></td>
                              <td>
                                @if($val2->adevertisment_doc !='')
                                @php
                                $img = url('storage/app/public/adevertisment_doc').'/'.$val2->adevertisment_doc;
                                $img1 = url('public/images/images.svg');
                                $doc = explode('.',$val2->adevertisment_doc);
                                if($doc[1]=='pdf')
                                $img1 = url('public/images/pdf.svg');
                                @endphp
                                <img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" style=" width: 25px; " class="img-fluid img-query" />
                                @endif
                              </td>
                              <td>
                                <?php
                                $startdate = $val2->start_date;
                                $enddate =  $val2->end_date;
                                if ($startdate <= $date && $date <= $enddate) { ?>
                                  <a class="btn btn-primary btn-xs btn-block" href="#">Proceed</a>
                                <?php } else { ?>
                                  <a class="btn btn-danger btn-xs btn-block" href="#">Closed</a>
                                <?php } ?>
                              </td>
                            </tr>
                          </tbody>
                      <?php }
                      } ?>
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
        <div class="col-md-4">
				<ul class="foot-list float-end">
            <li>Powered by <a href="http://otpl.co.in/" target="_blank">OmniNet</a></li>
          </ul>
        </div>
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
    <!-- <script type="text/javascript" src="{{ url('/public') }}/js/sweetalert.js"></script> -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script type="text/javascript" src="{{ url('/public') }}/js/toast.js"></script>
    <script type="text/javascript" src="{{ url('/public') }}/js/custom.js"></script>


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
      $('body,html').click(function(e) {

      });
    </script>
    @stack('custom-scripts')


</body>

</html>