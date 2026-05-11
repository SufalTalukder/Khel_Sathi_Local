<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NKD3W5D5');</script>
    <!-- End Google Tag Manager -->
    <title>Applicant - Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />
    <link href="{{ asset('admin') }}/css/bootstrap.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/all.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/datepicker.css" rel="stylesheet" media="all" />
    <link href="{{ asset('player') }}/css/custom_theme_player.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/responsive.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/login.css" rel='stylesheet' />
    <link href="{{ asset('admin') }}/css/toast.css" rel='stylesheet'/>
    <!--<style>
        .login-form .form-control {
            min-height: 35px;
        }
    </style>-->
    <script type="text/javascript" src="{{ asset('assets_admin/js/jquery-min.js') }}"></script>
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKD3W5D5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    <div class="container-fluid">
        <a href="#" title="Instruction" class="help" data-bs-toggle="modal" data-bs-target="#myModal">
            <span class="item">
                <img src="{{ asset('player') }}/images/instruction.png" />
            </span>
            <div class="circle" style="animation-delay: 0s"></div>
            <div class="circle" style="animation-delay: 1s"></div>
            <div class="circle" style="animation-delay: 2s"></div>
            <div class="circle" style="animation-delay: 3s"></div>
        </a>
        <div class="row">
            <div class="col-md-6 loginsidebar">
                <div class="row justify-content-md-center">
                    <div class="col col-lg-2 text-center mb-3">
                        <img src="{{ asset('player/images/logo.png') }}" alt="logo" class="img-fluid" />
                    </div>
                    <div class="col-md-12 col-12 deptname">
                        <h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h3>
                        <h3>Department of Sports, Government of Uttar Pradesh<br>खेल विभाग, उत्तर प्रदेश सरकार</h3>
                    </div>
                    <div class="col-md-12 deptname">
                        <h1 class="text-success">Registration of Players & Coaches</h1>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
    <footer>
        <div class="row">
            <div class="col-md-10">
                <ul class="foot-list">
                    <li>Copyright &copy; Department of Sports</li>
                </ul>
            </div>
            <!--<div class="col-md-7">
                <ul class="foot-list">
                    <li><b>Technical Helpline :</b> Mobile:+91-9898989898, Email ID: testdomain@gmail.com</li>
                </ul>
            </div>-->
            <div class="col-md-2">
                <ul class="foot-list">
                    <li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Instructions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><b>In order to ensure smooth and quick filling of the application form, please keep the following ready:</b></p>
                    <ol>

                        <li>A valid mobile number with Indian SIM card</li>
                        <li>A valid email address</li>
                        <li>A digital photograph or scanned photograph of the child seeking admission</li>
                        <li>A scan copy of the child’s birth certificate</li>

                    </ol>
                </div>

            </div>
        </div>
    </div>


</body>
<script>
    var ajaxUrl = "{{ url('') }}"; 
</script>


<script type="text/javascript" src="{{ asset('admin') }}/js/bootstrap.js"></script>
<script type="text/javascript" src="{{ asset('admin') }}/js/jquery.nanoscroller.min.js"></script>
<script type="text/javascript" src="{{ asset('admin') }}/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ asset('admin') }}/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="{{ asset('admin') }}/js/builder.js"></script>
<script type="text/javascript" src="{{ asset('admin') }}/js/beautifyhtml.js"></script>
<script type="text/javascript" src="{{ asset('admin') }}/js/dragble.js"></script>
<script type="text/javascript" src="{{ asset('admin') }}/js/datepicker.js"></script>
<script type="text/javascript" src="{{ asset('admin') }}/js/datepicker.en.js"></script>
<script type="text/javascript" src="{{ asset('admin') }}/js/theme-script.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<script type="text/javascript" src="{{ url('admin') }}/js/toast.js"></script>
<script type="text/javascript" src="{{ url('admin') }}/js/custom.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="{{ url('admin') }}/js/sweetalert.min.js"></script>
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
