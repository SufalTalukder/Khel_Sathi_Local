@extends('layouts/coaching_camp_auth')
@section('content')
    <div class="container-fluid pagecontentbody">
        <div class="pagebody removebg-color">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader" id="menu-margin">
                        <h4 class="mb-0"> Application Form/आवेदन फार्म </h4>
                    </div>
                </div>

                <form action="{{ route('coaching_camp_application_form_store') }}" id="formsubsmit" method="post"
                    class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        <div class="bhoechie-tab-content">


                            <div class="form-scroll">
                                <div class="nano-content">

                                    <fieldset>
                                        <?php $srno = 1; ?>
                                        <legend>Registration Details/पंजीकरण का विवरण</legend>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">
                                                        {{ $srno++ }}. Stadium Name / स्टेडियम का नाम<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select class="form-select form-control"
                                                        aria-label="Default select example" name="stadium" required>
                                                        <option value="">Select Stadium</option>
                                                        @foreach ($stadium as $item)
                                                            <option value="{{ $item->id }}"
                                                                @if (isset($applicationview->stadium) && $applicationview->stadium == $item->id) selected @endif>
                                                                {{ $item->studium_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">
                                                        {{ $srno++ }}. Sports Name / खेल का नाम<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                  





                                                                <select id="sportname" class="form-select form-control" name="sport[]" multiple placeholder="Select Sport">
                                                                    @foreach ($sport as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        @if (!empty($applicationview) && !empty(explode(',', $applicationview->sport)) && in_array($item->id, explode(',', $applicationview->sport)))
                                                                        selected
                                                                        @endif>
                                                                        {{ $item->name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>

                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">{{ $srno++ }}. Name / नाम<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="name" readonly
                                                        value="{{ Auth::guard('CoachingCamp')->user()->name }}">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">{{ $srno++ }}. Father Name / पिता का
                                                        नाम<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="father_name"
                                                        @if (isset($applicationview->father_name)) value="{{ $applicationview->father_name }}" @endif
                                                        onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                        pattern="^[A-Za-z -]+$" maxlength="255" required />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">{{ $srno++ }}. Mothers Name/ माता का
                                                        नाम<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="mother_name"
                                                        @if (isset($applicationview->mother_name)) value="{{ $applicationview->mother_name }}" @endif
                                                        onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                        pattern="^[A-Za-z -]+$" maxlength="255" required />
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">{{ $srno++ }}. Date of Birth /
                                                        जन्मतिथि <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" readonly
                                                        max="{{ date('Y-m-d') }}"
                                                        value="{{ Auth::guard('CoachingCamp')->user()->dob }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">{{ $srno++ }}. मोबाइल नंबर/Mobile
                                                        Number<span class="text-danger">*</span></label>

                                                    <input type="text" class="form-control" readonly
                                                        value="{{ Auth::guard('CoachingCamp')->user()->mobile }}"
                                                        maxlength="10" />
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">{{ $srno++ }}. Aadhar Number / आधार
                                                        नं0<span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" readonly
                                                        value="{{ Auth::guard('CoachingCamp')->user()->aadhar }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <?php
                                                $bloodGroup = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                                                ?>
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">{{ $srno++ }}. Blood Group / ब्लड
                                                        ग्रुप<span class="text-danger">*</span></label>

                                                    <select name="blood_group" class="form-control">
                                                        <option value="">Select Blood Group</option>
                                                        @foreach ($bloodGroup as $item)
                                                            <option value="{{ $item }}"
                                                                {{ old('blood_group', $applicationview?->blood_group) == $item ? 'selected' : '' }}>
                                                                {{ $item }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">{{ $srno++ }}. Religion / धर्म<span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select form-control w-100"
                                                        aria-label="Default select example" name="religion" required>
                                                        <option value="">Select Religion</option>
                                                        <option value="Hindu"
                                                            @if (isset($applicationview->religion) && $applicationview->religion == 'Hindu') selected @endif>Hindu</option>
                                                        <option value="Muslim"
                                                            @if (isset($applicationview->religion) && $applicationview->religion == 'Muslim') selected @endif>Muslim
                                                        </option>
                                                        <option value="Christian"
                                                            @if (isset($applicationview->religion) && $applicationview->religion == 'Christian') selected @endif>Christian
                                                        </option>
                                                        <option value="Sikh"
                                                            @if (isset($applicationview->religion) && $applicationview->religion == 'Sikh') selected @endif>Sikh</option>
                                                        <option value="Buddha"
                                                            @if (isset($applicationview->religion) && $applicationview->religion == 'Buddha') selected @endif>Buddha
                                                        </option>
                                                        <option value="Jain"
                                                            @if (isset($applicationview->religion) && $applicationview->religion == 'Jain') selected @endif>Jain</option>
                                                        <option value="Other"
                                                            @if (isset($applicationview->religion) && $applicationview->religion == 'Other') selected @endif>Other
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-2">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">{{ $srno++ }}. Caste / जाति<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="caste" required
                                                        @if (isset($applicationview->caste)) value="{{ $applicationview->caste }}" @endif
                                                        onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                        pattern="^[A-Za-z -]+$" maxlength="255" />
                                                </div>
                                            </div> --}}
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">{{ $srno++ }}. Category/वर्ग<span
                                                            class="text-danger">*</span></label>

                                                    <select required name="category"
                                                        class="form-select form-control w-100" name="category" required>
                                                        <option value="">Select</option>
                                                        <option value="General"
                                                            @if (isset($applicationview->category) && $applicationview->category == 'General') selected @endif>General
                                                        </option>
                                                        <option value="OBC"
                                                            @if (isset($applicationview->category) && $applicationview->category == 'OBC') selected @endif>OBC</option>
                                                        <option
                                                            value="SC"@if (isset($applicationview->category) && $applicationview->category == 'SC') selected @endif>
                                                            SC</option>
                                                        <option
                                                            value="ST"@if (isset($applicationview->category) && $applicationview->category == 'ST') selected @endif>
                                                            ST</option>
                                                        <option
                                                            value="Other"@if (isset($applicationview->category) && $applicationview->category == 'Other') selected @endif>
                                                            Other</option>
                                                    </select>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">{{ $srno++ }}. Height (in
                                                        Centimetre)/लंबाई (सेंटीमीटर
                                                        में)<span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="height"
                                                        value="{{ $applicationview?->height }}" required />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">{{ $srno++ }}. Weight (in KG)/वजन
                                                        (किलोग्राम में)<span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="weight"
                                                        value="{{ $applicationview?->weight }}" required />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">{{ $srno++ }}. Visible Identification
                                                        Mark/पहचान चिह्न
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        name="visible_identification_mark"
                                                        value="{{ $applicationview?->visible_identification_mark }}"
                                                        required />
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-check mt-4">
                                                    <input type="checkbox" class="form-check-input"
                                                        name="is_applicant_suffering_disease"
                                                        id="is_applicant_suffering_disease" value="1"
                                                        {{ old('is_applicant_suffering_disease', $applicationview?->is_applicant_suffering_disease) ? 'checked' : '' }}
                                                        required />
                                                    <label class="placeholder form-check-label">{{ $srno++ }}. Is
                                                        applicant suffering
                                                        from Skin
                                                        Disease/Fits/Other Disease?/क्या आवेदक चर्म रोग/मिर्गी/अन्य किसी रोग
                                                        से ग्रसित है?<span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 medical_certificate-div" id="medical_certificate-div">
                                                <div class="form-group">
                                                    <label>{{ $srno++ }}. Medical Certificate / आधार कार्ड फोटो <span
                                                            class="text-danger">*</span></label>
                                                    @if (!empty($applicationview->medical_certificate))
                                                        <div class="profpic mb-2">
                                                            <img class="img-fluid"
                                                                src="{{ asset('public/coaching_camp/medical_certificate/' . $applicationview->medical_certificate) }}"
                                                                alt="Medical Certificate">
                                                        </div>
                                                    @endif

                                                    <input type="file" class="form-control"
                                                        onchange="getfileext111(this, 21)" id="medical_certificate"
                                                        name="medical_certificate"
                                                        @if (empty($applicationview->medical_certificate)) required @endif>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>


                                    <fieldset> <?php $srNo = 1; ?>
                                        <legend>Communication Address/संचार पता</legend>
                                        <div class="row">

                                            <div class="col-md-12">

                                                <p><b>Permanent Address / स्थायी पता</b></p>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">{{ $srNo++ }}. Address/पता
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="permanent_address" id="permanent_address" required
                                                                @if (isset($applicationview->permanent_address)) value="{{ $applicationview->permanent_address }}" @endif>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-2">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">{{ $srNo++ }}. State/राज्य
                                                                <span class="text-danger">*</span></label>
                                                            <select class="form-select form-control w-100"
                                                                name="permanent_state" id="permanent_state" required>
                                                                <option value="23">Uttar Pradesh</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">{{ $srNo++ }}. District/ज़िला
                                                                <span class="text-danger">*</span></label>
                                                            <select class="form-select form-control w-100"
                                                                name="permanent_district" required
                                                                id="permanent_district">
                                                                <option value="">Select</option>
                                                                @foreach ($districts as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        @if (isset($applicationview->permanent_district) && $applicationview->permanent_district == $item->id) selected @endif>
                                                                        {{ $item->city }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">{{ $srNo++ }}. Pincode/पिन
                                                                कोड <span class="text-danger">*</span></label>
                                                            <input type="number" min="100000" max="999999"
                                                                class="form-control" name="permanent_pin"
                                                                id="permanent_pin" required
                                                                @if (isset($applicationview->permanent_pin)) value="{{ $applicationview->permanent_pin }}" @endif>
                                                        </div>
                                                    </div>



                                                </div>
                                            </div>

                                            <div class="col-md-12 text-center mt-3 mb-3">
                                                <small class="fw-normal bg-light rounded-pill fs-6 border p-2">
                                                    <input type="checkbox" name="" value="yes" id="myCheck"
                                                        onchange="myFunction()" />
                                                    Same as above</small>
                                            </div>


                                            <div class="col-md-12">
                                                <?php $srNo = 1; ?>
                                                <p><b>Correspondence Address / पत्राचार हेतु पता</b></p>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">{{ $srNo++ }}. Address/पता
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="correspondence_address" id="correspondence_address"
                                                                required
                                                                @if (isset($applicationview->correspondence_address)) value="{{ $applicationview->correspondence_address }}" @endif>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">{{ $srNo++ }}. State/राज्य
                                                                <span class="text-danger">*</span></label>
                                                            <select class="form-select form-control w-100"
                                                                onchange="get_city(this.value)" id="correspondence_state"
                                                                name="correspondence_state" required
                                                                id="correspondence_state">
                                                                <option value="">Select</option>
                                                                @foreach ($states as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        @if (isset($applicationview->correspondence_state) && $applicationview->correspondence_state == $item->id) selected @endif>
                                                                        {{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">{{ $srNo++ }}. District/ज़िला
                                                                <span class="text-danger">*</span></label>
                                                            <input type="hidden" id="district3"
                                                                @if (isset($applicationview->correspondence_district)) value="{{ $applicationview->correspondence_district }}" @endif>
                                                            <select class="form-select form-control w-100" id="cdistrict"
                                                                name="correspondence_district" required>
                                                                <option value="">Select </option>


                                                                @foreach ($districtall as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        @if (isset($applicationview->permanent_district) && $applicationview->permanent_district == $item->id) selected @endif>
                                                                        {{ $item->city }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>



                                                    <div class="col-md-2">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">{{ $srNo++ }}. Pincode/पिन
                                                                कोड <span class="text-danger">*</span></label>
                                                            <input class="form-control" type="number" min="100000"
                                                                max="999999" name="correspondence_pin"
                                                                id="correspondence_pin" required
                                                                @if (isset($applicationview->correspondence_pin)) value="{{ $applicationview->correspondence_pin }}" @endif>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>




                                    <!--fieldset>
                                                                                                          <legend>Instructor recommendation / प्रशिक्षक की संस्तुति</legend>

                                                                                          <textarea class="form-control mb-3" rows="3"></textarea>

                                                                                                        </fieldset-->
                                    <fieldset>
                                        <?php $srNo = 1; ?>
                                        <legend>Upload/दस्तावेज़</legend>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>{{ $srNo++ }}. Aadhar Card Photo / आधार कार्ड फोटो <span
                                                            class="text-danger">*</span></label>

                                                    <div class="profpic mb-2">
                                                        @if (!empty($applicationview->aadhar_card_photo))
                                                            <a href="{{ asset('public/coaching_camp/aadhar_card_photo/' . $applicationview->aadhar_card_photo) }}"
                                                                target="_blank">
                                                                View Uploaded Aadhar Card (PDF)
                                                            </a>
                                                        @else
                                                            <img src="{{ asset('public/coaching_camp/images/profile2.jpg') }}"
                                                                class="img-fluid" alt="No file uploaded">
                                                        @endif
                                                    </div>

                                                    <input type="file" class="form-control"
                                                        onchange="getfileextPdf(this, 21)" id="Filepdf"
                                                        name="aadhar_card_photo" accept=".pdf"
                                                        @if (empty($applicationview->aadhar_card_photo)) required @endif>
                                                </div>

                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>{{ $srNo++ }}. Profile Picture/
                                                        प्रोफ़ाइल फोटो<span class="text-danger">*</span></label>
                                                    <div class="profpic"> <img
                                                            @if (isset($applicationview->profile_picture)) src="{{ asset('public/coaching_camp/profile_picture') }}/{{ $applicationview->profile_picture }}" @else src="{{ asset('public/coaching_camp/images/profile2.jpg') }}" @endif
                                                            class="img-fluid"> </div>
                                                    <input type="file" class="form-control"
                                                        onchange="getfileext111(this,21)" id="File21"
                                                        @if (!isset($applicationview->profile_picture)) required @endif
                                                        name="profile_picture">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>{{ $srNo++ }}. Signature of Applicant/आवेदक के हस्ताक्षर <span
                                                            class="text-danger">*</span></label>
                                                    <div class="sign"> <img
                                                            @if (isset($applicationview->signature)) src="{{ asset('public/coaching_camp/signature') }}/{{ $applicationview->signature }}" @else src="{{ asset('public/coaching_camp') }}/images/signature.png" @endif
                                                            class="img-fluid"> </div>
                                                    <input type="file" class="form-control"
                                                        onchange="getfileext111(this,22)" id="File22"
                                                        @if (!isset($applicationview->signature)) required @endif
                                                        name="signature">
                                                </div>
                                            </div>



                                        </div>
                                    </fieldset>

                                    <div class="bhoechie-footer">
                                        <div class="row justify-content-center">

                                            <div class="col-md-2 d-grid"> <button type="submit"
                                                    class="btn btn-danger rounded-pill">Save & Proceed</button> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')





<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#sportname').select2();
    });
</script>
    <script>
        $("#formsubsmit").submit(function(e) {

            e.preventDefault();
            if ($("#formsubsmit")[0].checkValidity() === false) {
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
                    success: function(res) {
                        if (res.error == false) {
                            success(res.msg);

                            window.location.href = res.url;


                        } else {
                            error(res.msg);
                        }
                    },
                });
            }
            $("#formsubsmit").addClass("was-validated");
        });

        function get_city(value) {


            let h_city = $("#district3").val();
            let same_city = $("#permanent_district").val();
            let option = `<option value=''>Select </option>`;
            $.ajax({
                type: "POST",
                url: "{{ url('get_city') }}",
                data: {
                    value
                },

                success: function(response) {
                    response.forEach((item) => {
                        if (same_city && $("#myCheck").prop('checked') == true) {
                            option +=
                                `<option value="${item.id}" ${item.id==same_city?'selected':''} ${item.id==h_city?'selected':''}>${item.city}</option>`;
                        } else {
                            option +=
                                `<option value="${item.id}"  ${item.id == h_city ? 'selected':''} >${item.city}</option>`;
                        }


                    });
                    $("#cdistrict").empty();
                    $("#cdistrict").append(option);
                }
            });
        }



        function myFunction() {
            var checkBox = document.getElementById("myCheck");

            if (checkBox.checked == true) {





                document.getElementById("correspondence_address").value = document.getElementById("permanent_address")
                    .value;
                document.getElementById("correspondence_pin").value = document.getElementById("permanent_pin").value;

                document.getElementById("correspondence_state").value = +document.getElementById("permanent_state").value;
                get_city(document.getElementById("permanent_state").value);

                document.getElementById("cdistrict").value = document.getElementById("permanent_district").value;

            } else {
                document.getElementById("correspondence_address").value = " ";
                document.getElementById("correspondence_pin").value = " ";

                document.getElementById("correspondence_state").value = " ";
                document.getElementById("cdistrict").value = " ";

            }
        }






        function getfileext111(value, id) {


            var fileExtension = ["jpeg", "jpg", 'png'];
            var file_size = value.files[0].size;
            var filevalue = value.value;
            if (
                $.inArray(filevalue.split(".").pop().toLowerCase(), fileExtension) == -1
            ) {
                $("#File" + id).val("");
                $("#sign").attr("src", "");
                error("Please Upload File in jpg jpeg Format.");
            } else if (file_size > 2000000) {
                $("#File" + id).val("");
                $("#sign").attr("src", "");
                error("File Size should not exceed 2 Mb.");
            }
        }

        function getfileextPdf(value, id) {
            var fileExtension = ['pdf'];
            var file_size = value.files[0].size;
            var filevalue = value.value;
            if (
                $.inArray(filevalue.split(".").pop().toLowerCase(), fileExtension) == -1
            ) {
                $("#File" + id).val("");
                $("#sign").attr("src", "");
                error("Please Upload File in jpg jpeg Format.");
            } else if (file_size > 2000000) {
                $("#File" + id).val("");
                $("#sign").attr("src", "");
                error("File Size should not exceed 2 Mb.");
            }
        }
        $(document).ready(function() {
            function toggleMedicalCertificate() {
           
                if ($('#is_applicant_suffering_disease').is(':checked')) {
                     
                    $('.medical_certificate-div').show();
                   
                    // has $applicationview->medical_certificate
                    if (!$('#medical_certificate').val() && !{{ isset($applicationview->medical_certificate) ? 'true' : 'false' }}) {
                        $('#medical_certificate').prop('required', true);
                    }
                } else {
                    $('.medical_certificate-div').hide();
                    $('#medical_certificate').prop('required', false);
                }
            }

            toggleMedicalCertificate();

            $('#is_applicant_suffering_disease').on('change', toggleMedicalCertificate);
        });
    </script>
@endpush
