@extends('layouts/layout')
@section('content')
<div class="row">
    <div class="col-2">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary backbtn"><span class="icons icon-arrow-left"></span> Back to Dashboard</a>
        <div class="left-sidebar">
            <div >
                <ul>
                    <li>
                        <a href="{{ route('cp') }}">
                            <span class="icons icon-arrow-right"></span>Company Profile/Basic Details
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('registered-project') }}" class="active">
                            <span class="icons icon-arrow-right"></span>Project Details
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-10">
        <div class="col-md-12 pageheader mb-0">
            <div class="row">
                <div class="col-md-12">
                    <h4>Solar Power Park Private Sector</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Solar Power Park Private Sector</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="tab-content border-all-side">
            <div class="pagebody sidepage-pading pt-3 pb-3">
                <div class="emp-profile">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-head">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="home-tab" data-toggle="tab" href="javascropt:void(0)" role="tab" aria-controls="home" aria-selected="true">Application Details</a> </li>
                                </ul>
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <form action="{{ route('powerPrivateParkSave') }}" method="post" id="reloadSolar" class="needs-validation" enctype="multipart/form-data" novalidate="">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Do you want to setup for solar park MNRE <span class="text-danger">*</span></label>
                                                        <div class="form-control">
                                                            <label class="me-3 mb-0">
                                                                <input type="radio" value="1" name="setup_for_solar_park_mnre" checked >
                                                                Yes</label>
                                                            <label class="mb-0">
                                                                <input type="radio" value="2" name="setup_for_solar_park_mnre" required>
                                                                No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="subheading"></h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Do you want status of solar park from MNRE <span class="text-danger">*</span></label>
                                                        <div class="form-control">
                                                            <label class="me-3 mb-0">
                                                                <input value="1" type="radio" name="status_of_solar_park" required checked >
                                                                Yes</label>
                                                            <label class="mb-0">
                                                                <input value="2" type="radio" name="status_of_solar_park" required >
                                                                No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Do you want to avail grant form MNRE <span class="text-danger">*</span></label>
                                                        <div class="form-control">
                                                            <label class="me-3 mb-0">
                                                                <input value="1" type="radio" name="grant_form_mnre" required checked >
                                                                Yes</label>
                                                            <label class="mb-0">
                                                                <input value="2" type="radio" name="grant_form_mnre" required >
                                                                No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Sanction Number <span class="text-danger">*</span></label>
                                                        <input type="text" required class="form-control" id="sanction_number" name="sanction_number" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Sanction Date <span class="text-danger">*</span></label>
                                                        <input type="text" required class="form-control datepicker-here" data-language="en" id="sanction_date" name="sanction_date" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Sanction Capacity (Megawatt) <span class="text-danger">*</span></label>
                                                        <input type="text" required class="form-control" id="sanction_capacity" name="sanction_capacity" >
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <h5 class="subheading">Connectivity <!-- (STU/CTU) --></h5>
                                                </div>

                                               

                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Connectivity<span class="text-danger">*</span></label>
                                                        <select class="form-control" id="connectivity" required name="connectivity">
                                                            <optio value="">Select</optio>
                                                            <option value="STU" >STU</option>
                                                            <option value="CTU" >CTU</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Preferred Sub Station <span class="text-danger">*</span></label>
                                                        <select class="form-control" id="sub_station" required name="sub_station">
                                                            <option value="">Select</option>
                                                            @foreach($station as $item)
                                                            <option value="{{ $item->id }}" >{{ $item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Voltage (KV)<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" required id="voltage" name="voltage">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <h5 class="subheading">Land Details</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Preference 1 <span class="text-danger">*</span></label>
                                                        <select class="form-control" required id="preference_first" name="preference_first">
                                                            <option value="">Select</option>
                                                            @foreach($state as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div> 
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Preference 2 <span class="text-danger">*</span></label>
                                                        <select class="form-control" required id="preference_second" name="preference_second">
                                                            <option value="">Select</option>
                                                            @foreach($state as $item)
                                                            <option value="{{ $item->id }}" >{{ $item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Preference 3 <span class="text-danger">*</span></label>
                                                        <select class="form-control" required id="preference_third" name="preference_third">
                                                            <option value="">Select</option>
                                                            @foreach($state as $item)
                                                            <option value="{{ $item->id }}" >{{ $item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Proposed Area of Land (in Acre) <span class="text-danger">*</span></label>
                                                        <input type="text" required class="form-control" id="area_of_land" name="area_of_land" >
                                                    </div>
                                                </div>
                                            </div> 
                                    </div>
                                    <div class="bhoechie-footer">
                                        <div class="row justify-content-center">
                                            <div class="col-md-2 d-grid">
                                                <!-- <button type="button" class="btn btn-primary" onclick="show3()">Submit/दर्ज करे</button> -->
                                                <button type="submit" class="btn btn-primary">Submit/दर्ज करे</button>
                                            </div>
                                            <div class="col-md-2 d-grid">
                                                <button type="reset" class="btn btn-light">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
