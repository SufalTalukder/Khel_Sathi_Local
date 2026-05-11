@extends('layouts/layout')
@section('content')
 <div class="row">
 <div class="col-2">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary backbtn"><span class="icons icon-arrow-left"></span> Back to Dashboard</a>
        <div class="left-sidebar">
            <div >
                <ul>
                    
                <li><a href="ApplicationForm.html" class="active"><span class="icons icon-arrow-right"></span>Application Form</a></li>
                </ul>
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
                                                     <h5 class="subheading">Registration Details</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">Applicant Full Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="full_name"  >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">Which Sport did/do you play? <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="sport_type"  >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">Position as a Sportsperson <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="sport_position" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">Mobile Number <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="contact_no" >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">Email ID <span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" name="email_id" >
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <h5 class="subheading">Applicant Details</h5>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Date of Birth</label>
                                                            <input type="text" class="form-control datepicker-here" name="dob" data-language="en" placeholder="DD/MM/YYYY">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Place of Birth</label>
                                                            <input type="text" class="form-control" data-language="en" name="birth_lo">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>Gender</label>
                                                            <select class="form-select" name="gender">
                                                                <option>Select</option>
                                                                <option>Male</option>
                                                                <option>Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Mother’s Name </label>
                                                            <input type="text" class="form-control" name="mother_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Father’s Name </label>
                                                            <input type="text" class="form-control" name="father_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Permanent Address </label>
                                                            <input type="text" class="form-control" name="p_address">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">State </label>
                                                            <select class="form-select" name="state">
                                                                <option>Select</option>
                                                                <option>-</option>
                                                                <option>-</option>
                                                                <option>-</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">District </label>
                                                            <select class="form-select" name="district">
                                                                <option>Select</option>
                                                                <option>-</option>
                                                                <option>-</option>
                                                                <option>-</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Domicile Certificate of UP </label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" name="domicile_certificate" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Current Address </label>
                                                            <input type="text" class="form-control" name="present_address">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">State </label>
                                                            <select class="form-select" name="present_state">
                                                                <option>Select</option>
                                                                <option>-</option>
                                                                <option>-</option>
                                                                <option>-</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">District </label>
                                                            <select class="form-select" name="present_district">
                                                                <option>Select</option>
                                                                <option>-</option>
                                                                <option>-</option>
                                                                <option>-</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Highest Educational Qualification</label>
                                                            <input type="text" class="form-control" name="qualification">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label>Upload Certificate of Highest Educational Qualification </label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" name="qualification_doc" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                
                                            <div class="bhoechie-footer">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-3 d-grid">
                                                        <button type="button" id="reg-submit"  class="btn btn-info">Save and Next</button>
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



@endsection

@push('custom-scripts')
<script type="text/javascript">
         function showMsg()
         {
            info("Please Complete Your Profile");
         }

         $("#reg-submit").click(()=>{
           location.href = "{{url('submit-reg-form')}}";
         });
</script>
@endpush

