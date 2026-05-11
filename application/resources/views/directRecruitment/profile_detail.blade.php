@extends('layouts/layout')
@section('content')

<div class="dashbg">
    <div class="pageheader mb-0">
        <div class="row">
            <div class="col-md-12">
                <h4>Applicant’s Profile
                    @if(Auth::user()->profile_complete > 1)
                    <a href="{{ route('drdashboard') }}" class="btn btn-outline-info backbtn float-end"><span class="icons icon-arrow-left"></span> Dashboard</a>
                    @endif
                </h4>
                <!-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard/डैशबोर्ड
                            </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Applicant’s Profile</li>
                    </ol>
                </nav> -->
            </div>
        </div>
    </div>
    <div class="card mt-3 mb-3">
        <div class="card-body">
            <?php  $iso_detail = isp_common(Auth::id(), Auth::user()->email); ?>
            <form action="{{route('drcompProfile')}}" id="ajxReload" enctype="multipart/form-data" method="post" class="needs-validation" novalidate>
            <input type="hidden" name="app_no" value={{$app_no}}>
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="subheading">Nomination Form for Gazetted Officer  / राजपत्रित अधिकारी हेतु नामांकन</h5>
                    </div>
                    <div class="col-md-12">
                        <h5 class="subheading">A. Basic Details/सामान्य विवरण</h5>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="placeholder">1. Applicant's Full Name/आवेदक का पूरा नाम <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="full_name" value="{{$user->fullname}}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="placeholder">2. Mobile Number/मोबाइल नंबर<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="contact_no" value="{{$user->mobile}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="placeholder">3. Email ID/ईमेल आईडी<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email_id" value="{{$user->email}}" readonly>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <h5 class="subheading">B.Sports Achievements/खेल क्षेत्र में उपलब्धियां<span class="text-danger">*</span></h5>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-bordered" id="sport_event">
                        <tr>
								<td rowspan="2"><label>Sports Competition Name <br>खेलकूद प्रतियोगिता का नाम</label> <span class="text-danger">*</span>
								</td>
								<td rowspan="2"><label>Sport Name<br>खेल का नाम</label> <span class="text-danger">*</span>
								</td>
								<td rowspan="2"><label>Position / Medal<br>पद का नाम / पदक</label> <span class="text-danger">*</span>
								</td>
								<td colspan="2" class="text-center"><label>Period of Competition<br>प्रतियोगिता की अवधि</label> <span class="text-danger">*</span>
								</td>
								<td rowspan="2"><label>Venue Name</br>स्थल का नाम</label> <span class="text-danger">*</span< /td>
								<td rowspan="2"><label>Upload Relevant Certificate<br>प्रासंगिक प्रमाण पत्र अपलोड करें<span class="text-danger">*</span>
									</label>
								</td>
								<td rowspan="2"><label>Sport Event Detail</br>खेलकूद प्रतियोगिता का विवरण<span class="text-danger">*</span></label> </td>
								<td rowspan="2"></td>
							</tr>
							<tr>
								<td><label>From </label>
								</td>
								<td><label>To </label>
								</td>
							</tr>
                            <?php $sele_sport = ""; ?>
                            @foreach($sportAchievement as $item)
                            <?php $sele_sport = $item->sport_name ?>
                            <tr>
                                <td class="form-group">
                                    <input type="text" class="form-control" name="sport_event[]" value="{{sportNEventName($item->sport_event)}}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="sport_name[]" value="{{sport_name($item->sport_name)}}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="medal[]" value="{{$item->medal}}" readonly>
                                </td>
                                <!--  -->
                                <td>
                                    <input type="text" class="form-control" name="competition_from_date[]" value="{{$item->competition_from_date}}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="competition_to_date[]" value="{{$item->competition_to_date}}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="sport_place[]" value="{{$item->sport_place}}" readonly>
                                </td>
                                <td style="text-align:center">
                                    @if($item->sport_achievement_docs !='')
                                        <a  href="{{url('storage/direct_recruitment',$item->sport_achievement_docs)}}" target="_blank">
                                            <!-- <span class="btn btn-success btn-xs"> Uploaded</span> -->
                                            <i class="fa fa-download"></i>
                                        </a>
                                    @else
                                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                    @endif
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="event_details[]" value="{{$item->event_details}}" readonly>
                                </td>
                                <!--  -->
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="col-md-12">
                        <h5 class="subheading">C. Application for Posts/पद हेतु आवेदन कर रहे हैं:<span class="text-danger">*</span></h5>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <table class="table table-bordered" id="dynamic_field">
                                <tr>
                                    <td><b>Preferences/वरीयता</b></td>
                                    <td><b>Post/पोस्ट</b></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="hidden" value={{count($postMaster)}} id="chkk">
                                        <select id="select0" class="form-select preference_select" name="post_type[]" required onchange="pushSelect(this.value)">                                            
                                            <option value="1">Preferences 1</option>                                            
                                        </select>
                                    </td>
                                    <td>
                                        <select id="post0" class="form-select preference_post" onclick="removeSelect(0)" name="post_name[]" required onchange="pushPost(this.value)">
                                            <option value="">Select</option>
                                            @foreach ($postMaster as $mItem)
                                            <option value={{$mItem->id}}>{{$mItem->post_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><button type="button" name="add" id="add" class="btn btn-primary mt-1">Add More</button></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h5 class="subheading"></h5>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category<br>श्रेणी<span class="text-danger">*</span></label>
                            <select required name="category" class="form-select">
                                <option value="">Select</option>
                                <option value="1" {{ old( 'category')==="1" ? 'selected' : '' }}>General</option>
                                <option value="2" {{ old( 'category')==="2" ? 'selected' : '' }}>OBC</option>
                                <option value="3" {{ old( 'category')==="3" ? 'selected' : '' }}>SC</option>
                                <option value="4" {{ old( 'category')==="4" ? 'selected' : '' }}>ST</option>
                                <option value="5" {{ old( 'category')==="5" ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="placeholder">Religion<br>धर्म<span class="text-danger">*</span></label>
                            <select class="form-select" required name="religion">
                                <option value="">Select</option>
                                <option value="Hindu" {{$user->religion=='Hindu'?'Selected':''}}>Hindu</option>
                                <option value="Muslim" {{$user->religion=='Muslim'?'Selected':''}}>Muslim</option>
                                <option value="Christian" {{$user->religion=='Christian'?'Selected':''}}>Christian</option>
                                <option value="Sikh" {{$user->religion=='Sikh'?'Selected':''}}>Sikh</option>
                                <option value="Buddha " {{$user->religion=='Buddha '?'Selected':''}}>Buddha </option>
                                <option value="Jain" {{$user->religion=='Jain'?'Selected':''}}>Jain</option>
                                <option value="Other" {{$user->religion=='Other'?'Selected':''}}>Other</option>
                            </select>
                            <!-- <input type="text" class="form-control" name="religion" value="{{$user->religion}}"> -->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Upload Certificate of Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता का प्रमाणपत्र अपलोड करें<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="file" required name="qualification_doc" class="form-control" onchange="getfileext(this.value,1)" id="File1" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                <input type="hidden" value="{{$user->qualification_doc}}" name="qualification_doc1">

                            </div>
                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Domicile Certificate issued by the Competent Authority<br>सक्षम प्राधिकारी द्वारा जारी किया गया मूल निवास प्रमाण पत्र<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input name="domicile_certificate" type="file" required class="form-control" onchange="getfileext(this.value,3)" id="File3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                <input type="hidden" name="domicile_certificate1" value="{{$user->domicile_certificate}}"> @if($user->domicile_certificate !='')
                                @php $img = url('storage/direct_recruitment').'/'.$user->domicile_certificate; $img1 = url('public/images/view.jpg'); $doc = explode('.',$user->domicile_certificate); @endphp
                                <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" /> @endif
                            </div>
                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                        </div>
                    </div>
                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label>Upload Document Proof for sport achievement<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input name="achievement_doc" type="file" class="form-control" onchange="getfileext(this.value,333)" id="File333" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                <input type="hidden" name="achievement_doc1" value="{{$user->achievement_doc}}"> @if($user->achievement_doc !='')
                                @php $img = url('storage/direct_recruitment').'/'.$user->achievement_doc; $img1 = url('public/images/view.jpg'); $doc = explode('.',$user->achievement_doc); @endphp
                                <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" /> @endif
                            </div>
                            <span class="note">Make a single PDF file correspondently to your all Sport Achievement<br>(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                        </div>
                    </div> --}}

                    <div class="bhoechie-footer">
                        <div class="row justify-content-center">
                            <div class="col-md-3 d-grid">
                                <button type="submit" id="reg-submit" class="btn btn-info">Save & Procced/दर्ज करें व आगे बढ़ें</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

<!-- modal for stock alert -->
<div class="modal fade" id="stock_alert" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content" style=" text-align: center; font-size: x-large; color: red; ">
            <div class="modal-header">
                <a href="{{ route('drsa') }}"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
            </div>
            <div class="modal-body">
                <p> No Post Available</p>
            </div>
        </div>
    </div>
</div>
<!-- end modal for stock alert -->

@push('custom-scripts')
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script type="text/javascript">
    $('.dis_check').attr("style", "pointer-events: none;");

    var aaa = '<?= count($postMaster); ?>';
    if (aaa == 0) {
        $('#stock_alert').modal('show');
        $('#stock_alert').modal({
            backdrop: 'static',
            keyboard: false
        })
    }

    function showMsg() {
        info("Please Complete Your Profile");
    }



    function get_city(value, id) {
        if (value != 23) {
            $("#same").attr("disabled", true);
        } else {
            $("#same").removeAttr("disabled");
        }
        let city = $("#district1").val();
        let same = $("#same").prop('checked') == true;
        let h_city = $("#h_district").val();
        let h_city1 = $("#h_district1").val();
        let h_district12 = $("#h_district12").val();

        let option = `<option value=''>Select City</option>`;
        $.ajax({
            type: "POST",
            url: "{{url('get_city')}}",
            data: {
                value
            },

            success: function(response) {
                response.forEach((item) => {
                    ///setTimeout(() => {
                    if (h_city && id == "district" && $("#same").prop('checked') == false) {
                        option += `<option value="${item.id}" ${item.id==h_city?'selected':''}>${item.city}</option>`;
                    } else if (h_city1 && id == "district1" && $("#same").prop('checked') == false) {
                        option += `<option value="${item.id}" ${item.id==h_city1?'selected':''}>${item.city}</option>`;
                    } else if (city && id == "district") {
                        option += `<option value="${item.id}" ${item.id==city ? 'selected':''}>${item.city}</option>`;
                    } else if (h_district12) {
                        if (item.isp_dist_code == +h_district12) {
                            option += `<option value="${item.id}" selected >${item.city}</option>`;


                        } else {
                            option += `<option value="${item.id}" >${item.city}</option>`;

                        }
                    } else {
                        option += `<option value="${item.id}" >${item.city}</option>`;
                    }
                    ///}, 20)
                });
                $("#" + id).empty();
                $("#" + id).append(option);
            }
        });
    }

    function setoldvalue(element) {
        console.log(this.value);
        element.setAttribute("oldvalue", this.value);
    }

    $("#same").change((e) => {
        if ($("#same").is(":checked")) {
            let address1 = $("#address1").val();
            let district1 = $("#district1").val();
            let state = $("#state1").val();
            let permanent_pincode = $("#present_pincode").val();
            $("#state").val(state);
            $("#permanent_address").val(address1);
            $("#permanent_pincode").val(permanent_pincode);
            $('#state').trigger('change');
            $("#district").val(district1);
            $('.dis_check').attr("style", "pointer-events: none;");
        } else {
            $("#permanent_address").val('');
            $("#state").val('');
            $("#district").val('');
            $("#permanent_pincode").val('');
            $('.dis_check').attr("style", "");

        }
    })
    var start = (new Date()).getFullYear() - 100;
    var end = (new Date()).getFullYear() - 18;
    var yrRange = start + ":" + end;
    $("#dob").datepicker({
        changeMonth: true,
        changeYear: true,
        minDate: '-60Y',
        yearRange: yrRange,
        dateFormat: 'dd/mm/yy',
        maxDate: '-18Y'
    });

    // $("#dob").datepicker({
    //     changeMonth: true,
    //     changeYear: true,
    //     yearRange: '1960:3025',
    //     minDate: '-60Y',
    //     dateFormat: 'dd/mm/yy',
    //     maxDate: '-18Y'
    // });
</script>


<script>
    var selectOption = '<option value="">Select</option>';
    var postOption = '<option value="">Select</option>';
</script>
<!-- @foreach ($selectMaster as $key=>$sItem)
<script>
    selectOption += '<option value="{{$sItem->name}}">{{$key}}</option>';
</script>
@endforeach -->
@foreach ($postMaster as $key=>$pItem)
<script>
    selectOption += '<option value="{{$key + 1}}">Preferences {{$key +1 }}</option>';
    postOption += '<option value="{{$pItem->id}}">{{$pItem->post_name}}</option>';
</script>
@endforeach

<script>
    $("#doc").datepicker({
        changeMonth: true,
        changeYear: true,
        minDate: '-60Y',
        yearRange: "-100:+0",
        maxDate: '0',
        dateFormat: 'dd/mm/yy'
    });


    var selectOptionJsonArray = [];
    var postOptionJsonArray = [];
    var ck = 2;



    //data remove

    function add_more() {

        var i = 11;

        // if($('#chkk').val() < ck)
        // {
        //     return false;
        // }
        // $(".preference_select option").removeAttr("disabled");
        // $(".preference_post option").removeAttr("disabled");

        i++;
        ij++;
        ck++;

        // $('#dynamic_field').append('<tr id="row' + i + '"><td><select onchange="pushSelect(this.value)" id="select' + i + '" required name="post_type[]" class="form-select preference_select" class="form-control name_list"><option value="{{$key + 1}}">Prefrences {{$key +1 }}</option></select></td><td><select onchange="pushPost(this.value)" id="post' + i + '" class="form-select preference_post" name="post_name[]" required >' + postOption + '</select></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove" onclick="removeSelectOption(' + i + ')">X</button></td></tr>');
        $('#dynamic_field').append('<tr id="row' + i + '"><td><select onchange="pushSelect(this.value)" id="select' + i + '" required name="post_type[]" class="form-select preference_select" class="form-control name_list">' + selectOption + '</select></td><td><select onchange="pushPost(this.value)" id="post' + i + '" class="form-select preference_post" name="post_name[]" required >' + postOption + '</select></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger mt-1 px-2 btn_remove" onclick="removeSelectOption(' + i + ')"><span class="far fa-trash-alt"></span></button></td></tr>');

        // $(".preference_select").attr("style", "pointer-events: none;background-image: none");
        // $(".preference_select").attr("style", "background-image: none;");

    }

    function removeSelect(i) {

        var post = $("#post" + i).val();
        // console.log(postOptionJsonArray)
        $.each(postOptionJsonArray, function(index, dataPost) {
            console.log(dataPost)
            if (dataPost == post) {
                console.log(dataPost)
                postOptionJsonArray.splice($.inArray(post, postOptionJsonArray), 1);
                $(".preference_post option").removeAttr("disabled");
            }
        });
        // postOptionJsonArray = postOptionJsonArray.filter((item, i, ar) => ar.indexOf(item) === i);
        // postOptionJsonArray.splice($.inArray(post, postOptionJsonArray), 1);
        // $(".preference_select option").removeAttr("disabled");
        // $(".preference_post option").removeAttr("disabled");

        // setTimeout(() => {
        //     disabledAttrApply();
        // }, 350);
    }
    $(document).ready(function() {
        // $(".preference_select").attr("style", "pointer-events: none;background-image: none");
        var i = 20;
		var ij = 2;
        var length;
        var length;

// $.each(selectOptionJson, function(index, data) {
//     selectOptionJsonArray.push(data);
// });
// $.each(postOptionJson, function(index, dataPost) {
//     postOptionJsonArray.push(dataPost);
// });
        $("#add").click(function() {
            if($('#chkk').val() < ck)
            {
                return false;
            }

            // $(".preference_select option").removeAttr("disabled");
            // $(".preference_post option").removeAttr("disabled");

            i++;
			ij++;
			ck++;
			$('#dynamic_field').append('<tr id="row' + i + '"><td><select onchange="pushSelect(this.value)" id="select' + i + '" required name="post_type[]" class="form-select preference_select" class="form-control name_list">' + selectOption + '</select></td><td><select onchange="pushPost(this.value)" id="post' + i + '" class="form-select preference_post" name="post_name[]" required >' + postOption + '</select></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove mt-1 px-2" onclick="removeSelectOption(' + i + ')"><span class="far fa-trash-alt"></span></button></td></tr>'); // $(".preference_select").attr("style", "pointer-events: none;background-image: none");


        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

        $("#submit").on('click', function(event) {
            var formdata = $("#add_name").serialize();
            event.preventDefault()
        });

        //new column add
        $("#association_certificate").on('change', function() {
            if (this.value == "1") {

                $("#association_certificate_upload").attr('required', true);
            } else {
                $("#association_certificate_upload").attr('required', false);
            }

        });




    });




    function pushPost(value) {
        if (value != '') {
            postOptionJsonArray.push(value);

        }
    }

    function pushSelect(value) {
        if (value != '') {
            selectOptionJsonArray.push(value);

        }
    }

    // $('.preference_post').live('focus', function(){
    //     console.log($(this).attr('oldValue',$(this).val()));
    // });
    function removeSelectOption(i) {

        var post = $("#post" + i).val();
        postOptionJsonArray = postOptionJsonArray.filter((item, i, ar) => ar.indexOf(item) === i);
        postOptionJsonArray.splice($.inArray(post, postOptionJsonArray), 1);

        var select = $("#select" + i).val();
        selectOptionJsonArray = selectOptionJsonArray.filter((item, i, ar) => ar.indexOf(item) === i);
        selectOptionJsonArray.splice($.inArray(select, selectOptionJsonArray), 1);

        $(".preference_select option").removeAttr("disabled");
        $(".preference_post option").removeAttr("disabled");

        ck--;
    }


    $(document.body).on('change', '.preference_post', function() {
        var selecteditem = $(this);
        $('.preference_post').each(function(index, value) {
            var item = $(this);
            if (item.val() != '' && (!selecteditem.is(item))) {
                if (item.val() === selecteditem.val()) {
                    // console.log("cat.val()" + cat.val())
                    // console.log("selectedcat.val()" + selectedcat.val())
                    // console.log("item.val()" + item.val())
                    // console.log("selecteditem.val()" + selecteditem.val())

                    selecteditem.val("");
                    alert("Post Already Selected");
                    return false;
                }
            }
        });
    });
    
	$(document.body).on('change', '.preference_select', function() {
		var selecteditem = $(this);
		$('.preference_select').each(function(index, value) {
			var item = $(this);
			if (item.val() != '' && (!selecteditem.is(item))) {
				if (item.val() === selecteditem.val()) {
					selecteditem.val("");
					alert("Preference Already Selected");
					return false;
				}
			}
		});


	});
</script>
@endpush
