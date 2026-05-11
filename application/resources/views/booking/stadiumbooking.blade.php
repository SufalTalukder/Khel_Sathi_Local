@extends('layouts/stadium_layout')
@section('content')
<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
      <div class="row">
        <div class="col-12">
          <div class="pageheader" id="menu-margin">
            <h4 class="mb-0">Stadium Booking/स्टेडियम बुकिंग </h4>
          </div>
        </div>
        <div class="col-12">
          <div class="bhoechie-tab-container">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
                <div class="bhoechie-tab-content active">
                  <div class="form-scroll">

                    <form action="{{route('stadium_booking_store')}}" id="guest_room_book" method="post" class="needs-validation mt-4" novalidate>

                        @csrf
                    <div class="nano-content">
                      <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="placeholder">
                                    1. Full Name/पूरा नाम<span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" value="" name="name"  maxlength="255" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="placeholder">
                                    2. Email ID/ईमेल आईडी <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" value="" name="email" maxlength="255" pattern="^[^ ]+@[^ ]+\.[a-z]{2,6}$" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="placeholder">
                                    3. Mobile No./मोबाइल नंबर <span class="text-danger">*</span>
                                </label>
                                <input type="number" min="6000000000" max="9999999999"  class="form-control" value="" name="mobile"  pattern="[6-9][0-9]{9}$"  required>
                            </div>
                        </div>
                        <div class="col-md-4">
                          <label class="placeholder">4. 	Date Range/दिनांक सीमा <span
                                      class="text-danger">*</span></label>
                          <div class="input-group mb-3"> <span class="input-group-text">From</span>
                            <input type="date" class="form-control " name="from_date" min="{{ date("Y-m-d") }}" onblur="enddate()" id="start_date" required>
                                <span class="input-group-text">To</span>
                                <input type="date" class="form-control" name="to_date" id="end_date" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group mb-3">
                            <label class="placeholder">5. Purpose/उद्देश्य <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="" required name="purpose">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group mb-3">
                            <label>6.  Sport Facility/खेल सुविधा</label>
                            <select class="form-select form-control" name="sport" required>
                              <option value="">Select</option>
                              @foreach ($sport as $item)
                              <option value="{{ $item->id }}">{{ $item->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                         <div class="col-md-4">
                          <div class="form-group mb-3">
                            <label>7.  Select Stadium/स्टेडियम का चयन करें</label>
                            <select class="form-select form-control" name="stadium" required>
                              <option value="">Select</option>
                              @foreach ($stadium as $item)
                              <option value="{{ $item->id }}">{{ $item->studium_name }}</option>
                              @endforeach

                            </select>
                          </div>
                        </div>
                          <div class="col-md-4">
                          <div class="form-group mb-3">
                            <label>8. Institute Name/संस्थान का नाम</label>
                            <select class="form-select form-control" name="institute" required>
                              <option value="">Select</option>
                              <option value="institute1">Institute 1</option>
                              <option value="institute2">Institute 2</option>
                            </select>
                          </div>
                        </div>

                      </div>
                    </div>

                      <div class="bhoechie-footer">
                      <div class="row justify-content-center">
                        <div class="col-md-3 d-grid">
                          <button type="submit" class="btn btn-outline-info ">Submit Application</button>
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
<script>
    function enddate(){

$('#start_date').val();

$('#end_date').attr({
"min" : $('#start_date').val()
});
}
</script>
