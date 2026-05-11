@extends('layouts/layout')
@section('content')
<div class="container-fluid pagecontentbody">
            <div class="row">
                <div class="col-2">
                    <div class="fixed-sidebar">
                        <a href="dashboard.html" class="btn btn-outline-info backbtn float-end"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
                        <div class="left-sidebar">
                            <div >
                                <ul>
                                    <li><a href="ApplicationPreview.html" class="active"><span class="icons icon-arrow-right"></span>Application Preview</a></li>
                                    <li>
                                        <button type="button" data-print="modal" class="btn btn-outline-primary float-end"  onclick="PrintDoc()"><span class="icons icon-arrow-right"></span>Print</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-10">
                    <div class="bhoechie-tab-container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="bhoechie-tab-menu">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item active" style="width: 100%;">
                                            <span class="fas fa-file-pdf"></span>
                                            Application Preview
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
                                <div class="bhoechie-tab-content active">
                                    <div class="form-scroll">
                                        <div >
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="profile-head">
                                                        <div class="tab-content profile-tab" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                                <div class="row">
                                                                    <div class="col-md-12" id="prodiv">
                                                                        <table class="dn" style="width: 100%; margin-bottom: 5px;" border="0">
                                                                            <tr>
                                                                                <td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                                                                                    <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                                                                                        <img src="images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/>
                                                                                        <div style="font-size: 3vw; font-weight: bold;">
                                                                                            Department of Sports
                                                                                        </div>
                                                                                        <div style="font-size: 2vw; font-weight: bold;">
                                                                                            GOVERNMENT OF UTTAR PRADESH
                                                                                        </div>
                                                                                        <div style="font-size: 2vw; font-weight: bold;">
                                                                                             Application Form
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="text-align: left; font-size: 12px; padding-top: 5px;"></td>
                                                                                <td style="text-align: right; font-size: 12px; padding-top: 5px;"><b>Print Date :</b> 06-11-2022</td>
                                                                            </tr>
                                                                        </table>
                                                                        <table  id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
                                                                            <tr>
                                                                                <td colspan="6" class="bg-light">
                                                                                    <strong>Basic Details</strong>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Applicant Name</b></td>
                                                                                <td>Avinash Verma</td>
                                                                                <td><b>Date of Birth</b></td>
                                                                                <td>01/01/1990</td>
                                                                                <td rowspan="5" colspan="2"><b>Photograph of Applicant</b><br />
                                                                                    <div class="text-center" style="padding: 5px;" align="center">
                                                                                        <img src="images/profile-pic.jpg" class="img-fluid" style="width: 140px;" />
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Aadhar Number</b></td>
                                                                                <td>1234567891234</td>
                                                                                <td><b>Aadhar Card</b></td>
                                                                                <td><strong class="btn btn-success btn-xs disabled">Uploaded</strong></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Mobile Number</b></td>
                                                                                <td>9876543210</td>
                                                                                <td><b>Email ID</b></td>
                                                                                <td>avinashverma@gmail.com</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>District</b></td>
                                                                                <td>Lucknow</td>
                                                                                <td><b>Regional Sports Office</b></td>
                                                                                <td>Sport College 1</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Sports Name</b></td>
                                                                                <td>Cricket, Football</td>
                                                                                <td><b>Category</b></td>
                                                                                <td>General</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Sub Category</b></td>
                                                                                <td>-</td>
                                                                                <td><b>Father’s Name</b></td>
                                                                                <td>-</td>
                                                                                <td rowspan="2" colspan="2"><b>Signature  of Applicant</b><br />
                                                                                    <div class="text-center" style="padding: 5px;" align="center">
                                                                                        <img src="images/signature.png" class="img-fluid" style="width: 140px;" />
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Occupation</b></td>
                                                                                <td>-</td>
                                                                                <td><b>Mother’s Name</b></td>
                                                                                <td>-</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 15%"><b>Occupation</b></td>
                                                                                <td style="width: 20%">-</td>
                                                                                <td style="width: 15%"><b>Height (in centimeter)</b></td>
                                                                                <td style="width: 20%">-</td>
                                                                                <td style="width: 15%"><b>Weight (in Kg)</b></td>
                                                                                <td style="width: 15%">-</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Blood Group</b></td>
                                                                                <td>-</td>
                                                                                <td><b>Class for which admission is to be taken</b></td>
                                                                                <td>-</td>
                                                                                <td><b>Domicile of Uttar Pradesh</b></td>
                                                                                <td>-</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Domicile Certificate</b></td>
                                                                                <td><strong class="btn btn-success btn-xs disabled">Uploaded</strong></td>
                                                                                <td><b>Identification Mark</b></td>
                                                                                <td>-</td>
                                                                                <td><b>Number of Teeth</b></td>
                                                                                <td>-</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="2"><b>Suffering from Skin Disease/Fits/Other Disease</b></td>
                                                                                <td colspan="2">-</td>
                                                                                <td><b>Medical Certificate</b></td>
                                                                                <td><strong class="btn btn-success btn-xs disabled">Uploaded</strong></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="6" class="bg-light">
                                                                                    <strong>Communication Details</strong>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="6">
                                                                                    <strong style="font-size: 14px;">Permanent Address</strong>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Gram/Mohalla</b></td>
                                                                                <td>-</td>
                                                                                <td><b>Post</b></td>
                                                                                <td>-</td>
                                                                                <td><b>Thana</b></td>
                                                                                <td>-</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>State</b></td>
                                                                                <td>-</td>
                                                                                <td><b>District</b></td>
                                                                                <td>-</td>
                                                                                <td><b>Mobile No.</b></td>
                                                                                <td>-</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Alternate Contact No.</b></td>
                                                                                <td>-</td>
                                                                                <td><b>Email ID</b></td>
                                                                                <td colspan="3">-</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="6">
                                                                                    <strong style="font-size: 14px;">Correspondence Address</strong>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Gram/Mohalla</b></td>
                                                                                <td>-</td>
                                                                                <td><b>Post</b></td>
                                                                                <td>-</td>
                                                                                <td><b>Thana</b></td>
                                                                                <td>-</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>State</b></td>
                                                                                <td>-</td>
                                                                                <td><b>District</b></td>
                                                                                <td>-</td>
                                                                                <td><b>Mobile No.</b></td>
                                                                                <td>-</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Alternate Contact No.</b></td>
                                                                                <td>-</td>
                                                                                <td><b>Email ID</b></td>
                                                                                <td colspan="3">-</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="6" class="bg-light">
                                                                                    <strong>Educational Qualification</strong>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Class</b></td>
                                                                                <td>-</td>
                                                                                <td><b>School/College Name</b></td>
                                                                                <td>-</td>
                                                                                <td><b>Year of Passing</b></td>
                                                                                <td>-</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Obtained Marks</b></td>
                                                                                <td>-</td>
                                                                                <td><b>Maximum Marks</b></td>
                                                                                <td>-</td>
                                                                                <td><b>Result</b></td>
                                                                                <td>-</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="6" class="bg-light">
                                                                                    <strong>Declaration</strong>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="6">I declare that the above particulars are true to the best of my knowledge. If any of my facts are found to be wrong, my admission should be canceled, for which all responsibility will be mine. I have read all the facts thoroughly and after admission I will strictly follow the hostel rules.
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="6" align="center">
                                                                                    <input type="checkbox" checked="checked" />
                                                                                    &nbsp; <b>I Agree</b>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="3" align="center">
                                                                                    <span>-</span><br />
                                                                                    <b>Guardian Full Name</b>
                                                                                </td>
                                                                                <td colspan="3" align="center">
                                                                                    <img src="images/signature.png" class="img-fluid" style="width: 140px;" /><br />
                                                                                    <b>Guardian Signature</b>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
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
            </div>
        </div>
@endsection
