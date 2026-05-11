@extends('layouts/facility_booking_auth')
@section('content')

<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
      <div class="row">
        <div class="col-12">
          <div class="pageheader" id="menu-margin">
            <h4 class="mb-0">Stadium Booking/स्टेडियम बुकिंग <a href="dashboard.html"
                    class="btn btn-outline-success btn-sm backbtn float-end "><span
                      class="icons icon-arrow-left"></span>Back to Dashboard</a></h4>
          </div>
        </div>
        <div class="col-12">
          <div class="bhoechie-tab-container">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
                <div class="bhoechie-tab-content active">
                  <div class="form-scroll">
                    <div class="nano-content">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group mb-3">
                            <label class="placeholder">1. Full Name/पूरा नाम<span
                                      class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="" >
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group mb-3">
                            <label class="placeholder">2. Mobile No./मोबाइल नंबर <span
                                      class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="" >
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group mb-3">
                            <label class="placeholder">3. Email ID/ईमेल आईडी <span
                                      class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="" >
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label class="placeholder">4. 	Date Range/दिनांक सीमा <span
                                      class="text-danger">*</span></label>
                          <div class="input-group mb-3"> <span class="input-group-text">From</span>
                            <input type="date" class="form-control datepicker-here" placeholder="" aria-label="">
                            <span class="input-group-text">To</span>
                            <input type="date" class="form-control datepicker-here" placeholder="" aria-label="">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group mb-3">
                            <label class="placeholder">5. Purpose/उद्देश्य <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="" >
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group mb-3">
                            <label>6.  Sport Facility/खेल सुविधा</label>
                            <select class="form-select form-control">
                              <option>Select</option>

                            </select>
                          </div>
                        </div>


                      </div>
                    </div>

                      <div class="bhoechie-footer">
                      <div class="row justify-content-center">
                        <div class="col-md-3 d-grid">
                          <button type="reset" class="btn btn-outline-info ">Submit Application</button>
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
