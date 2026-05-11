@extends('layouts/admin_layout')
@section('content')

    <div class="pageheader" id="menu-margin">
        <h4> Admission Detail


            <td colspan="3" align="center"><a href="#" class="btn btn-success float-end btn-sm" data-bs-toggle="modal"
                    data-bs-target="#exampleModalLabellllll">
                    @if (isset($data->query_status) && ($data->query_status == 1 || $data->query_status == 2))
                        Query Marked
                    @else
                        Query Mark
                    @endif
                </a>
            </td>

            <a title="Print"class="btn btn-warning float-end" id="print" onclick="printContent('examples')"><i
                    class="icons icon-printer"></i>Print</a>
            <a href="{{ url('collegeadmin/dashboard') }}"
                class="btn btn-outline-danger btn-sm backbtn float-end  mr-2"><span
                    class="icons icon-arrow-left"></span>Back/पीछे</a>

            {{-- <a href="{{ route('online_admission_edit', $data->user_id) }}" class="btn btn-outline-danger btn-sm backbtn float-end  mr-2"><span class="icons icon-arrow-left"></span>Edit</a> --}}

        </h4>

    </div>
    <div class="card">

        <div class="card-body">
            <div class="table-responsive" id="examples">
                <table class="dn" style="width: 100%; margin-bottom: 5px;" border="0">
                    <tr>
                        <td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                            <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                                <!-- <img src="{{ url('onlineAdmission') }}/images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
                                <!-- <img src="images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
                                <div style="font-size: 3vw; font-weight: bold;">
                                    <!-- Department of Sports -->
                                    Khel Sathi Portal
                                </div>
                                <div style="font-size: 2vw; font-weight: bold;">
                                    Government of Uttar Pradesh
                                </div>
                                <div style="font-size: 2vw; font-weight: bold;">
                                    Sports College Online Application Form 2026-27
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- <tr>
                                        <td style="text-align: left; font-size: 12px; padding-top: 5px;"></td>
                                        <td style="text-align: right; font-size: 12px; padding-top: 5px;"><b>Print Date :</b> {{ date('d-m-Y') }}</td>
                                    </tr> -->
                </table>
                <table id="dataTable" class="table table-bordered" border="1"
                    style="border-collapse: collapse; width: 100%;">
                    <tr>
                        <th colspan="6" class="bg-dark text-white"><strong>Basic Details/मूल विवरण</strong></th>
                    </tr>
                    <tr>
                                <td><strong>Registration No./पंजीकरण संख्या</strong></td>
                                <td>{{ $data->application_no }}</td>
                                <td><strong>Application No./आवेदन संख्या</strong></td>
                                <td>@if ($data->enroll_no )
                                    {{ $data->enroll_no  }}
                                @else
                                    NA
                                @endif</td>
                                <td rowspan="7" colspan="2" style="text-align: center;">
                                  <div class="text-center" style="padding: 5px;" align="center"> <img src="{{ url('onlineAdmission_storage') }}/images/{{$data->applicant_photograph}}" class="img-fluid" style="width: 140px;" /> </div>
                                  <br />
                                  <b>Photograph of Applicant/आवेदक का फोटो</b></td>
                              </tr>
                              <tr>
                                <td><b>Applicant’s Name/आवेदक के नाम</b></td>
                                <td>{{$data->fullname}}</td>
                                <td><b>Date of Birth/जन्म की तारीख</b></td>
                                <td>{{dmy($data->dob)}}</td>
                              </tr>
                              <tr>
                                <td><b>Aadhaar No.</b>/आधार संख्या</td>
                                <td>{{$data->aadhar_no}}</td>
                                <td><b>Applicant's Aadhaar</b></td>
                                @php
                                $img = url('public/onlineAdmission_storage/images').'/'.$data->applicant_aadhar_birth_certificate;
                                $img1 = url('public/images/view.jpg');
                                $doc = explode('.',$data->applicant_aadhar_birth_certificate);

                                @endphp
                                <td><strong ><a href="{{$img}}" class="rounded-pill btn btn-outline-success btn-xs" target="_blank">Uploaded</a></strong></td>
                              </tr>
                              <tr>
                                <td><b>Mobile Number</b>/मोबाइल नंबर</td>
                                <td>{{$data->mobile}}</td>
                                <td><b>Email ID</b>/ईमेल आईडी</td>
                                <td>{{$data->email}}</td>
                              </tr>
                              <tr>
                                <td><b>District/ज़िला</b></td>
                                <td>{{districtName($data->p_district)}}</td>
                                <td><b>Sports College/स्पोर्ट्स कॉलेज</b></td>
                                <td>Preference 1 : {{sportCollege( explode(",",$data->sport_college)[0])}} <br>

                                    @isset($data) @if ( count(explode(",",$data->sport_college)) > 1)
Preference 2 : {{sportCollege( explode(",",$data->sport_college)[1])}} @endif @endisset</td>
                              </tr>
                              <tr>
                                <td><b>Sports Name/</b>खेल का नाम</td>
                                <td>{{$data->name}}</td>
                                <td><strong>Sub Sport/उप खेल</strong></td>
                                <td>@if ( $data->sub_sport_type )
                                    {{get_subSportName($data->sub_sport_type)  }}
                                @else
                                    NA
                                @endif</td>
                              </tr>
                              <tr>
                                <td><b>Category</b>/वर्ग</td>
                                <td> @if($data->category == '1') General
                                  @elseif($data->category == '2') OBC
                                  @elseif($data->category == '3') SC
                                  @elseif($data->category == '4') ST
                                  @else EWS
                                @endif </td>
                                <td><b>Permanent Education Number (PEN No.) </b> / परमानेंट एजुकेशन नंबर</td>
                                <td>{{$data->pen_no}}</td>
                              </tr>
                              <tr>
                                <td><b>Sub Category/उप श्रेणी</b></td>
                                <td>{{$data->sub_category}}</td>
                                <td><b>Father’s Name</b>/पिता का नाम</td>
                                <td>{{$data->father_name}}</td>
                                <td rowspan="2" colspan="2" style="text-align: center;">
                                  <div class="text-center" style="padding: 5px;" align="center"> <img src="{{ url('onlineAdmission_storage') }}/images/{{$data->applicant_signature}}" class="img-fluid" style="width: 140px;" /> </div>
                                  <br /><b>Signature  of Applicant</b>
                                </td>
                              </tr>
                              <tr>
                                <td><b>Father’s Occupation/पेशा</b></td>
                                <td>{{$data->father_occupation}}</td>
                                <td><b>Father’s Aadhaar Card/पिता का आधार कार्ड</b></td>
                                <td>
                                  @if(isset($data->father_aadhar) && $data->father_aadhar !='')
                                  <a href="{{url('public/onlineAdmission_storage/images').'/'.$data->father_aadhar}}" class="rounded-pill btn btn-outline-success btn-xs" target="_blank"> Uploaded</a>
                                 @else
                                  <button class="btn btn-danger">Not Upload</button>
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                  <td><b>Mother’s Name/मां का नाम</b></td>
                                  <td>{{$data->mother_name}}</td>
                                  <td style="width: 15%"><b>Mother’s Occupation/पेशा</b></td>
                                  <td style="width: 20%">{{$data->mother_occupation}}</td>
                                  <td><b>Mother’s Aadhaar Card/मां का आधार कार्ड</b></td>
                                  <td>
                                    @if(isset($data->mother_aadhar) && $data->mother_aadhar !='')
                                    <a href="{{url('public/onlineAdmission_storage/images').'/'.$data->mother_aadhar}}" class="rounded-pill btn btn-outline-success btn-xs" target="_blank"> Uploaded</a>
                                  @else
                                    <button class="btn btn-danger">Not Upload</button>
                                    @endif
                                  </td>
                              </tr>
                              <tr>
                                <td style="width: 15%"><b>Height (in centimeter)/ऊंचाई (सेंटीमीटर में)</b></td>
                                <td style="width: 20%">{{$data->height}}</td>
                                <td style="width: 15%"><b>Weight (in Kg)</b>/वजन (किग्रा में)</td>
                                <td style="width: 15%">{{$data->weight}}</td>
                                <td><b>Blood Group/ब्लड ग्रुप</b></td>
                                <td>{{$data->blood_group}}</td>
                              </tr>
                              <tr>

                                <td><b>Domicile of Uttar Pradesh/उत्तर प्रदेश का डोमिसाइल</b></td>
                                <td>Yes</td>
                                <td><b>Educational Certificate/शैक्षिक प्रमाण पत्र</b></td>
                                @php
                                $img7 = url('public/onlineAdmission_storage/images').'/'.$data->education_certificate;
                                $img1 = url('public/images/view.jpg');
                                $doc = explode('.',$data->education_certificate);

                                @endphp
                                <td colspan="1"><strong ><a href="{{$img7}}" class="rounded-pill btn btn-outline-success btn-xs" target="_blank">Uploaded</a></strong></td>
                                <td><b>Identification Mark/पहचान के निशान</b></td>
                                <td>{{$data->identification_marks}}</td>
                              </tr>
                              <tr>



                                <td><b>Suffering from Skin Disease/Fits/Other Disease/चर्म रोग/फिट्स/अन्य रोग से पीड़ित होना</b></td>
                                <td>
                                    @if($data->disease == '1') YES
                                      @else NO
                                      @endif
                                </td>
                                <td><b>CLass for which admission seeking</b></td>
                                <td>
                                    {{$data->admission_seeking}}
                                </td>


                                <td><b>Applicant's Date of Birth Certificate</b></td>
                                @php
                                $img = url('public/onlineAdmission_storage/images').'/'.$data->applicant_birth_certificate;
                                $img1 = url('public/images/view.jpg');
                                $doc = explode('.',$data->applicant_birth_certificate);

                                @endphp
                                <td><strong >@if(isset($data->applicant_birth_certificate))<a href="{{$img}}" class="rounded-pill btn btn-outline-success btn-xs" target="_blank">Uploaded</a> @else NA @endif</strong></td>

                              </tr>
                               <tr>
                                @isset($data->affidavit) @if ($data->affidavit)
                                @php
                                $img6 = url('public/onlineAdmission_storage/images').'/'.$data->affidavit;
                                $img1 = url('public/images/view.jpg');
                                $doc = explode('.',$data->affidavit);

                                @endphp
                                <td><b>Affidavit/शपत पात्र</b></td>
                                <td><strong ><a href="{{$img6}}" class="rounded-pill btn btn-outline-success btn-xs" target="_blank">Uploaded</a></strong></td>
                                @endif @endisset
                               {{-- <td><b>Educational Certificate</b>/शैक्षिक प्रमाण पत्र</td>
                                @php
                                $img7 = url('public/onlineAdmission_storage/images').'/'.$data->education_certificate;
                                $img1 = url('public/images/view.jpg');
                                $doc = explode('.',$data->education_certificate);

                                @endphp
                                <td colspan="1"><strong class="rounded-pill btn btn-outline-success btn-xs " style="display:block " onclick="appendImage('{{$img7}}','{{$doc[1]}}')">Uploaded</strong></td> --}}
                           
                                <td><b>Gender</b></td>
                                <td>
                                  @if($data->gender == 1 )Male @else Female @endif
                                </td>
                           
                           
                              </tr>
                              <tr>
                                <th colspan="6" class="bg-dark text-white"><strong>Communication Details/संचार विवरण</strong></th>
                              </tr>
                              <tr>
                                <td colspan="6" class="bg-light"><strong style="font-size: 14px;">Permanent Address/स्थायी पता</strong></td>
                              </tr>
                              <tr>
                                <td><b>Gram/Mohalla/ग्राम/मोहल्ला</b></td>
                                <td>{{$data->p_gram}}</td>
                                <td><b>Post/डाक</b></td>
                                <td>{{$data->p_post}}</td>
                                <td><b>Thana/थाना</b></td>
                                <td>{{$data->p_thana}}</td>
                              </tr>
                              <tr>
                                <td><b>State/राज्य</b></td>
                                <td>{{stateName($data->p_state)}}</td>
                                <td><b>District/ज़िला</b></td>
                                <td>{{districtName($data->p_district)}}</td>
                                <td><b>Mobile No./मोबाइल नंबर</b></td>
                                <td>{{$data->p_mobile}}</td>
                              </tr>
                              <tr>
                                <td><b>Alternate Contact No./वैकल्पिक संपर्क नंबर</b></td>
                                <td>{{$data->p_alternate_mobile}}</td>
                                <td><b>Email ID/ईमेल आईडी</b></td>
                                <td colspan="3">{{$data->p_email}}</td>
                              </tr>
                              <tr>
                                <td colspan="6" class="bg-light"><strong style="font-size: 14px;">Correspondence Address/पत्राचार का पता</strong></td>
                              </tr>
                              <tr>
                                <td><b>Gram/Mohalla/ग्राम/मोहल्ला</b></td>
                                <td>{{$data->c_gram}}</td>
                                <td><b>	Post/डाक</b></td>
                                <td>{{$data->c_post}}</td>
                                <td><b>Thana/थाना</b></td>
                                <td>{{$data->c_thana}}</td>
                              </tr>
                              <tr>
                                <td><b>State/राज्य</b></td>
                                <td>{{stateName($data->c_state)}}</td>
                                <td><b>District/ज़िला</b></td>
                                <td>{{districtName($data->c_district)}}</td>
                                <td><b>Mobile No./मोबाइल नंबर</b></td>
                                <td>{{$data->c_mobile}}</td>
                              </tr>
                              <tr>
                                <td><b>Alternate Contact No./वैकल्पिक संपर्क नंबर</b></td>
                                <td>{{$data->c_alternate_mobile}}</td>
                                <td><b>Email ID/ईमेल आईडी</b></td>
                                <td colspan="3">{{$data->c_email}}</td>
                              </tr>
                              <tr>
                              <td><b>	Trial Venue</b></td>
                                <td>@if(isset($data->trial_location)){{$data->trial_location}} @else NA @endif</td>
                              </tr>
                              <tr>
                                <td colspan="6" class="bg-light"><strong>Educational Qualification/शैक्षणिक योग्यता</strong></td>
                              </tr>
                              <tr>
                                <td><b>UDISE Code</b></td>
                                <td>@if(isset($data->updise_code)){{$data->updise_code}}@else NA @endif</td>

                                <td><b>School Name/स्कूल के नाम</b></td>
                                <td>{{$data->school}}</td>
                                <!-- <td><b>Class/कक्षा</b></td>
                                <td>{{$data->class}}</td> -->

                              </tr>
                         

                              <?php $tran=transaction($data->challan_no,$data->user_id);?>

                              @if(isset($tran) && $tran->uniquechallan)
                              <td colspan="6" class="bg-light"><strong>Payment Details/भुगतान विवरण</strong></td>

                            <tr>
                              <td><b>Client transaction Id/ग्राहक लेनदेन आईडी</b></td>
                              <td>{{$tran->clientTxnId}}</td>
                              <td><b>Unique Challan No./अद्वितीय चालान सं.</b></td>
                              <td>{{$tran->uniquechallan}}</td>

                              <td><b>SabPaisa transaction Id/सबपैसा लेनदेन आईडी</b></td>
                              <td>{{$tran->SabPaisaTxnId}}</td>

                            </tr>
                            <tr>
                              <td><b>Bank transaction Id/बैंक लेनदेन आईडी</b></td>
                              <td>{{$tran->bankTxnId}}</td>
                              <td><b>Amount/मात्रा</b></td>
                              <td>{{$tran->amount}}</td>


                              <td><b>Transaction Date/कार्यवाही की तिथि</b></td>
                              <td>{{dmyHi($tran->transDate)}}</td>

                            </tr>
                            @endif
                            <tr> @if ($data->final_status == 2 || $data->final_status == 3)
                                <td colspan="6" align="center">
                                  @if ($data->final_status == 2)
                                

                                    <h1>  <strong class="text-success blink_me">@if($data->trial_type == 2) First Trial Status :  Pass  </h1>  @elseif($data->trial_type == 3)  <h1> Second Trial Status : Pass  </h1>  @else     <h1 class="text-success blink_me ">
                                    Application is  Accepted
                          </h1> <br> <h6> {{ $data->comment }} </h6> @endif



                                  @elseif($data->final_status == 3)
                           
                                  <h1>  <strong class="text-danger blink_me">@if($data->trial_type == 4) First Trial Status :  Fail  </h1>  @elseif($data->trial_type == 5)  <h1> Second Trial Status : Fail  </h1>  @else     <h1 class="text-danger blink_me ">
                            Application is Rejected
                          </h1> <br> <h6> {{ $data->comment }} </h6> @endif</strong>   
                                  @endif
                               </td>
                        @else
                            @if (Auth::guard('admin')->user()->admin_role != 18 &&  Auth::guard('admin')->user()->admin_role != 19)
                                <td colspan="3" align="center"><a href="#" class="btn btn-success btn-sm "
                                        data-bs-toggle="modal" data-bs-target="#accept">Accept</a></td>
                                <td colspan="3" align="center"><a href="#" class="btn btn-danger btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#reject">Reject</a></td>
                            @endif
                        @endif
                    </tr>
                </table>

            </div>
        </div>
    </div>




@endsection
@push('custom-scripts')

    <div class="modal fade" id="exampleModalLabellllll" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Query Mark</h5>
                    <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                </div>

                @if (isset($data->query_status) && ($data->query_status == 1 || $data->query_status == 2))
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="placeholder"><strong>Query :</strong>
                                <Span>{{ $data->query_mark }}</Span></label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->

                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </div>
                @else
                    <form id="formReject" action="{{ route('online_admission_query_mark') }}" method="post">
                        @csrf
                        <div class="modal-body">

                            <input type="hidden" name="user_id"
                                value="@if (isset($data) && isset($data->user_id)) {{ $data->user_id }} @endif">
                            <div class="form-group">
                                <label class="placeholder">Query</label>
                                <input required name="query_mark" class="form-control" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        //=============================
        function printContent(el) {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorepage;
        }
    </script>
@endpush
