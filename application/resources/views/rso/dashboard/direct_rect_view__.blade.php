@extends('layouts/admin_layout')
@section('content')

<!-- <div class="row">
    <div class="col-2">
        <div class="fixed-sidebar">
            <a href="{{url('admin/direct_rect')}}" class="btn btn-outline-info backbtn float-end"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
            <div class="left-sidebar">
                <div >
                    <ul>
                        <li>
                            <button type="button" data-print="modal" class="btn btn-outline-primary float-end"  onclick="PrintDoc()"><span class="icons icon-arrow-right"></span>Print</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
    <div class="pageheader" id="menu-margin">
        <h4 class="mb-0"> &nbsp;
        
        <a href="{{url('admin/direct_rect')}}"  class="btn btn-sm  btn-outline-primary ms-2 float-end " ><span class="icons icon-list"></span> Back to Dashboard</a>
            
            
            <button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end "   onclick="PrintDoc()"><span class="icons icon-printer"></span> Print/प्रिंट</button>
            
        </h4>
    </div>
    <!-- <div class="col-10"> -->
        <div class="bhoechie-tab-container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="bhoechie-tab-menu">
                        <div class="list-group">
                            <a href="#" class="list-group-item active" style="width: 100%;">
                                <span class="fas fa-file-pdf"></span>
                                Application Preview For Direct Recruitment
                            </a>
                        </div>
                        <div class="text-center" style="background: #fff; padding: 10px;">
                            @if(session()->has('success_marked'))
                            <div id="hide_data" class="alert alert-success" style="width: 300px;margin: 0 auto;" role="alert">
                                {{session()->get('success_marked')}}
                            </diV>
                            @endif
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
                                                                <!-- <tr>
                                                                    <td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                                                                        <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                                                                            <img src="images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;" />
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
                                                                </tr> -->
                                                                <tr>
                                                                    <td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                                                                        <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                                                                            <!-- <img src="images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
                                                                            <div style="font-size: 3vw; font-weight: bold;">
                                                                                <!-- Department of Sports -->
                                                                                Khel Sathi Portal/खेल साथी पोर्टल
                                                                            </div>
                                                                            <div style="font-size: 2vw; font-weight: bold;">
                                                                                Government of Uttar Pradesh/उत्तर प्रदेश सरकार
                                                                            </div>
                                                                            <div style="font-size: 2vw; font-weight: bold;">
                                                                                Application Form of Direct Recruitment as Gazetted Officer<br>राजपत्रित अधिकारी के रूप में सीधी भर्ती हेतु ऑनलाइन आवेदन
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            @foreach($details as $article)
                                                            <p class="bg-light"><strong>Applicant's Details/आवेदक का विवरण :-</strong> <b>{{$article->application_no}}</b></p>
                                                            <table  id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
                                                                <tr>
                                                                    <td colspan="6" class="bg-light">
                                                                        <strong style=" font-size: 1.5vw; font-weight: bold; ">Basic Details</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Applicant Name</b></td>
                                                                    <td>{{$article->fullname}}</td>
                                                                    <td><b>Date of Birth</b></td>
                                                                    <td>{{$article->dob}}</td>
                                                                    <td rowspan="5" colspan="2"><b>Photograph of Applicant</b><br />
                                                                        <div class="text-center" style="padding: 5px;" align="center">
                                                                            <img src="{{asset('storage/direct_recruitment/').'/'.$article->photograph_doc}}" class="img-fluid" style="width: 140px;" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Aadhar Number</b></td>
                                                                    <td>{{$article->aadhar_no}}</td>
                                                                    <td><b>Aadhar Card</b></td>
                                                                    <td>
                                                                        @if($article->aadhar_doc !='')
                                                                        <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                        <a href="{{url('storage/direct_recruitment',$article->aadhar_doc)}}" target="_blank">
                                                                            <span class="btn btn-success btn-xs"> View</span>
                                                                        </a>
                                                                        @else
                                                                        <strong class="btn btn-danger btn-xs">Uploaded</strong>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Mobile Number</b></td>
                                                                    <td>{{$article->mobile}}</td>
                                                                    <td><b>Email ID</b></td>
                                                                    <td>{{$article->email}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Mother’s Name</b></td>
                                                                    <td>{{$article->mother_name}}</td>
                                                                    <td><b>Father’s Name</b></td>
                                                                    <td>{{$article->father_name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Date of Birth</b></td>
                                                                    <td>{{$article->dob}}</td>
                                                                    <td><b>Place of Birth</b></td>
                                                                    <td>{{districtName($article->place_of_birth)}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Gender</b></td>
                                                                    <td>{{$article->gender}}</td>

                                                                    <!-- <td rowspan="2" colspan="2"><b>Signature  of Applicant</b><br />
                                                                                    <div class="text-center" style="padding: 5px;" align="center">
                                                                                        <img src="{{asset('storage/direct_recruitment/').'/'.$article->signature_doc}}" class="img-fluid" style="width: 140px;" />
                                                                                    </div>
                                                                                </td> -->
                                                                    <td><b>Category</b></td>
                                                                    <td>
                                                                        <!-- {{$article->category}} -->
                                                                    @if($article->category == 1) General @endif
                                                                        @if($article->category == 2) OBC @endif
                                                                        @if($article->category == 3) SC @endif
                                                                        @if($article->category == 4) ST @endif
                                                                        @if($article->category == 5) Other @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="width: 15%"><b>Religion</b></td>
                                                                    <td style="width: 20%">{{$article->religion}}</td>
                                                                    <td style="width: 15%"><b>Relationship Status</b></td>
                                                                    <td style="width: 20%">{{$article->marital_status}}</td>
                                                                    <td style="width: 15%"><b>Nationality</b></td>
                                                                    <td style="width: 15%">{{$article->nationality}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>State</b></td>
                                                                    <td>Uttar Pradesh</td>
                                                                    <td><b>District</b></td>
                                                                    <td>{{districtName($article->present_district)}}</td>
                                                                    <td><b>Sports Achievement</b></td>
                                                                    <td>{{$article->sport_achievement}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Highest Educational Qualification</b></td>
                                                                    <td>
                                                                        @if($article->qualification_doc !='')
                                                                        <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                        <a href="{{url('storage/direct_recruitment',$article->qualification_doc)}}" target="_blank">
                                                                            <span class="btn btn-success btn-xs"> View</span>
                                                                        </a>
                                                                        @else
                                                                        <strong class="btn btn-danger btn-xs">Uploaded</strong>
                                                                        @endif
                                                                    </td>

                                                                    <td><b>Domicile Certificate issued by the Competent Authority</b></td>
                                                                    <td>
                                                                        @if($article->domicile_certificate !='')
                                                                        <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                        <a href="{{url('storage/direct_recruitment',$article->domicile_certificate)}}" target="_blank">
                                                                            <span class="btn btn-success btn-xs"> View</span>
                                                                        </a>
                                                                        @else
                                                                        <strong class="btn btn-danger btn-xs">Uploaded</strong>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6" class="bg-light">
                                                                        <strong style=" font-size: 1.5vw; font-weight: bold; ">Present Address</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Address</b></td>
                                                                    <td>{{$article->present_address}}</td>
                                                                    <td><b>District</b></td>
                                                                    <td>{{districtName($article->present_district)}}</td>
                                                                    <td><b>State</b></td>
                                                                    <td>Uttar Pradesh</td>

                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6" class="bg-light">
                                                                        <strong style=" font-size: 1.5vw; font-weight: bold; ">Permanent Address</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Address</b></td>
                                                                    <td>{{$article->permanent_address}}</td>
                                                                    <td><b>District</b></td>
                                                                    <td>{{districtName($article->permanent_district)}}</td>
                                                                    <td><b>State</b></td>
                                                                    <td>Uttar Pradesh</td>

                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6" class="bg-light">
                                                                        <strong style=" font-size: 1.5vw; font-weight: bold; ">Posts Details</strong>
                                                                    </td>
                                                                </tr>
                                                                @foreach( $post as $key=>$post)
                                                                <tr>
                                                                    <td><b>
                                                                    @if($post->post_type == '1') Prefrence 1
                                                                                @elseif($post->post_type == '2') Prefrence 2  
                                                                                @elseif($post->post_type == '3') Prefrence 3 
                                                                                @elseif($post->post_type == '4') Prefrence 4
                                                                                @else Prefrence 5
                                                                                @endif 
                                                                    </b></td>

                                                                    <td colspan="6">

                                                                        <span>{{postName($post->post_name)}}</span>

                                                                    </td>

                                                                </tr>
                                                                @endforeach
                                                                <tr>
                                                                    <td colspan="6" class="bg-light">
                                                                        <strong style=" font-size: 1.5vw; font-weight: bold; ">Declaration</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="1" align="center">

                                                                        <input type="checkbox" id="checkbox" disabled checked="checked" />
                                                                        &nbsp; <b>I Agree</b>

                                                                    </td>
                                                                    <td colspan="5">I do hereby undertake that the above information given by me is correct and true to the best of my knowledge and belief and nothing has been concealed.
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3" align="center">
                                                                        <strong>Date</strong><br>
                                                                        <b>{{ dmy($article->created_at)}}</b>
                                                                    </td>
                                                                    <td colspan="3" align="center">
                                                                        <img src="{{asset('storage/direct_recruitment/').'/'.$article->signature_doc}}" class="img-fluid" style="width: 140px;" /><br />
                                                                        <b>Signature</b>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                                <?php 
                                                                                 
                                                                                if($article->form_status == 1 || $article->form_status == 2 || $query_s != 0){ ?>
                                                                                    <!-- <td colspan="2" align="center">
                                                                                    <a href="#"  class="btn btn-info disabled btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a>
                                                                                </td>
                                                                                <td colspan="2" align="center">
                                                                                    <a href="#" class="btn btn-success disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Subapp">Accept</a>
                                                                                </td>
                                                                                <td colspan="2" align="center">
                                                                                    <a href="#"  class="btn btn-danger disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>
                                                                                </td> -->
                                                                                @if($article->form_status == 1)
                                                                                        <td colspan="6" align="center">
                                                                                        <b>Form Status :-</b> <span class="btn btn-success disabled btn-sm ml-5">Accepted</span>
                                                                                        </td>
                                                                                        @elseif($article->form_status == 2)
                                                                                        <td colspan="6" align="center">
                                                                                        <b>Form Status :-</b> <span class="btn btn-danger btn-sm ml-5">Rejected</span>
                                                                                        </td>
                                                                                @else
                                                                                <td colspan="3"  class="noprint" align="center">
                                                                                    <b>Form Status :-</b> <span class="btn btn-danger btn-sm ml-5">Pending</span>
                                                                                    <!-- <a href="#" class="btn btn-info disabled btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a> -->
                                                                                </td>
                                                                                <td colspan="3"  class="noprint" align="center">
                                                                                    <b>Action:- </b> &nbsp;
                                                                                    <a href="#" class="btn btn-info disabled btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a>
                                                                                    <a href="#" class="btn btn-success disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Subapp">Accept</a>
                                                                                    <a href="#" class="btn btn-danger disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>
                                                                                </td>
                                                                                @endif
                                                                               
                                                                               
                                                                           <?php } else {?>
                                                                            <td colspan="3" class="noprint" align="center">
                                                                                    <b>Form Status :-</b> <span class="btn btn-danger btn-sm ml-5">Pending</span>
                                                                                    <!-- <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a> -->
                                                                            </td>
                                                                            <td colspan="3"  class="noprint" align="center">
                                                                                <b>Action:- </b> &nbsp;
                                                                                <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a>
                                                                                <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#Subapp">Accept</a>
                                                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>

                                                                            </td>
                                                                                <?php } ?>
                                                                                    

                                                                                
                                                                            </tr>
                                                            </table> 
                                                            @endforeach
                                                            @if($article->form_status == 1 || $article->form_status == 2)
                                                                @if(count($queryData) > 0)
                                                                <x-query-details :queryData="$queryData" />
                                                                @endif
                                                            @else
                                                            <x-query-details :queryData="$queryData" />
                                                            @endif
                                                            <!-- <x-query-details :queryData="$queryData" /> -->
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

<x-marked-query :id="$id" :type="6" />

<!--For Reject Application-->
<div class="modal fade" id="Rejectapp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reject Application</h5>
                        <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                    </div>
                    <div class="modal-body">
                        <h3 class="text-center">Reject Application</h3>
                    </div>
                    <form action="{{route('direct_is_rejected')}}" method="post">
                        @csrf
                    <div class="modal-footer">
                        <input type="hidden" name="user_id" value="{{$article->user_id}}">  
                        <input type="hidden" name="form_type" value="6">  
                        <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                        <button type="submit" class="btn btn-info" >Yes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

<!--For Submit Application-->
<div class="modal fade" id="Subapp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Submit Application</h5>
                        <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                    </div>
                    <div class="modal-body">
                        <h3 class="text-center">Successfully Submit Application</h3>
                    </div>
                    <form action="{{route('direct_is_accepted')}}" method="post">
                        @csrf
                    <div class="modal-footer">
                    <input type="hidden" name="user_id" value="{{$article->user_id}}">  
                    <input type="hidden" name="form_type" value="6"> 
                        <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                        <button type="submit" class="btn btn-info" >Yes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>



<div class="modal fade" id="SubmitFrm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--<div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Instructions</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>-->
            <div class="modal-body text-center">
                <p>
                    <img src="images/sent.png" alt="Sent" title="Sent">
                </p>
                <div class="clearfix"></div>
                <!--<h5>Your OTP verification is done successfully. Kindly <b>Proceed to Pay</b> the Registration Fee. After Fee Payment, your Registration on Portal will be completed, and Password will be sent on your registered Mobile No. & Email ID.</h5>-->
                <h5>Your Registration is completed and Password has been sent on your registered Mobile No. & Email ID. Kindly Login to proceed.</h5>
            </div>
            <div class="modal-footer justify-content-md-center">
                <div class="col-4 d-grid">
                    <a class="btn btn-info" href="dashboard.html">Final Submit</a>
                </div>

            </div>
        </div>
    </div>
</div>

