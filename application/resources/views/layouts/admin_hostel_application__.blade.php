<!doctype html>
<html>
<head>

    <title>Applicant Panel - Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="favicon.png" />
    <link href="{{ url('hostel_template') }}/css/bootstrap.css" rel='stylesheet' />
    <link href="{{ url('hostel_template') }}/css/all.css" rel="stylesheet" />
    <link href="{{ url('hostel_template') }}/css/dataTables.bootstrap5.min.css" rel='stylesheet' />
    <link href="{{ url('hostel_template') }}/css/custom_theme.css" rel='stylesheet' />
    <link href="{{ url('hostel_template') }}/css/draggle.css" rel="stylesheet">
    <link href="{{ url('hostel_template') }}/css/responsive.css" rel='stylesheet' />
    <link href="{{ url('hostel_template') }}/css/datepicker.css" rel="stylesheet" media="all" />
    <link href="{{ url('hostel_template') }}/css/select2.min.css" rel="stylesheet" media="all" />


</head>

@yield('application')

<script type="text/javascript" src="{{ url('hostel_template') }}/js/jquery-min.js"></script>
<script type="text/javascript" src="{{ url('hostel_template') }}/js/bootstrap.js"></script>
<script type="text/javascript" src="{{ url('hostel_template') }}/js/jquery.nanoscroller.min.js"></script>
<script type="text/javascript" src="{{ url('hostel_template') }}/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ url('hostel_template') }}/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="{{ url('hostel_template') }}/js/builder.js"></script>
<script type="text/javascript" src="{{ url('hostel_template') }}/js/beautifyhtml.js"></script>
<script type="text/javascript" src="{{ url('hostel_template') }}/js/dragble.js"></script>
<script type="text/javascript" src="{{ url('hostel_template') }}/js/datepicker.js"></script>
<script type="text/javascript" src="{{ url('hostel_template') }}/js/datepicker.en.js"></script>
<script type="text/javascript" src="{{ url('hostel_template') }}/js/select2.min.js"></script>
<script type="text/javascript" src="{{ url('hostel_template') }}/js/theme-script.js"></script>

<script type="text/javascript">
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


</body>
</html>
