@extends('layouts/layout')
@section('content')


<div class="row">
    <div class="col-2">
        <div class="fixed-sidebar">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-info backbtn float-end"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
            <div class="left-sidebar has-scrollbar" style="height: 154px;">
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
                <div class="nano-pane" style="display: none;">
                    <div class="nano-slider" style="height: 139px; transform: translate(0px, 0px);"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-10">
        <div class="col-md-12 pageheader mb-0">
            <div class="row">
                <div class="col-md-11">
                    <h4>Land Details</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Land Details</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-1 text-end">
                    <a href="{{ route('typeofPlant') }}" class="btn btn-dark">Back</a>
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
                                    <li class="nav-item"><a class="nav-link active" id="home-tab" data-toggle="tab" href="javascript:void(0)" role="tab" aria-controls="home" aria-selected="true">Proposed Land Location</a> </li>
                                </ul>
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                        <form action="{{ url('powerProjectppaUpdate') }}" method="post" id="reloadSolar" class="needs-validation" enctype="multipart/form-data" novalidate>
                                        <input type="hidden" value="{{ $items->id }}" name="rowid" id="rowid">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Preference 1 <span class="text-danger">*</span></label>
                                                        <select class="form-control" id="preference_first" name="preference_first" required>
                                                            <option value="">Select</option>
                                                            @foreach($state as $item)
                                                            <option value="{{ $item->id }}" @if($items->preference_first==$item->id) selected @endif >{{ $item->name}}</option>
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
                                                            <option value="{{ $item->id }}" @if($items->preference_second==$item->id) selected @endif >{{ $item->name}}</option>
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
                                                            <option value="{{ $item->id }}" @if($items->preference_third==$item->id) selected @endif >{{ $item->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Proposed Area of Land (in Acre) <span class="text-danger">*</span></label>
                                                        <input type="text" required class="form-control" id="area_of_land" name="area_of_land" value="{{ $items->area_of_land }}">
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
</div>



@endsection
