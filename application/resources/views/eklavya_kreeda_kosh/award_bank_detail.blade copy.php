@extends( 'layouts\eklavya_kreeda_kosh_dashboard_layout' )
@section('content')

<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        Application Form/आवेदन फार्म
                        <a href="{{ route('eklavya_kreeda_kosh_dashboard') }}"
                            class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill"><span
                                class="icons icon-arrow-left"></span>Back to Dashboard</a>
                    </h4>
                </div>
            </div>
            <div class="col-12">
                <div class="bhoechie-tab-content">
                    <div class="form-scroll">
                        <div class="nano-content">
                            <div class="row">
                                <div class="col-12">

                                    <form action="{{ route('eklavya_kreeda_kosh_awardStore') }}"id="eklaward" method="post" class="needs-validation" novalidate enctype="multipart/form-data" >
                                        @csrf
                                    <fieldset class="position-relative">
                                        <legend>Awards & Achievements/पुरस्कार बैंक विवरण</legend>
                                        <div class="row">



                                            <div class="col-md-2">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">1. Sports Level
                                                        /<br>खेल स्तर<span class="text-danger">*</span></label>
                                                    <select class="form-control form-select" name="sport_level" id="sport_level" required>
                                                        <option value="" >Select</option>
                                                        <option value="National">National</option>
                                                        <option value="International">International
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">2. Sport Name
                                                        /<br>खेल का नाम<span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control form-select "  name="sport" id="sport">
                                                        <option value="" >Select</option>
                                                        @foreach ($sports as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">3. Championship
                                                        Name/<br>चैंपियनशिप नाम
                                                      <span class="text-danger">*</span></label>
                                                    <input type="text" name="award" class="form-control"  name="award" id="award" >
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">4. Championship
                                                        Date/<br>चैम्पियनशिप तिथि

                                                      <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control"  name="champion_date" id="champion_date">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">4. Association Approved Certificate
                                                        /<br>एसोसिएशन द्वारा अनुमोदित प्रमाणपत्र
                                                      <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="file" id="formFile" name="upload_file" id="upload_file" >
                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">&nbsp;<br><br></label>
                                                    <button type="submit" class="btn plus"><i
                                                            class="fas fa-plus"></i></button>

                                                </div>
                                            </div>

                                        </div>


                                        <div class="row">
                                        <div class="col-md-12" id="add_style_award" data-award="{{$award->count() }}">

                                            <table class="table table-bordered table-sm awardtable">
                                                <thead>
                                                  <tr style="background-color: #dfdacd;">
                                                    <th style="width:5%">S.No.</th>
                                                    <th style="width:18%">Sports Level</th>
                                                    <th style="width:18%">Sport Name</th>
                                                    <th style="width:18%">Championship Name</th>
                                                    <th style="width:9%">Championship Date</th>
                                                    <th style="width:8%">Document</th>
                                                    <th style="width:8%">Action</th>
                                                  </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($award as $key=>$item)


                                                  <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->sport_level }}</td>
                                                    <td>{{ sport_name($item->sport_id) }}</td>
                                                    <td>{{ $item->award }}</td>
                                                    <td>{{ $item->champion_date	 }}</td>

                                                    <td>
                                                        <a href="{{ asset('/public/eklavya_krida_kosh/award/')}}/{{$item->upload_file}}" target="_blank"class="btn btn-success btn-xs"><i class="fa fa-download"></i></a>
                                                    </td>
                                                       <td><a href="javascript:void(0)" class="btn btn-danger btn-xs"  id="deleteaward{{$item->id}}" onclick="deleteItemAward({{$item->id}})"><i class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                  </tr>
                                                  @endforeach

                                                </tbody>
                                              </table>


                                            </div>
                                        </div>

                                    </fieldset>
                                </form>
                                </div>

                                <div class="col-md-12">

                                    <form action="{{ route('eklavya_kreeda_kosh_bank_detail_store') }}"id="formsubmit" method="POST" class="needs-validation" novalidate  enctype="multipart/form-data" >
                                    <fieldset>
                                        <legend>Account Information/खाता संबंधी जानकारी



                                        </legend>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">1. Bank Name/बैंक का नाम
                                                      <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$"  maxlength="255" value="{{ isset($summary)  ? $summary->bank_name : old('bank_name')  }}"  required name="bank_name"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">2. IFSC Code/आईएफएससी कोड
                                                      <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" required pattern="^[A-Za-z]{4}0[A-Z0-9a-z]{6}$" name="ifsc_code" value="{{ isset($summary)  ? $summary->ifsc_code : old('ifsc_code')  }}" />
                                                </div>
                                            </div>




                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">3. Bank Account Number
                                                        /बैंक खाता संख्या
                                                      <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" min="999999999" max="100000000000000000000" required name="account_no" value="{{ isset($summary)  ? $summary->account_no : old('account_no')  }}" />

                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">4. Front page of Passbook
                                                        /पासबुक का फ्रंट पेज
                                                      <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="file" id="formFile" {{ isset($summary->front_page_of_passbook)  ? '': 'required'  }} name="front_page_of_passbook">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="bhoechie-footer">
                                            <div class="row justify-content-center">
                                                <div class="col-md-2">

                                                    <a href="{{route('eklavya_kreeda_kosh_application') }}"
                                                        class="btn btn-outline-info rounded-pill w-100">Back</a>
                                                </div>

                                                <div class="col-md-2">
                                                    <button type="submit"
                                                        class="btn btn-outline-danger rounded-pill w-100">Save & Proceed</button>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
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
$("#eklaward").submit(function (e) {

    e.preventDefault();
    if ($("#eklaward")[0].checkValidity() === false) {
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


                $('#add_style_award').css('display', 'block');

                 $( '.awardtable tbody' ).empty();
          $('#add_style_award').attr( 'data-award', res.dataQual.length );

                  $.each( res.dataQual, function ( key, value ) {
                      $( '.awardtable tbody' ).append(

                          `<tr><td>${key + 1 }</td><td>${value.sport_level} </td><td>${value.name}</td><td>${value.award}</td><td>${value.champion_date}</td><td><a href="${ajaxUrl}/public/eklavya_krida_kosh/award/${value.upload_file}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-download"></i></a></td><td><a href="javascript:void(0)" id="deleteaward${value.id}" onclick="deleteItemAward(${value.id})" class="btn btn-danger btn-xs deleteList"><i class="fa fa-trash-alt"></i></a></td></tr>` );
                  } );



                 $('#sport_level').val();



                } else {
                    error(res.msg);
                }
            },
        });
    }

    $("#eklaward")[0].reset();
    });
    $("#formsubmit").submit(function (e) {
    var content = document.createElement('div');
          content.innerHTML = '<h3>Please add awards Detail.</h3>';

          var countaward = $('#add_style_award').attr('data-award' );
e.preventDefault();
if ($("#formsubmit")[0].checkValidity() === false) {
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
$("#formsubmit").addClass("was-validated");
});


function deleteItemAward(id) {



$.ajax( {
            type: "GET",
            url: ajaxUrl +"/eklavya_kreeda_kosh/awarddelete/"+id,
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

    </script>
    @endpush
