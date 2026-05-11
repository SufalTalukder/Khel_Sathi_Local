<!doctype html>
<html>
<!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>Applicant Panel</title>
    <!-- InstanceEndEditable -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="favicon.png" />
    <link href="{{ url('StadiumBooking') }}/css/bootstrap.css" rel='stylesheet' />

    <link href="{{ asset('onlineAdmission') }}/css/all.css" rel="stylesheet"/>
    <link href="{{ url('StadiumBooking') }}/css/dataTables.bootstrap5.min.css" rel='stylesheet' />
    <link href="{{ url('StadiumBooking') }}/css/custom_theme.css" rel='stylesheet' />
    <link href="{{ url('StadiumBooking') }}/css/draggle.css" rel="stylesheet">
    <link href="{{ url('StadiumBooking') }}/css/responsive.css" rel="stylesheet" media="all" />
    <link href="{{ url('StadiumBooking') }}/css/datepicker.css" rel="stylesheet" media="all" />
    <link href="{{ url('StadiumBooking') }}/css/toast.css" rel='stylesheet' />
    <link href="{{ url('StadiumBooking') }}/css/default.css" rel='stylesheet' />
    <link href="{{ url('StadiumBooking') }}/css/select2.min.css" rel="stylesheet" media="all" />
    <link href="{{ asset('admin') }}/css/toast.css" rel='stylesheet'/>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body class="dashbg">
    <div class="contentwraper">
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2 col-md-1 b-right"> <img src="{{ url('StadiumBooking') }}/images/dash-logo.png" alt="" class="dash-logo" /> </div>
                    <div class="col-10 col-md-11">
                        <div class="row modulebg">
                            <div class="col">
                                <h3 class="moudlename">Khel Sathi Portal/खेल साथी पोर्टल<span class="department-logo">Department of Sports, Government of Uttar Pradesh / खेल विभाग, उत्तर प्रदेश सरकार</span></h3>
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
                <!--<div class="col-md-7">
                    <ul class="foot-list">
                        <li><b>Technical Helpline :</b> Mobile:+91-9898989898, Email ID: testdomain@gmail.com</li>
                    </ul>
                </div>-->
                <div class="col-md-4">
                    <ul class="foot-list float-end">
                        <li>
                            Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
    <script>
        var ajaxUrl = "{{ url('') }}";
    </script>

    <script type="text/javascript" src="{{ url('StadiumBooking') }}/js/jquery-min.js"></script>
    <script type="text/javascript" src="{{ url('StadiumBooking') }}/js/bootstrap.js"></script>
    <script type="text/javascript" src="{{ url('StadiumBooking') }}/js/jquery.nanoscroller.min.js"></script>
    <script type="text/javascript" src="{{ url('StadiumBooking') }}/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ url('StadiumBooking') }}/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="{{ url('StadiumBooking') }}/js/builder.js"></script>
    <script type="text/javascript" src="{{ url('StadiumBooking') }}/js/beautifyhtml.js"></script>
    <script type="text/javascript" src="{{ url('StadiumBooking') }}/js/dragble.js"></script>
    <script type="text/javascript" src="{{ url('StadiumBooking') }}/js/datepicker.js"></script>
    <script type="text/javascript" src="{{ url('StadiumBooking') }}/js/datepicker.en.js"></script>
    <script type="text/javascript" src="{{ url('StadiumBooking') }}/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ url('StadiumBooking') }}/js/theme-script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/toast.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/custom.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/sweetalert.min.js"></script>

    <!-- InstanceBeginEditable name="for-javascript" -->
    <script>

        function show1() {
            document.getElementById('pgetway').style.display = 'flex';
            document.getElementById('ddraft').style.display = 'none';
        }
        function show2() {
            document.getElementById('pgetway').style.display = 'none';
            document.getElementById('ddraft').style.display = 'flex';
        }
        function show3() {
            document.getElementById('laidemployee').style.display = 'block';
        }
        function show4() {
            document.getElementById('laidemployee').style.display = 'none';
        }
        function show5() {
            document.getElementById('imprisoned').style.display = 'block';
        }
        function show6() {
            document.getElementById('imprisoned').style.display = 'none';
        }
        $(document).ready(function () {

            $('.select').select2();

            $('#landdocumentsyes').click(function () {
                $(".landdocuments").show();
                $(".requestland").hide();
            });
            $('#requestlandno').click(function () {
                $(".landdocuments").hide();
                $(".requestland").show();
            });

            $('#pwds').change(function () {
                if (!this.checked) {
                    $("#disabilityper").hide();
                    $("#disabilitynat").hide();
                }
                else {
                    $("#disabilityper").show();
                    $("#disabilitynat").show();
                }
            });
        });
        function show7() {
            document.getElementById('disabilityper').style.display = 'block';
            document.getElementById('disabilitynat').style.display = 'block';
        }
        $(document).ready(function () {
            $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {
                e.preventDefault();
                $(this).siblings('a.active').removeClass("active");
                $(this).addClass("active");
                var index = $(this).index();
                $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
                $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
            });

            $('.requireland').click(function () {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".hidebox").not(targetBox).hide();
                $(targetBox).show();
            });
            $('.requireland1').click(function () {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".hidebox1").not(targetBox).hide();
                $(targetBox).show();
            });
            $('.requireland2').click(function () {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".hidebox2").not(targetBox).hide();
                $(targetBox).show();
            });

            $('.requireland3').click(function () {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".hidebox3").not(targetBox).hide();
                $(targetBox).show();
            });
            $('.requireland4').click(function () {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".hidebox4").not(targetBox).hide();
                $(targetBox).show();
            });

            $('#nationality').on('change', function () {
                if (this.value == 'other') {
                    $("#countryname").show();
                }
                else {
                    $("#countryname").hide();
                }
            });

            $('#typeofApp').on('change', function () {
                if (this.value == 'individual') {
                    $("#individual").show();
                    $("#organization").hide();
                }
                else if (this.value == 'organization') {
                    $("#organization").show();
                    $("#individual").hide();
                }
                else {
                    $("#individual").hide();
                    $("#organization").hide();
                }
            });

            $('#divSlsct').on('change', function () {
                if (this.value == 'red') {
                    $(".red").show();
                    $(".green").hide();
                }
                else if (this.value == 'green') {
                    $(".green").show();
                    $(".red").hide();
                }
                else {
                    $(".red").hide();
                    $(".green").hide();
                }
            });

        });
        $('.datepicker').datetimepicker({
            format: 'DD/MM/YYYY',
        });
        $(".back").click(function () {
            window.history.go(-1);
            return false;
        });

        $(document).ready(function () {
            $("select").change(function () {
                $(this).find("option:selected").each(function () {
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

<x-message />
    <script>

        function showHide(elem) {
            if (elem.selectedIndex !== 0) {
                //hide the divs
                for (var i = 0; i < divsO.length; i++) {
                    divsO[i].style.display = 'none';
                }
                //unhide the selected div
                document.getElementById(elem.value).style.display = 'contents';
            }
        }

        window.onload = function () {
            //get the divs to show/hide
            divsO = document.getElementById("hockey").getElementsByClassName('show-hide');
        };

    </script>
    	@stack('custom-scripts')
    <!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd -->
</html>
