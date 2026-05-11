
 @extends('layouts/layout')
@section('content') 

    <div class="contentwraper">
        <header class="header">
            <div class="container-fluid"> 
                <div class="row">
                    <div class="col-3 col-md-1 b-right">
                        <img src="images/dash-logo.png" alt="" class="dash-logo" />
                    </div>
					<div class="col-9 col-md-11">
						<div class="row modulebg">
                            <div class="col">
                                <h4 class="moudlename">Department of Sports</h4>
                            </div>
                            <div class="col-auto">
                                <nav class="navbar navbar-expand-lg topmenu">
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon icons icon-menu"></span></button>
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                            <li class="nav-item active"><a class="nav-link" href="dashboard.html"><span class="icons icon-speedometer"></span> Dashboard </a></li>
                                            <li class="nav-item"><a href="#" class="profileicon">
                                                <img src="images/profile2.jpg" /></a><div class="sidebar">
                                                    <div class="profiletitle">Avinash Verma <span class="text-uppercase">Applicant</span> <span>Last Login : 06/11/2022 at 05:30 PM </span></div>
                                                    <div class="scrollwrap">
                                                        <div >
                                                            <ul class="navsidebar">
                                                                <!--<li class="nav-item"><a href="user-profile.html"><span class="icons icon-user"></span> Profile</a> </li>-->
                                                                <li class="nav-item"><a href="change-password.html"><span class="icons icon-lock"></span>  Change Password</a> </li>
                                                            </ul>
                                                        </div>
                                                    </div> 
                                                    <div class="logoutbutton"><a href="index.html"><span class="fas fa-power-off"></span>&nbsp;&nbsp;Logout</a></div>
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
                                                <a class="nav-link module-name" href="#">
                                                Government of Uttar Pradesh
                                                </a>
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
            <div class="row">
                <div class="col-2">
                    <div class="fixed-sidebar">
                        <a href="dashboard.html" class="btn btn-outline-info backbtn float-end"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
                        <div class="left-sidebar">
                            <div >
                                <ul>
                                    <li><a href="ApplicationForm.html" class="active"><span class="icons icon-arrow-right"></span>Application Form</a></li>
                                    <!--<li><a href="uploadDpr.html"><span class="icons icon-arrow-right"></span>Upload Detailed Project Report (DPR)</a></li>
                                    <li><a href="viewDetails.html"><span class="icons icon-arrow-right"></span>View Project Status</a></li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-10">
                    <div class="bhoechie-tab-container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="bhoechie-tab-content">
                                    <div class="form-scroll">
                                        <div >
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="subheading">I am applying for</h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="cars"  value="twoCarDiv" class="form-check-input"/>
                                                        <label class="form-check-label" for="inlineCheckbox2">	Financial Assistance (for Disabled/Aged and Distressed Former Sportsperson)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check form-check-inline">
                                                        <input type="radio" name="cars" value="threeCarDiv"  class="form-check-input"  /> 
                                                        <label class="form-check-label" for="inlineCheckbox2">Monthly Pension (for Sportsperson who have been awarded with Padma Shri/Padmabhushan/Arjuna/Dronacharya/Dhyan Chand Award)</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <hr />
                                                </div>
                                            </div>
                                            <div id="twoCarDiv" class="desc" style="display:none;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">Application form for Financial Assistance</h5>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Monthly Income through personal sources (INR)</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Income Certificate</label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload the District Magistrate's certificate for Income Verification</label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Name of Sport used to play</label>
                                                            <select class="form-select">
                                                                <option>Select</option>
                                                                <option>Athletics</option>
                                                                <option>Badminton </option>
                                                                <option>Cricket</option>
                                                                <option>Football</option>
                                                                <option>Gymnastic</option>
                                                                <option>Hockey</option>
                                                                <option>Judo</option>
                                                                <option>Kabaddi</option>
                                                                <option>Swimming </option>
                                                                <option>Volleyball</option>
                                                                <option>Wrestling</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>Level of Sport</label>
                                                            <select class="form-select">
                                                                <option>State level</option>
                                                                <option>National level</option>
                                                                <option>International level</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Relevant Certificate </label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Details of Other Achievements/Awards</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Relevant Documents of Other Achievements/Awards</label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Relevant Documents Justifying Achievements</label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Details of Total Professional Experience</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Details, if hold the experience of Sports Association</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Relevant Documents Justifying the Experience</label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Details of Income from other Sources</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Relevant Documents Justifying the Income</label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Details of Assistance being taken benefits of</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Relevant Documents Justifying the Assistance</label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Details of Physical Condition of the Applicant</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Medical Certificate if the applicant is unfit or disabled</label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">Bank Account Details</h5>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Name of Bank</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Branch</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Bank Account No.</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">IFSC</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Account Holder Name</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">PAN</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Mobile No. (registered with Bank Account)</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Any other relevant information applicant wants to specify?</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="bhoechie-footer">
                                                        <div class="row justify-content-center">
                                                            <div class="col-md-3 d-grid">
                                                                <button type="submit" id="back_reg" class="btn btn-info">Back</button>
                                                            </div>
                                                            <div class="col-md-3 d-grid">
                                                                <button type="submit" onclick="location.href = 'ApplicationPreviewFinancialAssistance.html';" class="btn btn-info">Save and Next</button>
                                                            </div>
                                                            <!--<div class="col-md-3 d-grid">
                                                                <button type="reset" class="btn btn-light">Reset</button>
                                                            </div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="threeCarDiv" class="desc" style="display:none;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">Application form for Monthly Pension</h5>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Which Sport do/did you play?</label>
                                                            <select class="form-select">
                                                                <option>Select</option>
                                                                <option>Athletics</option>
                                                                <option>Badminton </option>
                                                                <option>Cricket</option>
                                                                <option>Football</option>
                                                                <option>Gymnastic</option>
                                                                <option>Hockey</option>
                                                                <option>Judo</option>
                                                                <option>Kabaddi</option>
                                                                <option>Swimming </option>
                                                                <option>Volleyball</option>
                                                                <option>Wrestling</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>Honoured with which Award?</label>
                                                            <select class="form-select">
                                                                <option>Padma Shri</option>
                                                                <option>Padmabhushan</option>
                                                                <option>Arjuna</option>
                                                                <option>Dronacharya</option>
                                                                <option>Dhyan Chand Award</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Self-attested Copy of Award Certificate</label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" id="File42" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A43">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Year in which won the Award</label>
                                                            <select class="form-select">
                                                                <option>Select</option>
                                                                <option>2020</option>
                                                                <option>2021</option>
                                                                <option>2022</option>
                                                                <option>2023</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">Bank Account Details</h5>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Name of Bank</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Branch</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Bank Account No.</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">IFSC</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Account Holder Name</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">PAN</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Mobile No. (registered with Bank Account)</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-5">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Any other relevant information applicant wants to specify?</label>
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="bhoechie-footer">
                                                        <div class="row justify-content-center">
                                                            <div class="col-md-3 d-grid">
                                                                <button type="submit"   class="btn btn-info">Save and Next</button>
                                                            </div>
                                                            <!--<div class="col-md-3 d-grid">
                                                                <button type="reset" class="btn btn-light">Reset</button>
                                                            </div>-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
       
    </div>
    @endsection
  
    @push('custom-scripts')
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



    <script>
        $(document).ready(function() {
           
            
            $("input[name$='cars']").click(function() {
                var test = $(this).val();
            
                $("div.desc").hide();
                $("#" + test).show();
            });
        });

        $("#back_reg").click(()=>{
           location.href = "{{url('reg-form')}}";
        });
        
        </script>

        @endpush



