<!doctype html>
<html>
<head>
    <title>Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="../images/favicon.png" />
    <link href="{{ url('hostel_template') }}/css/bootstrap.css" rel='stylesheet' />
    <link href="{{ url('hostel_template') }}/css/all.css" rel="stylesheet" />
    <link href="{{ url('hostel_template') }}/css/datepicker.css" rel="stylesheet" media="all" />
    <link href="{{ url('hostel_template') }}/css/custom_theme.css" rel='stylesheet' />
    <link href="{{ url('hostel_template') }}/css/responsive.css" rel='stylesheet' />

    
    <!--<style>
        .login-form .form-control {
            min-height: 35px;
        }
    </style>-->
</head>
<body>



    <div class="container-fluid">
        <a href="#" title="Instruction" class="help" data-bs-toggle="modal" data-bs-target="#myModal"><span class="item">
                <img src="{{ asset('') }}/assets_admin/images/instruction.png" />
        </span>
            <div class="circle" style="animation-delay: 0s"></div>
            <div class="circle" style="animation-delay: 1s"></div>
            <div class="circle" style="animation-delay: 2s"></div>
            <div class="circle" style="animation-delay: 3s"></div>
        </a>
        <div class="row">
            <div class="col loginsidebar">
                <div class="row justify-content-md-center">
                    <div class="col col-lg-2 text-center mb-3">
                        <img src="{{ asset('') }}/assets_admin/images/logo.png" class="img-fluid" />
                    </div>
                    <div class="col-md-12 deptname">
                        <h1>Department of Sports</h1>
                        <h2>Government of Uttar Pradesh</h2>
                    </div>
                    <div class="col-md-12 pt-1 deptname">
                        <h3 class="text-success">Hostel Allotment</h3>
                    </div>
                </div>
            </div>
    
         
            @yield('hostelcontent')
    
            
          
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
                    <ul class="list">
                        <!--<li>Step 1: Enter your Company ID, User ID & Password. </li>
                        <li>Step 2: Set up your Security Questions. </li>
                        <li>Step 3: One Time Passcode Setup. </li>
                        <li>Step 4: User Password Change. </li>-->
                        <li>
                            <h3 class="note" style="font-size: 1.4em;"><b>Note -</b> All File Format: PDF | Max File Size: 2 MB</h3>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="concept-note" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Concept Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur quis viverra turpis. Cras quis eros eget odio varius fermentum quis condimentum ex. Etiam cursus sollicitudin sem, et consectetur mi euismod a. Suspendisse at dui interdum, tristique lacus quis, tristique sem. Donec in dui sed orci luctus dictum nec venenatis massa. Morbi non massa eget dolor convallis feugiat. Maecenas ac cursus odio. Curabitur in congue lectus. Suspendisse sed magna rhoncus, porta risus nec, tempus ante. Donec fringilla vehicula nisi a aliquam. Cras blandit varius risus malesuada porta. Vivamus non interdum metus.</p>

                    <p>Integer rutrum leo et augue imperdiet, a fermentum justo ultricies. Quisque rutrum ipsum a ligula pretium, vitae laoreet ipsum consequat. Nulla vel gravida urna, sed euismod nibh. Suspendisse mauris ipsum, feugiat sed arcu vitae, auctor rhoncus nulla. Donec ac auctor sem. Integer a dignissim quam. Maecenas id tempor lorem, eget suscipit eros. Nulla et maximus tortor. Phasellus congue augue in aliquam tincidunt. Maecenas vehicula lacus leo, non feugiat ipsum iaculis sit amet. Etiam interdum dignissim aliquet. Nulla quis ante cursus, elementum odio eu, ultricies arcu.</p>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<script src="{{ url('hostel_template') }}/js/jquery-min.js"></script>
<script src="{{ url('hostel_template') }}/js/bootstrap.js"></script>
<script type="text/javascript" src="{{ url('hostel_template') }}/js/datepicker.js"></script>
<script type="/text/javascript" src="{{ url('hostel_template') }}js/datepicker.en.js"></script>




</body>
</html>
