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
                <div class="col-md-10">
                    <h4>Project List</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="j{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Project List</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-2 text-end">
                    <a class="btn btn-sm btn-dark" href="{{ url('typeofPlant') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp; New Project</a>
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
                                    <li class="nav-item"><a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Application Details</a> </li>
                                </ul>
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <form action="{{ url('solarOpenAccessUpdate') }}" method="post" id="reloadSolar" class="needs-validation" enctype="multipart/form-data" novalidate="">
                                        <input type="hidden" value="{{ $items->id }}" name="rowid" id="rowid">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">User Type <span class="text-danger">*</span></label>
                                                        <div class="form-control">
                                                            <label class="me-3 mb-0">
                                                                <input type="radio" @if($items->usertype=='Third-party') checked @endif name="usertype" value="Third-party">
                                                                Third-party
                                                            </label>
                                                            <label class="mb-0">
                                                                <input type="radio" @if($items->usertype=='Captive') checked @endif name="usertype" value="Captive">
                                                                Captive
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>

                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Is Connectivity Required <span class="text-danger">*</span></label>
                                                        <div class="form-control">
                                                            <label class="me-3 mb-0"><input type="radio" value="Yes" @if($items->is_connectivity=='Yes') checked @endif name="is_connectivity"> Yes</label>
                                                            <label class="mb-0"><input type="radio" value="No" @if($items->is_connectivity=='No') checked @endif name="is_connectivity"> No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Load Capacity (Megawatt) <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="load_capacity" required name="load_capacity" value="{{ $items->load_capacity }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Connectivity<span class="text-danger">*</span></label>
                                                        <select class="form-control" id="connectivity" required name="connectivity">
                                                            <option value="">Select</option>
                                                            <option value="STU" @if($items->connectivity=='STU') selected @endif >STU</option>
                                                            <option value="CTU" @if($items->connectivity=='CTU') selected @endif >CTU</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Preferred Sub Station 1<span class="text-danger">*</span></label>
                                                        <select class="form-control" required id="preference_first_substation" name="preference_first_substation">
                                                            <option value="">Select</option>
                                                            @foreach($sub_station as $stationss)
                                                            <option value="{{$stationss->id}}" @if($items->preference_first_substation==$stationss->id) selected @endif >{{$stationss->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Preferred Sub Station 2<span class="text-danger">*</span></label>
                                                        <select class="form-control" required id="preference_second_substation" name="preference_second_substation">
                                                            <option value="">Select</option>
                                                            @foreach($sub_station as $stations)
                                                            <option value="{{$stations->id}}" @if($items->preference_second_substation==$stations->id) selected @endif >{{$stations->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Preferred Sub Station 3<span class="text-danger">*</span></label>
                                                        <select class="form-control" required id="preference_third_substation" name="preference_third_substation">
                                                            <option value="">Select</option>

                                                            @foreach($sub_station as $station)
                                                            <option value="{{$station->id}}" @if($items->preference_third_substation==$station->id) selected @endif >{{$station->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">At Voltage <span class="text-danger">*</span></label>
                                                        <input type="text" required class="form-control" id="at_voltage" name="at_voltage" value="{{ $items->at_voltage }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bhoechie-footer">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-2 d-grid">
                                                        <button type="submit" class="btn btn-primary">Submit/दर्ज करे</button>
                                                    </div>
                                                    <!-- <div class="col-md-2 d-grid">
                                                        <button type="reset" class="btn btn-light">Reset</button>
                                                    </div> -->
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
    </div>

    @endsection
