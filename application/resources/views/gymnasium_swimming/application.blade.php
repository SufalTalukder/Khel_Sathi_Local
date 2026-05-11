@extends( 'layouts\gymnasium_swimming_dashboard' )
@section('content')

<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        Application Form  @isset($summary) @if ($summary) <a href="{{ route('gymnasium_swimming_dashboard') }}"
                                            class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill"><span class="icons icon-arrow-left"></span>Back to Dashboard</a>  @endif @endisset
                    </h4>
                </div>
            </div>
            <div class="col-12">
                <div class="bhoechie-tab-container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
                            <div class="bhoechie-tab-content active">
                                <div class="form-scroll">
                                <form action="{{ route('gymnasium_swimming_applicationBasicForm') }}" id="formSubmit" method="post" class="needs-validation" novalidate enctype="multipart/form-data" >
                                    @csrf
                                    <div class="nano-content">
                                        <div class="row">
                                            <div class="col-12">
                                                <fieldset>
                                                    <legend>Registration Details</legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">Registering as <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" value="@if (Auth::guard('GymnasiumSwimming')->user()->type == 1) Gymnasium @else Swimming Pool @endif" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">Applicant Full Name <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" value="{{ Auth::guard('GymnasiumSwimming')->user()->name }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">Date of Birth <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control datepicker-here" value="{{ dmy( Auth::guard('GymnasiumSwimming')->user()->dob) }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">Gender <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" value="@if (Auth::guard('GymnasiumSwimming')->user()->gender == 1) Male @else Female @endif" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">Email ID <span class="text-danger">*</span></label>
                                                                <input type="email" class="form-control" value="{{ Auth::guard('GymnasiumSwimming')->user()->email }}" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">Mobile Number <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" value="{{ Auth::guard('GymnasiumSwimming')->user()->mobile }}" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-7">


                                                    <fieldset>
                                                    <legend>Applicant Details</legend>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">Father Name <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="father_name"  value="{{ isset($summary)  ? $summary->father_name : old('father_name')  }}" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$"  maxlength="255" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">Nationality <span class="text-danger">*</span></label>
                                                                <select class="form-control form-select" name="nationality" required>
                                                                    <option value="">Select</option>
                                                                    <option value="Indian" selected >Indian</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">Aadhar Number <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" value="{{ isset($summary)  ? $summary->aadhar : old('aadhar')  }}" name="aadhar" required  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  pattern="[0-9]{12}" maxlength="12" minlength="12">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label>Religion <span class="text-danger">*</span></label>
                                                                <select class="form-select form-control"  name="religion" required>
                                                                    <option value="">Select</option>
                                                                    <option value="Hinduism" {{ old('religion') == 'Hinduism' ? 'selected' : '' }}  @isset($summary) @if ($summary->religion == 'Hinduism') selected @endif @endisset>Hinduism</option>
                                                                    <option value="Christianity" {{ old('religion') == 'Christianity' ? 'selected' : '' }}  @isset($summary) @if ($summary->religion == 'Christianity') selected @endif @endisset>Christianity</option>
                                                                    <option value="Buddhism" {{ old('religion') == 'Buddhism' ? 'selected' : '' }}  @isset($summary) @if ($summary->religion == 'Buddhism') selected @endif @endisset>Buddhism</option>
                                                                    <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}  @isset($summary) @if ($summary->religion == 'Islam') selected @endif @endisset>Islam</option>
                                                                    <option value="Sikhism" {{ old('religion') == 'Sikhism' ? 'selected' : '' }}  @isset($summary) @if ($summary->religion == 'Sikhism') selected @endif @endisset>Sikhism</option>

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">Vehicle Number</label>
                                                                <input type="text" class="form-control" value="{{ isset($summary)  ? $summary->vehicle_no : old('vehicle_no')  }}" name="vehicle_no" pattern="^[A-Z]{2}\s[0-9]{2}\s[A-Z]{2}\s[0-9]{4}$">
                                                            </div>
                                                        </div>



                                                        <div class="col-md-6">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">Blood Group <span class="text-danger">*</span></label>
                                                                <select class="form-control form-select" name="blood_group" required>
                                                                    <option value="">select</option>
                                                                    <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}  @isset($summary) @if ($summary->blood_group == 'A+') selected @endif @endisset>A+</option>
                                                                    <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}  @isset($summary) @if ($summary->blood_group == 'A-') selected @endif @endisset>A-</option>
                                                                    <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}  @isset($summary) @if ($summary->blood_group == 'B+') selected @endif @endisset>B+</option>
                                                                    <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}  @isset($summary) @if ($summary->blood_group == 'B-') selected @endif @endisset>B-</option>
                                                                    <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}  @isset($summary) @if ($summary->blood_group == 'AB+') selected @endif @endisset>AB+</option>
                                                                    <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}  @isset($summary) @if ($summary->blood_group == 'AB-') selected @endif @endisset>AB-</option>
                                                                    <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}  @isset($summary) @if ($summary->blood_group == 'O+') selected @endif @endisset>O+</option>
                                                                    <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}  @isset($summary) @if ($summary->blood_group == 'O-') selected @endif @endisset>O-</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-5">
                                                <fieldset>
                                                    <legend>Upload</legend>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Profile Picture  <span class="text-danger">*</span></label>

                                                                @isset($summary) @if ($summary->profile_picture)
                                                                <div class="profpic">
                                                                    <img src="{{ asset('gymnasium_swimming/profile_picture/')}}/{{$summary->profile_picture}}" class="img-fluid" >
                                                                </div>
                                                                @endif @endisset
                                                                <input type="file" class="form-control"  name="profile_picture"   {{isset($summary->profile_picture) ? '' : 'required'}} onchange="getfileextt2(this,'T3')" id="FileT3">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Signature  <span class="text-danger">*</span></label>
                                                                @isset($summary) @if ($summary->signature)
                                                                <div class="sign">
                                                                    <img src="{{ asset('gymnasium_swimming/signature/')}}/{{$summary->signature}}" class="img-fluid" >
                                                                </div>
                                                                @endif @endisset
                                                                <input type="file" class="form-control" onchange="getfileextt2(this,'T4')" id="FileT4" name="signature" {{isset($summary->signature) ? '' : 'required'}}>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-12">
                                                <fieldset>
                                                    <legend>Communication</legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">Address <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" value="{{ isset($summary)  ? $summary->address : old('address')  }}" name="address" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">District <span class="text-danger">*</span></label>
                                                                <select class="form-control form-select" name="district_id" required>
                                                                    <option value="">Select</option>
                                                                    @foreach ($districts as $item)
                                                                    <option value="{{$item->id}}"  {{ old('district_id') == $item->id ? 'selected' : '' }}  @isset($summary) @if ($summary->district_id == $item->id ) selected @endif @endisset>{{ $item->city }}</option>
                                                                    @endforeach


                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">Pincode<span class="text-danger">*</span></label>
                                                                <input type="number" class="form-control" value="{{ isset($summary)  ? $summary->pin_code : old('pin_code')  }}" name="pin_code" min="100000" max="999999" maxlength="6"  required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>


                                            <div class="col-12">
                                                    <fieldset>
                                                        <legend>Award Details</legend>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Award Name </label>
                                                                    <input type="text" class="form-control" id="aw" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label>Upload File</label>
                                                                    <input type="file" id="awardImage" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group d-grid">
                                                                    <label>&nbsp;</label>
                                                                    <a href="javascript:void(0)"  onclick="award()" class="btn btn-success btn-sm" title="Add Award Detail"><i class="fa fa-plus"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12" id="add_style_award" data-award="{{ $award->count() }}">
                                                                <div class="table-responsive">
                                                                    <table class="table awardtable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="width:7%">S.No.</th>
                                                                                <th>Award Name</th>
                                                                                <th style="width:10%">Upload</th>
                                                                                <th style="width:7%"></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ( $award as $key=>$item)
                                                                            <tr>
                                                                                <td>{{ $key + 1 }}</td>
                                                                                <td>{{ $item->award }}</td>
                                                                                <td><a href="{{url('public/gymnasium_swimming/award')."/".$item->upload_file }}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i></a></td>
                                                                                 <td class="text-center"><a href="javascript:void(0)" id="deleteaward{{$item->id}}" onclick="deleteItemAward({{$item->id}})" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a></td>

                                                                            </tr>
                                                                            @endforeach

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="bhoechie-footer">
                                            <div class="row justify-content-center">
                                                <div class="col-md-2 d-grid">
                                                    <button type="reset" class="btn btn-outline-info rounded-pill">Back</button>
                                                </div>
                                                {{-- <div class="col-md-2 d-grid">
                                                    <button type="reset" class="btn btn-outline-light rounded-pill">Reset</button>
                                                </div> --}}
                                                <div class="col-md-2 d-grid">
                                                    <button id="player_coachFinal"  class="btn btn-outline-danger rounded-pill">Save and Next</button>
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
</div>

@endsection
@push('custom-scripts')
<script>
    $(document).ready(function() {


        var countaward = $('#add_style_award').data( 'award' );
        if(countaward > 0){
            $('#add_style_award').css('display', 'block');
        }else{
            $('#add_style_award').css('display', 'none');
        }

    });

$("#formSubmit").submit(function (e) {
    var content = document.createElement('div');
          content.innerHTML = '<h3>Please add awards Detail.</h3>';

          var countaward = $('#add_style_award').attr('data-award' );
e.preventDefault();
if ($("#formSubmit")[0].checkValidity() === false) {
    e.stopPropagation();
}else if (countaward == 0) {
    swal(content, {

});
    return false;
}
else {
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
$("#formSubmit").addClass("was-validated");
});


    //       var content = document.createElement('div');
    //       content.innerHTML = '<h3>Please add awards Detail.</h3>';

    //       var countaward = $('#add_style_award').attr('data-award' );

    //       if( countaward > 0){
    //         if ($(".query_form_marked")[0].checkValidity() === false) {
    //     e.stopPropagation();
    //       }else{
    //        $('#formSubmit').submit();
    //      }

    //       }
    //       else
    //       swal(content, {

    //       });
    //           return false;
    //   });


function getfileextt2(value, id) {


var fileExtension = ["jpeg", "jpg"];
var file_size = value.files[0].size;
var filevalue = value.value;
if (
    $.inArray(filevalue.split(".").pop().toLowerCase(), fileExtension) == -1
) {
    $("#File" + id).val("");
    $("#photo").attr("src", "");
    error("Please Upload File in Valid Format.");
} else if (file_size > 10000000) {
    $("#File" + id).val("");
    $("#photo").attr("src", "");
    error("File Size should not exceed 10 MB.");
} else {
    if (value.files && value.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $("#photo").css("display", "inline-block");
            $("#photo").attr("src", e.target.result);
        };

        reader.readAsDataURL(value.files[0]);
    }
}
}

</script>
<script>




 function deleteItemAward(id) {



$.ajax( {
            type: "GET",
            url: ajaxUrl +"/gymnasium_swimming/awarddelete/"+id,
            dataType: "text",
            success: function(res) {
                var result = (JSON.parse(res));
                // console.log(res['count']);
                $('#add_style_award').attr( 'data-award',result.count );
                if(result.count > 0){

               $('#add_style_award').css('display', 'block');
                 }else{
                  $('#add_style_award').css('display', 'none');
                 }
                success( result.msg );
            },
        } );
 $(`#deleteaward${id}`).parent().parent().remove();
}





    function award(){
    var image = $("#awardImage").prop('files')[0];
    var aw = $("#aw").val();
    var formData = new FormData();

    formData.append('upload_file', image);
    formData.append('award', aw);


        $.ajax({
                url : ajaxUrl +"/gymnasium_swimming/awardStore",
                type : "POST",
                data : formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                dataType:'json',
                processData: false,
                success: function (res) {
               if (res.error == false) {



                $('#add_style_award').css('display', 'block');

          $( '.awardtable tbody' ).empty();
          $('#add_style_award').attr( 'data-award', res.dataQual.length );

                            $.each( res.dataQual, function ( key, value ) {
                                $( '.awardtable tbody' ).append(
                                    `<tr><td>${key + 1 }</td><td>${value.award} </td><td><a href="${ajaxUrl}/public/gymnasium_swimming/award/${value.upload_file}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i></a></td><td class="text-center"><a href="javascript:void(0)" id="deleteaward${value.id}" onclick="deleteItemAward(${value.id})" class="btn btn-danger btn-xs deleteList"><i class="fa fa-trash-alt"></i></a></td></tr>` );
                            } );
                            $("#aw").val("");
                             $("#awardImage").val("");
                            // $("#qual").reset();
                success(res.msg);

            } else {
                error(res.msg);
            }
        },


            })
    }

</script>


@endpush
