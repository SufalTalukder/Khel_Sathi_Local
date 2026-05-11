@extends( 'layouts\private_coaching_auth_layout' )
@section('content')
<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="mb-0"> Profile Detail Form</h4>
                        </div>
                        <div class="col-md-2 d-grid">
                            <a href="{{route('private_coaching_dashboard')}}" class="btn btn-outline-success mb-2">
                                <span class="icons icon-arrow-left"></span>Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="bhoechie-tab-container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
                            <div class="bhoechie-tab-content active">
                                <div class="form-scroll">
                                    <div class="nano-content">
                                        <div class="col-md-12">
                                            <h5 class="subheading">A. Registration Details/पंजीकरण के विवरण</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">
                                                        1.) Full Name/पूरा नाम <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" value="{{Auth::guard('PrivateCoaching')->user()->name}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">
                                                        2.) Designation/पदनाम <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" value="{{Auth::guard('PrivateCoaching')->user()->designation}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">
                                                        3.) Email ID/ईमेल आईडी <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" value="{{Auth::guard('PrivateCoaching')->user()->email}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">
                                                        4.) Mobile No./मोबाइल नंबर <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" value="{{Auth::guard('PrivateCoaching')->user()->mobile}}" disabled>
                                                </div>
                                            </div>


                                        </div>




                                     <form action="{{route('private_coaching_profile')}}" method="post" class="needs-validation" id="submitform" novalidate enctype="multipart/form-data">
                                      @csrf



                                    <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">
                                                5.) Photo Upload/फोटो अपलोड <span class="text-danger">*</span>
                                            </label>
                                            <input type="file" class="form-control"  onchange="getfileext11(this,122)" id="File122" name="photo_upload" required>
                                        </div>
                                    </div>


                                </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="subheading">B. Address Details/पते का विवरण</h5>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">1.) Office Address/कार्यालय का पता</label>
                                                    <input type="text" class="form-control" name="office_address" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label>2.) State/राज्य</label>
                                                    <select class="form-select form-control" name="state" required>
                                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">3.) City/शहर </label>
                                                    <select class="form-control" name="district" required>
                                                        <option value="">Select</option>
                                                        @foreach ($district as $item)
                                                        <option value="{{$item->id}}">{{$item->city}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">4.) Pincode/पिन कोड</label>
                                                    <input type="text" class="form-control" name="pin" required>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="subheading">D. Institution /संस्थान</h5>
                                            </div>
                                         
                                            <div class="col-md-3 institutionName">
                                                <div class="form-group mb-3">
                                                    <label>1.) Institution Name/संस्था का नाम</label>
                                                    <input type="text" class="form-control" name="institute_name" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bhoechie-footer">
                                            <div class="row justify-content-center">

                                                <div class="col-md-2 d-grid">
                                                    <button type="reset" class="btn btn-outline-light ">Reset</button>
                                                </div>
                                                <div class="col-md-2 d-grid">
                                                    <button type="submit" class="btn btn-outline-success ">Save and Next</button>
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
</div>
@endsection












@push('custom-scripts')


<script>

$(document).ready(function () {
            $('#sportname').on('change', function () {
                if (this.value == 'other') {
                    $(".othersport").show();
                    $("#other_sportt").prop('required',true);
                }
                else {
                    $(".othersport").hide();
                    $("#other_sportt").prop('required',false);
                }
            });
            $(".othersport").hide();
        });


$("#submitform").submit(function (e) {

    e.preventDefault();
    if ($("#submitform")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {
                    success(res.msg);

                    window.location.href = res.url;


                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#submitform").addClass("was-validated");
    });


function getfileext11(value, id) {


var fileExtension = ["pdf"];
var file_size = value.files[0].size;

var filevalue = value.value;
if (
    $.inArray(filevalue.split(".").pop().toLowerCase(), fileExtension) == -1
) {
    $("#File" + id).val("");
    $("#sign").attr("src", "");
    error("Please Upload File in pdf Format.");
} else if (file_size > 5000000) {
    $("#File" + id).val("");
    $("#sign").attr("src", "");
    error("File Size should not exceed 5MB.");
}

}





    function get_city(value)
         {
            let district3=$("#district3").val();
            let option=`<option value=''>Select City</option>`;
           $.ajax({
            type: "POST",
            url: "{{url('get_city')}}",
            data: {value},

            success: function (response) {
                response.forEach((item)=>{

                      option +=`<option ${item.id == district3 ? 'selected':''} value="${item.id}" >${item.city}</option>`;

                });
                $("#city_id").empty();
                $("#city_id").append(option);
            }
           });
         }



         function getfileext11(value, id) {


var fileExtension = ["jpg","jpeg"];
var file_size = value.files[0].size;

var filevalue = value.value;
if (
    $.inArray(filevalue.split(".").pop().toLowerCase(), fileExtension) == -1
) {
    $("#File" + id).val("");
    $("#sign").attr("src", "");
    error("Please Upload File in JPG/JPEG Format.");
} else if (file_size > 5000000) {
    $("#File" + id).val("");
    $("#sign").attr("src", "");
    error("File Size should not exceed 5MB.");
}

}



    </script>
    @endpush
