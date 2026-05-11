@extends( 'layouts\private_coaching_auth_layout' )
@section('content')


<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        Application Preview
                        <a href="#" data-print="modal" class="btn btn-sm btn-outline-primary ms-2 float-end " onclick="PrintDoc()"><span class="icons icon-printer"></span> Print</a>
                        @if($application->final_submit == 1 && $application->query_status == 1)
                        <a class="btn btn-outline-info btn-sm  float-end" data-bs-toggle="modal" data-bs-target="#viewQuery" href="#"><i class="fa fa-question"></i> View Query</a>

                    @endif
                        <a href="{{ route('private_coaching_dashboard') }}" class="btn btn-outline-success btn-sm float-end "><span class="icons icon-arrow-left"></span>Back to Dashboard</a>
                    </h4>
                </div>

                <div class="bhoechie-tab-container">
                    <div class="form-scroll">
                        <div class="nano-content">
                            <div class="card">
                                <div class="card-body">
                                    <div id="prodiv">
                                        <table border="0" cellspacing="0" cellpadding="4" width="100%" style="border-collapse:collapse;">
                                            <thead class="dn">
                                                <tr>
                                                    <th colspan="2">
                                                        <div style="padding: 0 15px 3px; margin-bottom: 10px; border-bottom: 2px solid #000; position: relative;">
                                                            <img src="{{url('public/assets_admin/images/logo.png')}}" style="width: 75px; height: auto; position: absolute; top: 0px; left: 20px;">
                                                            <h1 style="text-align: center; font-size: 20pt; margin: 0px 0px 0px 0px; padding: 0px 0 0; color: #383838; font-weight: bold;">
                                                                Sports Directorate, Govt. of Uttar Pradesh
                                                            </h1>
                                                            <h2 style="text-align: center; margin:0px 0px 0px 0px; font-size:11pt; padding: 0px; color:#383838; font-weight: bold;">
                                                                Khel Bhawan Hazratganj Lucknow, Uttar Pradesh 226001
                                                            </h2>
                                                            <h5 style="text-align: center; margin:10px 0px 0px 0px; font-size:16pt; padding: 0px; color:#383838; font-weight: bold;">
                                                                Registration of Private Coaching Academies/Associations
                                                            </h5>
                                                        </div>
                                                        <h6 style="text-align: center; margin:10px 0px 15px 0px; font-size:12pt; padding: 0px; color:#383838; font-weight: bold; text-decoration:underline;">
                                                            Details of Association
                                                        </h6>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th style="font-size: 10pt; text-align:left">
                                                        <!--<strong>Report Period : </strong> 29/01/2024 to 29/01/2024-->
                                                    </th>
                                                    <th style="text-align: right; font-size: 10pt;">
                                                        <strong>Report Generated On : </strong> {{date('d-m-Y')}}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                   
                                                <tr>
                                                    <td colspan="2">
                                                        <div class="table-responsive"><table class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
                                                            <tbody>
                                                                <tr @if ($application->final_submit != 1) style="display: none" @endif>
                                                                <td colspan="2"><strong>Application no. / आवेदन संख्या</strong></td> <td  colspan="2" >{{ $application->application_no }}</td>
                                                            </tr>
                                                                <tr>
                                                                <td colspan="4" style="background-color:#eee;"><strong>A. Registration Details/पंजीकरण के विवरण</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>1.) Full Name/पूरा नाम</strong></td>
                                                                <td>{{Auth::guard('PrivateCoaching')->user()->name}}</td>
                                                                <td><strong>2. Designation/पदनाम</strong></td>
                                                                <td>{{Auth::guard('PrivateCoaching')->user()->designation}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>3.) Email ID/ईमेल आईडी </strong></td>
                                                                <td>{{Auth::guard('PrivateCoaching')->user()->email}}</td>
                                                                <td><strong>4.) Mobile No./मोबाइल नंबर </strong></td>
                                                                <td>{{Auth::guard('PrivateCoaching')->user()->mobile}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>5.) Photo/फोटो </strong></td>
                                                                <td colspan="3">  <a href="{{ asset('public/private_coaching_storage/photo_upload/') }}/{{ $profile->photo_upload }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a></td></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="background-color:#eee;"><strong>B. Address Details/पते का विवरण</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>1.) Office Address/कार्यालय का पता </strong></td>
                                                                <td>{{$profile->office_address}}</td>
                                                                <td><strong>2.) State/राज्य </strong></td>
                                                                <td>Uttar Pradesh</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>3.) City/शहर </strong></td>
                                                                <td>{{districtName($profile->district)}}</td>
                                                                <td><strong>4.) Pincode/पिन कोड </strong></td>
                                                                <td>{{$profile->pin}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="background-color:#eee;"><strong>C. Sports/खेल</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>1.) Sports Name/खेल का नाम </strong></td>
                                                                <td colspan="3">{{sport_name($profile->sport_id)}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="background-color:#eee;"><strong>D. Institution/संस्थान</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>1.) Type of Institution/संस्था का प्रकार </strong></td>
                                                                <td>{{$profile->type_institute}}</td>
                                                                <td><strong>2.) Institution Name/संस्था का नाम </strong></td>
                                                                <td>{{$profile->institute_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="background-color:#eee;"><strong>E. Association Members/संघ के सदस्य</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4">
                                                                    <div class="table-responsive"><table class="table table-bordered table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>S.No.<br>क्र. सं.</th>
                                                                                <th>Name of Member<br>सदस्य का नाम</th>
                                                                                <th>Mobile No.<br>मोबाइल नंबर</th>
                                                                                <th>Email ID<br>ईमेल आईडी</th>
                                                                                <th>Designation<br>पदनाम</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                            @foreach ($associate_member as $key=>$item)
                                                                            <tr>
                                                                                <td class="text-center" style="width:5%;"><b>{{$key +  1}}</b></td>
                                                                                <td>
                                                                                    {{$item->name}}
                                                                                </td>
                                                                                <td>{{$item->mobile}}</td>
                                                                                <td>{{$item->email}}</td>
                                                                                <td>{{$item->designation}}</td>
                                                                            </tr>
                                                                            @endforeach



                                                                        </tbody>
                                                                    </table></div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" style="background-color:#eee;"><strong>F. Uploaded Documents/अपलोड किए गए दस्तावेज़</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <label>1.) Copy of the form regarding recognition of Sports Federation of India/Federation of the concerned sport by the Ministry of Sports, Government of India.<br>सम्बन्धित खेल के भारतीय खेल फेडरेशन/महासंघ का खेल मंत्रालय भारत सरकार द्वारा मान्यता प्रदान किये जाने सम्बन्धी प्रपत्र की प्रति  </label>
                                                                </td>
                                                                <td><a href="{{ asset('public/private_coaching_storage/sport_federation/') }}/{{ $application->sport_federation }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <label>2.) Copy of the form for granting recognition/affiliation to the State Sports Association of the respective sport by the Indian Federation/Federation and Uttar Pradesh Olympic Association.<br>सम्बन्धित खेल के प्रदेशीय क्रीड़ा संघ को भारतीय फेडरेशन/महासंघ एवं उत्तर प्रदेश ओलम्पिक संघ द्वारा मान्यता/सम्बद्धता प्रदान किये जाने सम्बन्धी प्रपत्र की प्रति  </label>
                                                                </td>
                                                                <td><a href="{{ asset('public/private_coaching_storage/granting_recognition/') }}/{{ $application->granting_recognition }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <label>3.) Certified copy of recognition from the Indian Sports Association/Federation of the concerned sport.<br>सम्बंधित खेल के भारतीय खेल संघ/ फेडरेशन द्वारा  प्रमाणित प्रति।</label>
                                                                </td>
                                                                <td><a href="{{ asset('public/private_coaching_storage/certified_copy_of_recognition/') }}/{{ $application->certified_copy_of_recognition }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <label>4.) Copy of the Registration Certificate of the concerned State Sports Association under the Society Registration Act.<br>सम्बन्धित प्रदेशीय क्रीड़ा संघ का सोसाइटी रजिस्ट्रेशन एक्ट के अन्तर्गत पंजीयन प्रमाण-पत्र की प्रति। </label>
                                                                </td>
                                                                <td>
                                                                    <b>Date of Registration :</b> {{dmy($application->date_of_registration)}} <br>
                                                                    <b>पंजीकरण की तिथि</b>
                                                                </td>
                                                                <td><a href="{{ asset('public/private_coaching_storage/registration_certificate/') }}/{{ $application->registration_certificate }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <label>5.) Certified copy of the Constitution/Memorandum of the State Sports Association.<br>प्रदेशीय क्रीडा संघ के संविधान/ज्ञापन की प्रमाणित प्रति। </label>
                                                                </td>
                                                                <td><a href="{{ asset('public/private_coaching_storage/certified_copy_of_the_constitution/') }}/{{ $application->certified_copy_of_the_constitution }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <label>6.) Copy of the selection form of the officials of the State Sports Association and the list of the officials along with their mobile numbers and permanent addresses.<br>प्रदेशीय क्रीडा संघ के पदाधिकारियों के चयन सम्बन्धी प्रपत्र की प्रति एवं पदाधिकारियों के मोबाइल नम्बर एवं स्थायी पता सहित सूची। </label>
                                                                </td>
                                                                <td><a href="{{ asset('public/private_coaching_storage/copy_of_the_selection/') }}/{{ $application->copy_of_the_selection }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <label>7.) Copy of the CA- Audit Report of income and expenditure statement of the last three years of the concerned State Sports Association.<br>सम्बन्धित प्रदेशीय क्रीडा संघ के विगत तीन वर्षों का सम्परीक्षित आय-व्यय विवरण की प्रति। </label>
                                                                </td>
                                                                <td><a href="{{ asset('public/private_coaching_storage/audited_income_first/') }}/{{ $application->audited_income_first }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a> <br><br>
                                                                    <a href="{{ asset('public/private_coaching_storage/audited_income_second/') }}/{{ $application->audited_income_second }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a> <br><br>
                                                                    <a href="{{ asset('public/private_coaching_storage/audited_income_third/') }}/{{ $application->audited_income_third }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <label>8.) Copy of the list including mobile/landline numbers and permanent addresses of 75 percent of the district units and their related officials related to the State Sports Association.<br>प्रदेशीय खेल संघ से सम्बन्धित 75 प्रतिशत जिला इकाईयों एवं उनसे सम्बन्धित पदाधिकारियों के मोबाइल / लैण्डलाइन नम्बर एवं स्थायी पता सहित सूची की प्रति।</label>
                                                                </td>
                                                                <td><a href="{{ asset('public/private_coaching_storage/granting_recognition/copy_of_the_list_including_mobile') }}/{{ $application->copy_of_the_list_including_mobile }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <label>9.) Report of the activities of the concerned state sports for the last three years.<br>सम्बंधित प्रदेशीय खेल के विगत तीन वर्ष के कार्यकलापों की रिपोर्ट।  </label>
                                                                </td>
                                                                <td><a href="{{ asset('public/private_coaching_storage/report_activity_first/') }}/{{ $application->report_activity_first }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a> <br><br>
                                                                    <a href="{{ asset('public/private_coaching_storage/report_activity_second/') }}/{{ $application->report_activity_second }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a> <br><br>
                                                                    <a href="{{ asset('public/private_coaching_storage/report_activity_third/') }}/{{ $application->report_activity_third }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <label>10.) Form of State Sports Association regarding organizing state level competitions of sub-junior/junior/senior category for the last three years.<br>प्रदेशीय खेल संघ का विगत तीन वर्षों तक सबजूनियर/जूनियर/सीनियर वर्ग की राज्यस्तरीय ✓ प्रतियोगिताओं के आयोजन सम्बंधी प्रपत्र। </label>
                                                                </td>
                                                             <td><a href="{{ asset('public/private_coaching_storage/state_sports_association_first/') }}/{{ $application->state_sports_association_first }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a> <br>  <br>
                                                                <a href="{{ asset('public/private_coaching_storage/state_sports_association_second/') }}/{{ $application->state_sports_association_second }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                <br>  <br>
                                                                <a href="{{ asset('public/private_coaching_storage/state_sports_association_third/') }}/{{ $application->state_sports_association_third }}" download class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                            </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" class="bg-light"><strong>Declaration</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4">I declare that the above particulars are true to the best of my knowledge. If any of my facts are found to be wrong, my admission should be canceled, for which all responsibility will be mine. I have read all the facts thoroughly.<br>मैं घोषणा करता हूं कि उपरोक्त विवरण मेरी सर्वोत्तम जानकारी के अनुसार सत्य हैं। यदि मेरा कोई भी तथ्य गलत पाया जाये तो मेरा प्रवेश निरस्त कर दिया जाये, जिसकी समस्त जिम्मेदारी मेरी होगी। मैंने सभी तथ्यों को अच्छी तरह से पढ़ लिया है। </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" align="center">
                                                                    <input type="checkbox" id="coachingChecked" @if (($application->final_submit == 1 && $application->query_status == 2) || ($application->final_submit == 1 &&  $application->query_status == null))  checked  disabled @endif />
                                                                    &nbsp; <b>I Agree/मैं सहमत हूं</b>
                                                                </td>
                                                            </tr>
                                                            <!--<tr>
<td colspan="2" align="center">
    <span>-</span><br />
    <b>Guardian Full Name<br>संरक्षक का पूरा नाम</b>
</td>
<td colspan="2" align="center">
    <img src="images/signature.png" class="img-fluid" style="width: 140px;" /><br />
    <b>Guardian Signature<br>अभिभावक के हस्ताक्षर</b>
</td>
</tr>-->
                                                        </tbody></table></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>












                                    </div>
                                    <hr />

                                    @if ($application->final_submit != 1  || ($application->final_submit == 1 && $application->query_status == 1))

                                    <div class="row justify-content-center">
                                        <div class="col-md-2 d-grid">
                                            <a href="{{ route('private_coaching_application_form',$application->id) }}" class="btn btn-outline-light ">Back</a>
                                        </div>
                                        <div class="col-md-2 d-grid">
                                            <button class="btn btn-outline-success " id="coachingFinal">Final Submit</button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="onlineFinalWarning" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">

                <h3> Are you sure  want to submit the form?</h3>




                <p>
                    <button class="btn btn-outline-danger rounded-pill" onclick="final_submit({{ $application->id }})" >Yes</button>
                    <a type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal" aria-label="Close">No</a>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button> --}}

                </p>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="viewQuery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Query Details</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Query</th>
                            <th>Query Date</th>
                            <th>File</th>
                            <th>Query By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($query_mark as $key=>$item)
                        <tr>
                            <td><b>{{$key+1}}</b></td>
                            <td>{{$item->comments}}</td>
                            <td>{{dmy($item->created_at)}}</td>
                            @if ($item->doc)
                            <td><a class="btn btn-primary btn-sm" href="{{asset('public/private_coaching_storage/query_upload')}}/{{$item->doc}}" title="View File">Uploaded</a></td>
                            @else
                            <td>NA</td>
                            @endif
                            <td>{{ rsoName($item->created_by) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





@endsection


@push('custom-scripts')


<script>

$('#coachingFinal').click(function() {
          var content = document.createElement('div');
          content.innerHTML = '<h3>Please click on the Declaration Checkbox and then proceed to submit.<br>कृपया घोषणा के चेकबॉक्स पर क्लिक करें एवं तदोपरांत आगे बढ़ें।</h3>';
          if($('#coachingChecked').is(':checked') ){
            $('#onlineFinalWarning').modal('toggle');


          }
          else
          swal(content, {

          });
              return false;
      });







    function final_submit(id) {


var actionUrl = ajaxUrl+"/private_coaching/applicationfinalSubmit/"+id;

$.ajax({
    type: "GET",
    url: actionUrl,

    data: {
        // <-- the $ sign in the parameter name seems unusual, I would avoid it
    }, // serializes the form's elements.
    success: function (res) {
  if (res.error == false) {

      success(res.msg);

       window.location.href = res.url;
  } else {
      error(res.msg);
  }
},
});

};




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



    </script>
    @endpush
