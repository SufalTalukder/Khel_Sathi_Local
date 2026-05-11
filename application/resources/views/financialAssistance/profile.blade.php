@extends('layouts/financelayout')
@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
        <div class="bhoechie-tab-content active">
            <div class="form-scroll">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-head">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-12" id="prodiv">
                                            <table id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
                                                <tr>
                                                    <td colspan="5" class="bg-light">
                                                        <strong>Basic Details</strong>
                                                    </td>
                                                    <td colspan="1" class="bg-light text-center">
                                                        @if($form_check == 0)
                                                        <a href="{{ route('faecp') }}"><span class="btn btn-primary">Edit Profile Detail</span></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Name</b></td>
                                                    <td>{{$user->fullname}}</td>
                                                    <td><b>Date of Birth</b></td>
                                                    <td> @if($user->dob !==""){{$user->dob}} @endif</td>
                                                    <td colspan="2" rowspan="5" style="text-align: center;">
                                                        <div class="mb-2">
                                                            <p class="text-start text-dark">Photo</p>
                                                            @if($user->photograph_doc !='')
                                                            @php
                                                            $img = url('storage/award').'/'.$user->photograph_doc;
                                                            $img1 = url('public/images/images.svg');
                                                            $doc = explode('.',$user->photograph_doc);
                                                            if($doc[1]=='pdf')
                                                            $img1 = url('public/images/pdf.svg');
                                                            @endphp
                                                            <img src="{{$img}}" style="width: 130px; height: 140px;">
                                                            <!-- <img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query" /> -->
                                                            @else
                                                            <strong class="btn btn-danger btn-xs"> Not Uploaded</strong>
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <p class="text-start text-dark">Signature</p>
                                                            @if($user->signature_doc !='')
                                                            @php
                                                            $img = url('storage/award').'/'.$user->signature_doc;
                                                            $img1 = url('public/images/images.svg');
                                                            $doc = explode('.',$user->signature_doc);
                                                            if($doc[1]=='pdf')
                                                            $img1 = url('public/images/pdf.svg');
                                                            @endphp
                                                            <img src="{{$img}}" style="width: 130px; height: 40px;">
                                                            <!-- <img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query" /> -->
                                                            @else
                                                            <strong class="btn btn-danger btn-xs"> Not Uploaded</strong>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Birth Place</b></td>
                                                    <td>{{$user->place_of_birth}}</td>
                                                    <td><b>Gender</b></td>
                                                    <td>{{$user->gender}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Aadhar Number</b></td>
                                                    <td>{{$user->aadhar_no}}</td>
                                                    <td><b>Marital status</b></td>
                                                    <td>{{$user->marital_status}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Mobile Number</b></td>
                                                    <td>{{$user->mobile}}</td>
                                                    <td><b>Email ID</b></td>
                                                    <td>{{$user->email}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Nationality</b></td>
                                                    <td>{{$user->nationality}}</td>
                                                    <td><b>Sports Name</b></td>
                                                    <td>{{$user->sport_type}}</td>
                                                </tr>
                                                <tr>
                                                    <!-- <td><b>Religion</b></td>
                                                    <td>{{$user->religion}}</td> -->
                                                    <td><b>Father’s Name</b></td>
                                                    <td>{{$user->father_name}}</td>
                                                    <td><b>Mother’s Name</b></td>
                                                    <td>{{$user->mother_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Domicile of Uttar Pradesh</b></td>
                                                    <td colspan="5">{{$user->native_of_up=='1'?'YES':'NO'}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" class="bg-light">
                                                        <strong>Communication Details</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Permanent Address</b></td>
                                                    <td colspan="5">{{$user->permanent_address}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>State</b></td>
                                                    <td>UTTAR PRADESH</td>
                                                    <td><b>District</b></td>
                                                    <td>{{ districtName($user->permanent_district)}}</td>
                                                    <td><b>Pin Code</b></td>
                                                    <td>{{$user->permanent_pincode}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Correspondence Address</b></td>
                                                    <td colspan="5">{{$user->present_address}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>State</b></td>
                                                    <td>{{stateName($user->present_state)}}</td>
                                                    <td><b>District</b></td>
                                                    <td>{{districtName($user->present_district)}}</td>
                                                    <td><b>Pin Code</b></td>
                                                    <td>{{$user->present_pincode}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" class="bg-light">
                                                        <strong>Documents Details</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Aadhaar </td>
                                                    <td colspan="5">
                                                        @if($user->aadhar_doc !='')
                                                        @php
                                                        $img = url('storage/award').'/'.$user->aadhar_doc;
                                                        $img1 = url('public/images/images.svg');
                                                        $doc = explode('.',$user->aadhar_doc);
                                                        if($doc[1]=='pdf')
                                                        $img1 = url('public/images/pdf.svg');
                                                        @endphp
                                                        <a class="btn btn-success btn-xs" href="{{$img}}" target="_blank">
                                                            <span >View</span>
                                                        </a>
                                                        <!-- <img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query" /> -->
                                                        @else
                                                        <strong class="btn btn-danger btn-xs"> Not Uploaded</strong>
                                                        @endif
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
@endsection
