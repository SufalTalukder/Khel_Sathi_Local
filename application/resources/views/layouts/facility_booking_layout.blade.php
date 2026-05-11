<!doctype html>
<html>

<head>
    <title>Department of Sports</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="../images/favicon.png" />
    <link href="{{ asset('facility_booking_storage') }}/css/bootstrap.css" rel="stylesheet" />
    <link href="{{ asset('facility_booking_storage') }}/css/all.css" rel="stylesheet" />
    <link href="{{ asset('facility_booking_storage') }}/css/datepicker.css" rel="stylesheet" media="all" />
    <link href="{{ asset('facility_booking_storage') }}/css/custom_theme.css" rel="stylesheet" />
    <link href="{{ asset('facility_booking_storage') }}/css/responsive.css" rel="stylesheet" />
    <link href="{{ asset('facility_booking_storage') }}/css/default.css" rel="stylesheet" />
    <link href="{{ asset('facility_booking_storage') }}/css/login.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/toast.css" rel='stylesheet' />

    <script type="text/javascript" src="{{ asset('/public') }}/assets_admin/js/jquery-min.js"></script>

    <style>
        .form-group {
            margin-bottom: .3rem;
        }
    </style>
</head>

<body>
    @yield('content')
    <footer>
        <div class="row">
            <div class="col-md-8">
                <ul class="foot-list">
                    <li>Copyright © Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश सरकार</li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="foot-list float-end">
                    <li>
                        Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Instructions/अनुदेश</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list mb-3">
                        <li>Step 1: Get yourself registered by furnishing basic details, and OTP based verification. </li>
                        <li>Step 2: Login to the Portal with the received Login Credentials. </li>
                        <li>Step 3: Submit the Application Form. </li>
                        <li>Step 4: Wait for the response from the UP Sports Department.</li>
                    </ul>
                    <ul class="list">
                        <li>चरण 1: बुनियादी विवरण और ओटीपी आधारित सत्यापन प्रदान करके स्वयं को पंजीकृत करें।</li>
                        <li>चरण 2: प्राप्त लॉगिन क्रेडेंशियल के साथ पोर्टल पर लॉगिन करें।</li>
                        <li>चरण 3: आवेदन पत्र जमा करें।</li>
                        <li>चरण 4: यूपी खेल विभाग की प्रतिक्रिया की प्रतीक्षा करें।</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var ajaxUrl = "{{ url('') }}";
       
    </script>

    <script type="text/javascript" src="{{ asset('facility_booking_storage') }}/js/datepicker.js"></script>
    <script type="text/javascript" src="{{ asset('facility_booking_storage') }}/js/datepicker.en.js"></script>

    <script type="text/javascript" src="{{ url('admin') }}/js/bootstrap.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/jquery.nanoscroller.min.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/datepicker.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/datepicker.en.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/builder.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/beautifyhtml.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/dragble.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/theme-script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/toast.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/custom.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/chart.js"></script>
    <script type="text/javascript" src="{{ url('admin') }}/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>



    <script type="text/javascript">

    </script>
    <x-message />




    <script>
        $("#preregister").submit(function(e) {

            e.preventDefault();
            if ($("#preregister")[0].checkValidity() === false) {
                e.stopPropagation();
            } else {
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(res) {
                        if (res.error == false) {
                            success(res.msg);

                            window.location.href = res.url;


                        } else {
                            error(res.msg);
                        }
                    },
                });
            }
            $("#preregister").addClass("was-validated");
        });











        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
     @stack('custom-scripts')
</body>

</html>
