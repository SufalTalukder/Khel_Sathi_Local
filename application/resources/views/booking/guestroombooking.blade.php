@extends('layouts/stadium_layout')
@section('content')



<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        Guest Room Booking/अतिथि कक्ष बुकिंग
                    </h4>
                </div>
            </div>
            <div class="col-12">
                <div class="bhoechie-tab-container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
                            <div class="bhoechie-tab-content active">
                                <div class="form-scroll">
                                    <form action="{{route('guest_room_booking_store')}}" id="guest_room_book" method="post" class="needs-validation mt-4" novalidate>

                                  @csrf
                                    <div class="nano-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="inhed">Basic Details</h5>
                                            </div>


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
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">
                                                        4. Aadhaar Number/आधार नंबर <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" min="100000000000" max="999999999999" class="form-control" value="" required name="aadhaar" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>5.  State/राज्य</label>
                                                    <select class="form-select form-control"  onchange="get_city(this.value)" required name="state">
                                                        <option value="">Select State</option>
                                                        @foreach($state as $value)
                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>6.  City/शहर</label>
                                                    <select class="form-select form-control" id="district3" required name="district">
                                                        <option value="">Select District</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>7.  Address/पता</label>
                                                    <textarea class="form-control" required name="address"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="inhed">Booking Details</h5>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="placeholder">
                                                    1. 	Choose Date/दिनांक चुनें <span class="text-danger">*</span>
                                                </label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">From</span>
                                                    <input type="date" class="form-control " name="from_date" min="{{ date("Y-m-d") }}" onblur="enddate()" id="start_date" required>
                                                    <span class="input-group-text">To</span>
                                                    <input type="date" class="form-control" name="to_date" id="end_date" required>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>2. Members/सदस्य</label>
                                                    <input type="number" class="form-control" value="" name="member" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label class="placeholder">
                                                    3. Rooms Selection/कमरों का चयन <span class="text-danger">*</span>
                                                </label>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:15%;">Listing of Rooms</th>
                                                                <th>Category</th>
                                                                <th>Cities (Rate in Rs. per room) </th>
                                                                <th class="text-center">Select</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td rowspan="2">Room</td>
                                                                <td>Category A Cities</td>
                                                                <td>250</td>
                                                                <td class="text-center"><input type="radio" class="form-check-input" name="category" value="Room,Category A Cities,250" required/></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Category B Cities</td>
                                                                <td>200</td>
                                                                <td class="text-center"><input type="radio" class="form-check-input" value="Room,Category B Cities,200" name="category" required/></td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="2">Big Room</td>
                                                                <td>Category A Cities</td>
                                                                <td>500</td>
                                                                <td class="text-center"><input type="radio" class="form-check-input" value="Big Room,Category A Cities,500" name="category" required/></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Category B Cities</td>
                                                                <td>375</td>
                                                                <td class="text-center"><input type="radio" class="form-check-input" value="Big Room,Category B Cities,375" name="category" required/></td>
                                                            </tr>
                                                            <tr>
                                                                <td rowspan="2"> Hall/Room</td>
                                                                <td>Category A Cities</td>
                                                                <td>125</td>
                                                                <td class="text-center"><input type="radio" class="form-check-input" value="Hall/Room,Category A Cities,125" name="category" required/></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Category B Cities</td>
                                                                <td>125</td>
                                                                <td class="text-center"><input type="radio" class="form-check-input" value="Hall/Room,Category B Cities,125" name="category" required/></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <p class="text-danger">
                                                    <b> Note: </b>1. Category A means cities where Nagar Nigam (Municipal Corporation) is established<br />
                                                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                                                    2. Category B means where cities are without Nagar Nigam.
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="bhoechie-footer">
                                        <div class="row justify-content-center">
                                            <div class="col-md-3 d-grid">
                                                <button type="submit" class="btn btn-primary">Submit Query</button>
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



<script>






function enddate(){

$('#start_date').val();

$('#end_date').attr({
"min" : $('#start_date').val()
});
}

// $("#guest_room_book").submit(function (e) {

// e.preventDefault();
// if ($("#guest_room_book")[0].checkValidity() === false) {
//     e.stopPropagation();
// } else {
//     $.ajax({
//         type: "POST",
//         url: $(this).attr("action"),
//         data: new FormData(this),
//         dataType: "json",
//         contentType: false,
//         cache: false,
//         processData: false,
//         success: function (res) {
//             if (res.error == false) {
//                 success(res.msg);

//                 window.location.href = res.url;


//             } else {
//                 error(res.msg);
//             }
//         },
//     });
// }
// $("#guest_room_book").addClass("was-validated");
// });


function get_city(value)
{






   let option=`<option value=''>Select District</option>`;
  $.ajax({
   type: "POST",
   url: "{{url('get_city')}}",
   data: {value},

   success: function (response) {
       response.forEach((item)=>{

             option +=`<option  value="${item.id}" >${item.city}</option>`;

       });
       $("#district3").empty();
       $("#district3").append(option);
   }
  });
}







</script>

@endsection
