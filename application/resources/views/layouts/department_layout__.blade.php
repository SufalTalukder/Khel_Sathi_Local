<!DOCTYPE html>
<html>


<head>
    
    <title>Admin - Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>
    
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="favicon.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('') }}/css/bootstrap.css" rel='stylesheet' />
    <link href="{{ asset('') }}/css/all.css" rel="stylesheet" />
    <link href="{{ asset('') }}/css/dataTables.bootstrap5.min.css" rel='stylesheet' />
    <link href="{{ asset('') }}/css/datepicker.min.css" rel='stylesheet' />
    <link href="{{ asset('') }}/css/custom_theme.css" rel='stylesheet' />
    <link href="{{ asset('') }}/css/draggle.css" rel="stylesheet" />
    <link href="{{ asset('') }}/css/responsive.css" rel='stylesheet' />
    <link href="{{ asset('') }}/assets_admin/css/toast.css" rel='stylesheet' />
    <link href="{{ asset('') }}/css/all.min.css" rel="stylesheet" />
</head>

<body class="dashbg">
    <div class="contentwraper">

        <x-departmennav />

        <div class="container-fluid pagecontentbody">
            <div class="tab-content">
                @yield('content')
            </div>
        </div>

        <footer>
            <div class="row">
                <div class="col-md-10">
                    <ul class="foot-list">
                        <li>Copyright &copy; Uttar Pradesh New and Renewable Energy Developmet Agency</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul class="foot-list">
                        <li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>


<x-modal />


    <script>
        var ajaxUrl = "{{ url('') }}";
    </script>
    <script type="text/javascript" src="{{ asset('') }}/js/jquery-min.js"></script>
    <script type="text/javascript" src="{{ asset('') }}/js/bootstrap.js"></script>
    <script type="text/javascript" src="{{ asset('') }}/js/jquery.nanoscroller.min.js"></script>
    <script type="text/javascript" src="{{ asset('') }}/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('') }}/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="{{ asset('') }}/js/datepicker.js"></script>
    <script type="text/javascript" src="{{ asset('') }}/js/datepicker.en.js"></script>
    <script type="text/javascript" src="{{ asset('') }}/js/builder.js"></script>
    <script type="text/javascript" src="{{ asset('') }}/js/beautifyhtml.js"></script>
    <script type="text/javascript" src="{{ asset('') }}/js/dragble.js"></script>
    <script type="text/javascript" src="{{ asset('') }}/js/theme-script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script type="text/javascript" src="{{ asset('') }}/js/toast.js"></script>
    <script type="text/javascript" src="{{ asset('') }}/js/custom.js"></script>
    <script type="text/javascript" src="{{ asset('') }}/js/sweetalert.min.js"></script>

    <x-message />
    <script>
        $('#aprvbtn').click(function() {
            swal({
                title: "Successful!",
                text: "Request is Approved Successfully",
                icon: "success",
                button: "OK",
            });
        });
        $('#cnfreject').click(function() {
            swal("Are you sure you want to do this?", {
                buttons: ["No", true],
            });
        });
    </script>
    @stack('custom-scripts')
    
</body>


</html>
