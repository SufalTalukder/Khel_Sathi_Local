@extends('layouts/layout')
@section('content')
<div class="row">
                <div class="col-2">
                    <div class="fixed-sidebar">
                        <a href="{{url('dashboard')}}" class="btn btn-outline-info backbtn float-end"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
                        <div class="left-sidebar">
                            <div >
                                <ul>
                                    <li><a href="#" class="active"><span class="icons icon-arrow-right"></span>Application Form</a></li>
                                
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
                                        <form action="{{url('/')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                        <div >
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="subheading">Applicant Details</h5>
                                                </div>
                                               
                                                <div class="col-md-4">
                                                <div class="form-group">
                                                        <label class="placeholder">Which Sport do/did you play?</label>
                                                        <select class="form-select" name="sport_type" required>
                                                            <option value="">Select</option>
                                                            @foreach ($sport_type as $type)
                                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="placeholder">Position as a Sportsperson <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="s_position" value="10" pattern="[0-9]" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Upload Domicile Certificate of UP </label>
                                                        <div class="input-group">
                                                            <input type="file" name="domicile_certificate"  class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload" required>
                                                            <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                        </div>
                                                        <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="placeholder">Highest Educational Qualification</label>
                                                        <input type="text" name="qualification" class="form-control" pattern="[A-Za-z]+" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label>Upload Certificate of Highest Educational Qualification </label>
                                                        <div class="input-group">
                                                            <input type="file" name="qualification_doc" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload" required>
                                                            <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                        </div>
                                                        <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                    </div>
                                                </div>
                                            <div class="bhoechie-footer">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-3 d-grid">
                                                        <button type="submit" class="btn btn-info">Save and Next</button>
                                                    </div>
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

