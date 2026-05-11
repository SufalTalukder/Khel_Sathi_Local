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
                                    <li class="nav-item"><a class="nav-link active" id="home-tab" data-toggle="tab" href="javascript:void(0)" role="tab" aria-controls="home" aria-selected="true">Application Details</a> </li>
                                </ul>
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <form action="{{ url('powerprojectotherupdate') }}" method="post" class="needs-validation" id="reloadSolar" novalidate>
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <input type="hidden" value="{{ $items->id }}" name="rowid" id="rowid">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label for="username" class="placeholder">Remark (Details of project)<span class="text-danger">*</span></label>
                                                        <textarea class="form-control" rows="4" name="remark" id="remark" required>{{ $items->remark}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bhoechie-footer">
                                            <div class="row justify-content-center">
                                                <div class="col-md-2 d-grid">
                                                    <button type="submit" class="btn btn-primary">Submit/दर्ज करे</button>
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
</div>

@endsection
