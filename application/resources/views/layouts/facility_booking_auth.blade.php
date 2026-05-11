<!doctype html>
<html><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->

<head>
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Applicant Panel</title>
    <!-- InstanceEndEditable -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="favicon.png" />
    <link href="{{ asset('facility_booking_storage') }}/css/bootstrap.css" rel='stylesheet' />
    <link href="{{ asset('facility_booking_storage') }}/css/all.css" rel="stylesheet" />
    <link href="{{ asset('facility_booking_storage') }}/css/dataTables.bootstrap5.min.css" rel='stylesheet' />
    <link href="{{ asset('facility_booking_storage') }}/css/custom_theme.css" rel='stylesheet' />
    <link href="{{ asset('facility_booking_storage') }}/css/draggle.css" rel="stylesheet">
    <link href="{{ asset('facility_booking_storage') }}/css/responsive.css" rel="stylesheet" media="all" />
    <link href="{{ asset('facility_booking_storage') }}/css/datepicker.css" rel="stylesheet" media="all" />
    <link href="{{ asset('facility_booking_storage') }}/css/toast.css" rel='stylesheet' />
    <link href="{{ asset('facility_booking_storage') }}/css/default.css" rel='stylesheet' />
    <link href="{{ asset('facility_booking_storage') }}/css/select2.min.css" rel="stylesheet" media="all" />
    <link href="{{ asset('facility_booking_storage') }}/css/bootstrap.css" rel="stylesheet" />
    <link href="{{ asset('facility_booking_storage') }}/css/all.css" rel="stylesheet" />
    <link href="{{ asset('facility_booking_storage') }}/css/datepicker.css" rel="stylesheet" media="all" />
    <link href="{{ asset('facility_booking_storage') }}/css/custom_theme.css" rel="stylesheet" />
    <link href="{{ asset('facility_booking_storage') }}/css/responsive.css" rel="stylesheet" />
    <link href="{{ asset('facility_booking_storage') }}/css/default.css" rel="stylesheet" />
    <link href="{{ asset('facility_booking_storage') }}/css/login.css" rel="stylesheet" />
    <link href="{{ asset('admin') }}/css/toast.css" rel='stylesheet' />

    <script type="text/javascript" src="{{ asset('/public') }}/assets_admin/js/jquery-min.js"></script>
</head>

<body class="dashbg">
    <div class="contentwraper">
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2 col-md-1 b-right"> <img src="{{ asset('facility_booking_storage') }}/images/dash-logo.png" alt="" class="dash-logo" /> </div>
                    <div class="col-10 col-md-11">
                        <div class="row modulebg">
                            <div class="col">
                                <h3 class="moudlename">Khel Sathi Portal/खेल साथी पोर्टल<span class="department-logo">Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश सरकार</span></h3>
                            </div>
                            <div class="col-auto">
                                <nav class="navbar navbar-expand-lg topmenu">
                                    <!--button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button-->
                                    <!--div class="collapse navbar-collapse" id="navbarSupportedContent"-->
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item"><a href="#" class="profileicon"> <span class="icons icon-user"></span> </a>
                                            <div class="sidebar">
                                                <div class="profiletitle">{{Auth::guard('facility_booking')->user()->name}}<span class="text-uppercase">Applicant</span> <span>Last Login : {{dmy(Auth::guard('facility_booking')->user()->last_login)}} </span></div>
                                                <div class="scrollwrap">
                                                    <div class="nano-content">
                                                        <ul class="navsidebar">
                                                            <li class="nav-item"><a  href="{{route('facility_booking_dashboard')}}"><span class="icons icon-speedometer"></span> Dashboard </a></li>

                                                            <li class="nav-item"><a href="{{route('facility_booking_change_password')}}"><span class="icons icon-lock"></span> Change Password</a> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="logoutbutton"><a href="{{route('facility_booking_logout')}}"><span class="fas fa-power-off"></span>&nbsp;&nbsp;Logout</a></div>
                                            </div>
                                        </li>
                                    </ul>
                                    <!--/div-->

                                </nav>
                            </div>
                        </div>
                        <div class="row modulebg1">
                            <div class="col">
                                <h4> Facility Booking/सुविधा बुकिंग</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- InstanceBeginEditable name="Content Area" -->
        @yield('content')
        <!-- InstanceEndEditable -->
        <footer>
            <div class="row">
                <div class="col-md-8">
                    <ul class="foot-list">
                        <li>Copyright © Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश सरकार</li>
                    </ul>
                </div>
                <!-- <div class="col-md-4">
                    <ul class="foot-list float-end">
                        <li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a> </li>
                    </ul>
                </div> -->
            </div>
        </footer>
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

    <x-message />

    <script>
        $('#checkFinal').click(function() {
            var content = document.createElement('div');
            content.innerHTML = '<h3>Please click on the Declaration Checkbox and then proceed to submit.<br>कृपया घोषणा के चेकबॉक्स पर क्लिक करें एवं तदोपरांत आगे बढ़ें।</h3>';
            if ($('#player_coachChecked').is(':checked')) {
                $('#player_coachFinalWarning').modal('toggle');
            } else
                swal(content, {
                });
            return false;
        });
        $('#final_submittttttttttttt').click(function() {
            iddd = $("#application_oidddd").val();
            var actionUrl = "{{ url('')}}/facility_booking/final_submit/" + iddd;
            $.ajax({
                type: "GET",
                url: actionUrl,
                success: function(res) {
                    if (res.error == false) {
                        success(res.msg);
                        window.location.href = res.url;
                    } else {
                        error(res.msg);
                    }
                },
            });
        });

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
        function getfileextt(value) {
            var fileExtension = ["jpg", "jpeg"];
            var file_size = value.files[0].size;
            var filevalue = value.value;
            if (
                $.inArray(filevalue.split(".").pop().toLowerCase(), fileExtension) == -1
            ) {
                $(value).val("");
                $("#sign").attr("src", "");

                error("Please Upload File in jpg ,jpeg Format.");
            } else if (file_size > 2097152) {
                $(value).val("");
                $("#sign").attr("src", "");
                error("File Size should not exceed 2 MB.");
            }
        }
        function getfileext(value) {
            var fileExtension = ["pdf"];
            var file_size = value.files[0].size;
            var filevalue = value.value;
            if (
                $.inArray(filevalue.split(".").pop().toLowerCase(), fileExtension) == -1
            ) {
                $(value).val("");
                $("#sign").attr("src", "");

                error("Please Upload File in pdf Format.");
            } else if (file_size > 2097152) {
                $(value).val("");
                $("#sign").attr("src", "");

                error("File Size should not exceed 2 MB.");
            }
        }
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
    <script>
        $('.familydetails').hide();
        $('.orgdetails').hide();
        $('#selfdetails').change(function() {
            if ($('#selfdetails').is(':checked'));
            {
                $('.familydetails').hide('slow');
                $('.orgdetails').hide('slow');
                $('.orgdetailvalidate').prop("required", false);
                $('.familydetailvalidate').prop("required", false);
            }
        });

        $('#showfamilydetails').change(function() {
            if ($('#showfamilydetails').is(':checked'));
            {
                $('.familydetails').toggle('slow');
                $('.orgdetails').hide();
                $('.orgdetailvalidate').prop("required", false);
                $('.familydetailvalidate').prop("required", true);
            }
        });

        $('#showorgdetails').change(function() {
            if ($('#showorgdetails').is(':checked'));
            {
                $('.orgdetails').toggle('slow');
                $('.familydetails').hide();
                $('.orgdetailvalidate').prop("required", true);
                $('.familydetailvalidate').prop("required", false);
                if ($("#booking_typeeeee").val() == 3) {
                    $('#dfgsdfsdfsdfsd').prop("required", false);
                }
            }
        });

        $(document).ready(function() {
            $("#location11").trigger('change');
            $("#location22").trigger('change');
            $("#location33").trigger('change');
            $("#location44").trigger('change');
            $("#location55").trigger('change');
            $("#servidfgdfgd").trigger('change');
            if ($("#booking_typeeeee").val() == 1) {
                $('#selfdetails').trigger('change');
            } else if ($("#booking_typeeeee").val() == 2) {
                $('#showfamilydetails').trigger('change');
            } else {
                $('#showorgdetails').trigger('change');
            }
            $('.select').select2();
            $('#landdocumentsyes').click(function() {
                $(".landdocuments").show();
                $(".requestland").hide();
            });
            $('#requestlandno').click(function() {
                $(".landdocuments").hide();
                $(".requestland").show();
            });
            $('#pwds').change(function() {
                if (!this.checked) {
                    $("#disabilityper").hide();
                    $("#disabilitynat").hide();
                } else {
                    $("#disabilityper").show();
                    $("#disabilitynat").show();
                }
            });
        });

        function show7() {
            document.getElementById('disabilityper').style.display = 'block';
            document.getElementById('disabilitynat').style.display = 'block';
        }
        $(document).ready(function() {
            $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
                e.preventDefault();
                $(this).siblings('a.active').removeClass("active");
                $(this).addClass("active");
                var index = $(this).index();
                $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
                $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
            });

            $('.requireland').click(function() {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".hidebox").not(targetBox).hide();
                $(targetBox).show();
            });
            $('.requireland1').click(function() {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".hidebox1").not(targetBox).hide();
                $(targetBox).show();
            });
            $('.requireland2').click(function() {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".hidebox2").not(targetBox).hide();
                $(targetBox).show();
            });

            $('.requireland3').click(function() {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".hidebox3").not(targetBox).hide();
                $(targetBox).show();
            });
            $('.requireland4').click(function() {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".hidebox4").not(targetBox).hide();
                $(targetBox).show();
            });

            $('#nationality').on('change', function() {
                if (this.value == 'other') {
                    $("#countryname").show();
                } else {
                    $("#countryname").hide();
                }
            });

            $('#typeofApp').on('change', function() {
                if (this.value == 'individual') {
                    $("#individual").show();
                    $("#organization").hide();
                } else if (this.value == 'organization') {
                    $("#organization").show();
                    $("#individual").hide();
                } else {
                    $("#individual").hide();
                    $("#organization").hide();
                }
            });

            $('#divSlsct').on('change', function() {
                if (this.value == 'red') {
                    $(".red").show();
                    $(".green").hide();
                } else if (this.value == 'green') {
                    $(".green").show();
                    $(".red").hide();
                } else {
                    $(".red").hide();
                    $(".green").hide();
                }
            });

        });
        $('.datepicker').datetimepicker({
            format: 'DD/MM/YYYY',
        });
        $(".back").click(function() {
            window.history.go(-1);
            return false;
        });

        $(document).ready(function() {
            $("select").change(function() {
                $(this).find("option:selected").each(function() {
                    var optionValue = $(this).attr("value");
                    if (optionValue) {
                        $(".box").not("." + optionValue).hide();
                        $("." + optionValue).show();
                        alert($("." + optionValue))
                    } else {
                        $(".box").hide();
                    }
                });
            }).change();
        });
    </script>
    <script>
        function stadium_list(value, id) {
            let stadium_id = $('#stadium_iddd').val();
            let location = value;
            let option = `<option value=''>Select Stadium</option>`;
            $.ajax({
                type: "POST",
                url: "{{url('facility_booking/stadium')}}",
                data: {
                    location: location
                },
                success: function(response) {
                    response.forEach((item) => {
                        option += `<option value="${item.id}"  ${item.id == stadium_id ? 'selected':''}  >${item.studium_name}</option>`;
                    })
                    $(`#${id}`).empty();
                    $(`#${id}`).append(option);
                }
            })
        }
        function showHide(elem) {
            divsO = document.getElementById("hockey").getElementsByClassName('show-hide');
            if (elem.selectedIndex !== 0) {
                //hide the divs
                for (var i = 0; i < divsO.length; i++) {
                    divsO[i].style.display = 'none';
                }
                var value_check = $('#chdecjhcjcjcfjcf').val();
                if (elem.value == 1) {
                    var id_name = 'gymnasium';
                    $('.gymnasium').prop("required", true);
                    $('.swimmingPoolMini').prop("required", false);
                    $('.guestRoom').prop("required", false);
                    $('.stadium').prop("required", false);
                    $('.swimmingPoolAdult').prop("required", false);
                    if (value_check == 1) {
                        $('.gymnasium').prop("required", false);
                    }
                }
                if (elem.value == 2) {
                    var id_name = 'guestRoom';
                    $('.gymnasium').prop("required", false);
                    $('.swimmingPoolMini').prop("required", false);
                    $('.swimmingPoolAdult').prop("required", false);
                    $('.guestRoom').prop("required", true);
                    $('.stadium').prop("required", false);
                    if (value_check == 2) {
                        $('.guestRoom').prop("required", false);
                    }
                }
                if (elem.value == 3) {
                    var id_name = 'swimmingPoolMini';
                    $('.gymnasium').prop("required", false);
                    $('.swimmingPoolMini').prop("required", true);
                    $('.swimmingPoolAdult').prop("required", false);
                    $('.guestRoom').prop("required", false);
                    $('.stadium').prop("required", false);
                    if (value_check == 3) {
                        $('.swimmingPoolMini').prop("required", false);
                    }
                }
                if (elem.value == 4) {
                    var id_name = 'swimmingPoolAdult';
                    $('.gymnasium').prop("required", false);
                    $('.swimmingPoolMini').prop("required", false);
                    $('.swimmingPoolAdult').prop("required", true);
                    $('.guestRoom').prop("required", false);
                    $('.stadium').prop("required", false);
                    if (value_check == 4) {
                        $('.swimmingPoolAdult').prop("required", false);
                    }
                }
                if (elem.value == 5) {
                    var id_name = 'stadium';
                    $('.gymnasium').prop("required", false);
                    $('.swimmingPoolMini').prop("required", false);
                    $('.swimmingPoolAdult').prop("required", false);
                    $('.guestRoom').prop("required", false);
                    $('.stadium').prop("required", true);
                    if (value_check == 5) {
                        $('.stadium').prop("required", false);
                    }
                }
                document.getElementById(id_name).style.display = 'contents';
            }
        }

        window.onload = function() {
            //get the divs to show/hide
            divsO = document.getElementById("hockey").getElementsByClassName('show-hide');
        };
    </script>
    @stack('custom-scripts')


    <!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd -->

</html>
