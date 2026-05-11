@extends('layouts/layout')
@section('content')
<div class="dashbg">
    <div class="pageheader mb-0">
        <div class="row">
            <div class="col-md-12">
                <h4>
                    Sport Achievement 
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-info btn-sm backbtn float-end">
                        <span class="icons icon-arrow-left"></span>Back/पीछे
                    </a>
                    <a href="{{ route('drsa') }}" class="btn btn-outline-success btn-sm backbtn float-end">Sport Achievement</a>
                    @if(Auth::user()->profile_complete > 0)
                    <a href="{{ route('profile') }}" class="btn btn-outline-success backbtn btn-sm float-end">Applicant’s Profile</a>
                    @endif
                </h4>
            </div>
        </div>
    </div>
    <div class="card mt-3 mb-3">
        <div class="card-body">
            @if(Auth::user()->profile_complete > 1)
            <style>
                .chkk {
                    pointer-events: none;
                }
            </style>
            @endif
            <div class="bhoechie-tab-container">
                <form action="{{route('drSaveAchievement')}}" id="post_detail" enctype="multipart/form-data" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-scroll">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="subheading">Nomination Form for Gazetted Officer  / राजपत्रित अधिकारी हेतु नामांकन</h5>
                            </div>
                            <div class="col-md-12">
                                <h5 class="subheading">A. Basic Details/सामान्य विवरण</h5>
                            </div>
                            <div class="col-md-4">
                            <input type="hidden" class="form-control"  value="{{$user->dob}}" id="dob">

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
                                <div class="form-group">
                                    <table  class="table table-bordered" id="sport_event">
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
                                        <td rowspan="2"><label>Upload Relevant Certificate<br>प्रासंगिक प्रमाण पत्र अपलोड करें<span class="text-danger">*</span><br><span class="note">(File Format/फाइल का प्रारूप: JPEG/JPG/PDF | Max File Size/फाइल का अधिकतम साइज़: 2 MB)</span>
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
                                        @if(isset($sportAchievement) && count($sportAchievement)>0)
                                        @foreach($sportAchievement as $key=>$item)
                                        @php $chkk=$key;@endphp
                                        <tr id="row{{$key}}">
                                            <td class="form-group">
                                                <select id="sport_event0" class="form-select chkk s_event_name" onchange="pushSportEvent(this.value,0)" name="sport_event[]" required>
                                                    <option value="">-- Select --</option>
                                                    @foreach($sport_event as $Item)
                                                    <option value="{{$Item->id}}" {{ $item->sport_event === $Item->id ? 'selected' : '' }}>{{$Item->event_name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select chkk" name="sport_name[]" required>
                                                    <option value="">-- Select --</option>
                                                    @foreach ($sport_list as $type)
                                                    <option value="{{$type->id}}" {{ $item->sport_name === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select id="medal0" class="form-select chkk" name="medal[]" onchange="pushSportMedal(this.value,0)" required>
                                                    <option value="">-- Select --</option>
                                                    <option value="Gold" {{ $item->medal === "Gold" ? 'selected' : '' }}>Gold</option>
                                                    <option value="Silver" {{ $item->medal === "Silver" ? 'selected' : '' }}>Silver</option>
                                                    <option value="Bronze" {{ $item->medal === "Bronze" ? 'selected' : '' }}>Bronze</option>
                                                </select>
                                            </td>
                                            <td style="width: 120px;">
														<input type="text" class="form-control drDate" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="dooc" autocomplete="off" required value="{{old('competition_from_date')}}" name="competition_from_date[]" data-language="en" placeholder="dd-mm-yyyy" required>
													</td>
													<td style="width: 120px;"><input type="text" class="form-control drDate" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="too" autocomplete="off" required value="{{old('competition_to_date')}}" name="competition_to_date[]" data-language="en" placeholder="dd-mm-yyyy" required>
													</td>
                                            <!-- <td>
                                            <textarea class="form-control chkk" rows="1" required name="event_details[]">{{($item->event_details)}}</textarea>
                                             </td> -->
                                            <td>
                                                <input type="text" class="form-control drDate chkk" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="doc{{$key}}" autocomplete="off" required value="{{dmy($item->competition_date)}}" name="competition_date[]" data-language="en" placeholder="dd-mm-yyYY" >
                                            </td>
                                            <td>
                                                <button type="button" name="add" id="add_award" class="btn btn-primary mt-1">Add</button>
											</td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="form-group">
                                                <select id="sport_event0" class="form-select s_event_name" onchange="pushSportEvent(this.value,0)" name="sport_event[]" required>
                                                    <option value="">-- Select --</option>
                                                    @foreach($sport_event as $Item)
                                                    <option value="{{$Item->id}}">{{$Item->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select style="pointer-events: none !important;" class="form-select" name="sport_name[]" required>
                                                    <option value="">-- Select --</option>
                                                    @foreach ($sport_list as $type)
                                                    <option value="{{$type->id}}" {{ Auth::user()->sport_type === $type->id ? 'selected' : '' }} {{ old('sport_type') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select id="medal0" class="form-select" name="medal[]" onchange="pushSportMedal(this.value,0)" required>
                                                    <option value="">-- Select --</option>
                                                    <option value="Gold">Gold</option>
                                                    <option value="Silver">Silver</option>
                                                    <option value="Bronze">Bronze</option>
                                                </select>
                                            </td>
                                            <!-- <td>
                                                <textarea class="form-control chkk" rows="1" required name="event_details[]">{{old('event_detail')}}</textarea>
                                            </td> -->
                                            <td style="width: 120px;">
												<input type="text" class="form-control firstDate drDate" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="doc0" onchange="checkDate(0)" autocomplete="off" required value="{{old('competition_from_date')}}" name="competition_from_date[]" data-language="en" placeholder="dd-mm-yyyy" required>
                                            </td>
                                            <td style="width: 120px;"><input type="text" class="form-control drDate" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="0to"  onchange="checkDate(0)" autocomplete="off" required value="{{old('competition_to_date')}}" name="competition_to_date[]" data-language="en" placeholder="dd-mm-yyyy" required>
                                            </td>
                                            <td>
                                            <input type="text" required value="{{old('sport_place') }}" name="sport_place[]" placeholder="Place" class="form-control name_email">
                                                <!-- <input type="text" class="form-control dateTime" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="doc" autocomplete="off" required value="{{old('competition_date')}}" name="competition_date[]" data-language="en" placeholder="dd-mm-yyYY" required> -->
                                            </td>
                                            <td>
                                                <input type="file" required name="sport_achievement_docs[]" class="form-control" onchange="getfileext(this.value,3)" id="File3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                            </td>
													<td><input type="text" required value="{{old('event_detail') }}" name="event_details[]" placeholder="Sport Event Detail" class="form-control"></td>
                                            <td>
                                                <button type="button" name="add" id="add_award" class="btn btn-primary mt-1">Add</button>
											</td>
                                        </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>
                            @if(Auth::user()->profile_complete != 2)
                            <div class="bhoechie-footer">
                                <div class="row justify-content-center">
                                    <div class="col-md-3 d-grid">
                                        <button type="submit" id="reg-submit" class="btn btn-info">Save & Procced/दर्ज करें व आगे बढ़ें</button>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="bhoechie-footer">
                                <div class="row justify-content-center">
                                    <div class="col-md-3 d-grid">
                                        <a href="{{ route('drcp') }}" class="btn btn-info">Next</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection
<div class="modal fade" id="post_view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Available Post</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" id="post_details">


            </div>
            <div class="modal-footer justify-content-md-center">
                <div class="col-4 d-grid">
                    <a class="btn btn-info"  id="lock" href="Javascript:void(0)">Proceed</a>
                </div>

            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
<script type="text/javascript">
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };
</script>
<script>

var start = $("#dob").val();
			var end = (new Date()).getFullYear();
			var yrRange = (new Date(start)).getFullYear() + ":" + end;
			var checkkk = 0;
			$(".drDate").datepicker({
				changeMonth: true,
				changeYear: true,
				// minDate: '-60Y',
				minDate: new Date(start, 4 - 1, 1),
				yearRange: yrRange,
				maxDate: '0',
				dateFormat: 'dd-mm-yy'
			});
   
    var i = 1;
    var ck = 1;
    $("#add_award").click(function() {

        i++;
        $('#sport_event').append('<tr id="row' + i + '"> <td class="form-group"><select id="sport_event' + i + '" class="form-select s_event_name" name="sport_event[]"  onchange="pushSportEvent(this.value,' + i + ')" required ><option value="">-- Select --</option>@foreach($sport_event as $Item)<option value="{{$Item->id}}">{{$Item->name}}</option>@endforeach </select></td> <td> <select class="form-select" style="pointer-events: none !important;" name="sport_name[]" required>  <option value="">-- Select --</option> @foreach ($sport_list as $type) <option {{ $selected_sport==$type->id ? 'selected' : '' }}  value="{{$type->id}}"  >{{$type->name}}</option> @endforeach </select></td><td><select id="medal' + i + '" class="form-select" onchange="pushSportMedal(this.value,' + i + ')" name="medal[]" required  ><option value="">-- Select --</option> <option value="Gold">Gold</option><option value="Silver">Silver</option><option value="Bronze">Bronze</option></select></td>  <td><input type="text" onchange="checkDate('+i+')" class="form-control firstDate drDate" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="doc' + i + '" autocomplete="off" required value="" onchange="checkDate('+i+')" onchange="getfileext('+i+')"  name="competition_from_date[]" data-language="en" placeholder="dd-mm-yyyy" required></td><td><input type="text" class="form-control drDate" onchange="checkDate('+i+')" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="' + i + 'to" autocomplete="off" required value=""  name="competition_to_date[]" data-language="en" placeholder="dd-mm-yyyy" required></td><td><input type="text" required value="" name="sport_place[]" placeholder="Place" class="form-control name_email"></td><td><input type="file" name="sport_achievement_docs[]" required class="form-control"   onchange="getfileext(this.value,2' + i + ')" id="File2' + i + '" aria-describedby="inputGroupFileAddon05" aria-label="Upload"></td><td><input type="text" required value="" name="event_details[]" placeholder="Sport Event Detail" class="form-control"></td><td><button type="button" name="remove"  onclick="removeSportData(' + i + ')" id="' + i + '" class="btn btn-danger btn_remove"><span class="far fa-trash-alt"></span></button></td></tr>');

      
        var start = $("#dob").val();
			var end = (new Date()).getFullYear();
			var yrRange = (new Date(start)).getFullYear() + ":" + end;
			var checkkk = 0;
			$(".drDate").datepicker({
				changeMonth: true,
				changeYear: true,
				// minDate: '-60Y',
				minDate: new Date(start, 4 - 1, 1),
				yearRange: yrRange,
				maxDate: '0',
				dateFormat: 'dd-mm-yy'
			});


    });
    var sportEventJsonArray = [];
    var sportMedalJsonArray = [];

    function pushSportEvent(value, i) {

        if (value != '') {

            var sport_event = $("#sport_event" + i).attr("old-value");
            $.each(sportEventJsonArray, function(index, data) {
                console.log("check" + data)
                if (data == sport_event) {
                    sportEventJsonArray.splice($.inArray(sport_event, sportEventJsonArray), 1);
                }
            });

            $("#sport_event" + i).attr({
                "old-value": value
            });
            sportEventJsonArray.splice(i, 0, value);
        }
    }

    function pushSportMedal(value, i) {
        if (value != '') {

            var sport_medal = $("#medal" + i).attr("old-value");
            $.each(sportMedalJsonArray, function(index, data) {
                console.log("check" + data)
                if (data == sport_medal) {
                    console.log("remove" + data)
                    sportMedalJsonArray.splice($.inArray(sport_medal, sportMedalJsonArray), 1);
                }
            });

            $("#medal" + i).attr({
                "old-value": value
            });


            sportMedalJsonArray.splice(i, 0, value);

        }
    }

    function removeSportData(i) {
        var sport_event = $("#sport_event" + i).val();
        sportEventJsonArray = sportEventJsonArray.filter((item, i, ar) => ar.indexOf(item) === i);
        sportEventJsonArray.splice($.inArray(sport_event, sportEventJsonArray), 1);

        var medal = $("#medal" + i).val();
        sportMedalJsonArray = sportMedalJsonArray.filter((item, i, ar) => ar.indexOf(item) === i);
        sportMedalJsonArray.splice($.inArray(medal, sportMedalJsonArray), 1);
        $('#row' + i).remove();

        ck--;
    }

    

    
</script>
@endpush
