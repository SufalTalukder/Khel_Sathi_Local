@extends( 'layouts\layout' )
@section('content')
<style>
    .modal-backdrop {

        DISPLAY: NONE;
    }

    #Puprose1 {
        MARGIN-TOP: 5EM;
        z-index: 9999999999999;

    }
</style>
<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        Application Form/आवेदन फार्म
                        <a href="{{ route('dashboard') }}"
                            class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill">
                            <span class="icons icon-arrow-left"></span>Back to Dashboard
                        </a>
                    </h4>
                </div>
            </div>
            <div class="col-12">
                <div class="bhoechie-tab-content">
                    <div class="form-scroll">
                        <div class="nano-content">
                            <div class="row">
                                <div class="col-12">
                                    <fieldset>
                                        <legend>Registration Details/पंजीकरण का विवरण</legend>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">1. Purpose/उद्देश्य<span
                                                            class="text-danger">*</span></label>
                                                    <button type="button" class="btn btn-light w-100" data-bs-toggle="modal" data-bs-target="#Puprose1" style="border: 1px solid #d7d7d7;">
                                                        <i class="fas fa-plus"></i> Select
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">2. पूरा नाम/Full Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        value="{{ Auth::guard('EklavyaKreedaKosh')->user()->name  }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">3. ईमेल पता/Email ID<span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" class="form-control"
                                                        value="{{ Auth::guard('EklavyaKreedaKosh')->user()->email  }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">4. मोबाइल नंबर/Mobile Number
                                                        <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" value="{{ Auth::guard('EklavyaKreedaKosh')->user()->mobile  }}"
                                                        disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <form action="{{ route('eklavya_kreeda_kosh_applicationBasicForm') }}" id="eklsubmit" class="needs-validation" novalidate enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12">
                                        <fieldset>
                                            <legend>Personal Details/व्यक्तिगत विवरण</legend>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">1. Father's Name/पिता का नाम <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" maxlength="255" value="{{ isset($summary)  ? $summary->father_name : old('father_name')  }}" name="father_name" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">2. Mother's Name/माँ का नाम <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="mother_name" value="{{ isset($summary)  ? $summary->mother_name : old('mother_name')  }}" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" maxlength="255" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">3. Gender/लिंग
                                                            <span class="text-danger">*</span></label>
                                                        <select class="form-control form-select" required name="gender">
                                                            <option value="">Select</option>
                                                            <option value="1" @isset($summary) @if ($summary->gender == '1') selected @endif @endisset >Male </option>
                                                            <option value="2" @isset($summary) @if ($summary->gender == '2') selected @endif @endisset>Female
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">4. Date of Birth/जन्मतिथि
                                                            <span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" name="dob" max="{{ date('Y-m-d') }}" value="{{ isset($summary) ? dmy($summary->dob): old('dob')  }}" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">5. Aadhaar No./आधार नंबर <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="aadhaar" maxlength="12" minlength="12" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required value="{{ isset($summary)  ? $summary->aadhaar : old('aadhaar')  }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">6. Nationality/राष्ट्रीयता <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control form-select" name="nationality">
                                                            <option value="">Select</option>
                                                            <option value="Indian" selected>Indian</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">7. Alternate Phone
                                                            Number/वैकल्पिक फ़ोन नंबर
                                                        </label>
                                                        <input type="text" pattern="[6-9][0-9]{9}$" class="form-control" maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="alternative_phone" value="{{ isset($summary)  ? $summary->phone : old('alternative_phone')  }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12">
                                        <fieldset>
                                            <legend>Upload/दस्तावेज़</legend>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>1. Profile Picture/<br>प्रोफ़ाइल फोटो<span
                                                                class="text-danger">*</span></label>
                                                        @isset($summary) @if ($summary->profile_picture)
                                                        <div class="profpic">
                                                            <img src="{{ asset('eklavya_krida_kosh/profile_picture/')}}/{{$summary->profile_picture}}" class="img-fluid">
                                                        </div>
                                                        @endif @endisset
                                                        <input type="file" class="form-control" name="profile_picture" {{ isset($summary)  ? '' : 'required'  }}>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>2. Signature of Applicant/आवेदक के हस्ताक्षर <span
                                                                class="text-danger">*</span></label>
                                                        @isset($summary) @if ($summary->signature)
                                                        <div class="sign">
                                                            <img src="{{ asset('eklavya_krida_kosh/signature/')}}/{{$summary->profile_picture}}" class="img-fluid">
                                                        </div>
                                                        @endif @endisset
                                                        <input type="file" class="form-control" name="signature" {{ isset($summary)  ? '' : 'required'  }}>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>3. High School Certificate/हाई स्कूल प्रमाण पत्र <span class="text-danger">*</span>
                                                        </label>
                                                        @isset($summary)
                                                        <div class="sign">
                                                            <img src="images/signature.png" class="img-fluid"
                                                                style="filter: blur(1.5rem)">
                                                        </div>
                                                        @endisset
                                                        <input type="file" class="form-control" name="high_school_certificate" {{ isset($summary)  ? '' : 'required'  }}>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>4. Domicile Certificate of UP/यूपी का निवास प्रमाण पत्र

                                                            <span class="text-danger">*</span></label>
                                                        @isset($summary)
                                                        <div class="sign">
                                                            <img src="images/signature.png" class="img-fluid"
                                                                style="filter: blur(1.5rem)">
                                                        </div>
                                                        @endisset
                                                        <input type="file" class="form-control" name="domicile_certificate" {{ isset($summary)  ? '' : 'required'  }}>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>5. Highest Education Qualification/उच्चतम शिक्षा योग्यता
                                                            <span class="text-danger">*</span></label>
                                                        @isset($summary)
                                                        <div class="sign">
                                                            <img src="images/signature.png" class="img-fluid"
                                                                style="filter: blur(1.5rem)">
                                                        </div>
                                                        @endisset
                                                        <input type="file" class="form-control" name="highest_qualification_certificate" {{ isset($summary)  ? '' : 'required'  }}>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-12">
                                        <fieldset>
                                            <legend>Communication Address/संचार पता</legend>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="placeholder"><b>Permanent Address/स्थायी पता</b></label>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">1. Address/पता <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="permanent_address" id="address2" value="{{ isset($summary)  ? $summary->permanent_address : old('permanent_address')  }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">2. District/जनपद <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control form-select" name="permanent_district" id="district2" required>
                                                            <option value="">Select</option>
                                                            @foreach ($districts as $item)
                                                            <option value="{{ $item->id }}" @isset($summary) @if ($summary->permanent_district == $item->id ) selected @endif @endisset > {{ $item->city }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">3. Pincode/पिन कोड <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" name="permanent_pin" min="100000" max="999999" value="{{ isset($summary)  ? $summary->permanent_pin : old('permanent_pin')  }}" id="permanent_pincode" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input same" type="checkbox" value=""
                                                    id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <b>Use same Correspondace Address/एक ही पत्राचार पते का उपयोग करें</b>
                                                </label>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">1. Address/पता <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="correspondance_address" id="address1" value="{{ isset($summary)  ? $summary->correspondance_address : old('correspondance_address')  }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">2. State/राज्य
                                                            <span class="text-danger">*</span></label>
                                                        <select class="form-control form-select" id="state1" onchange="get_city(this.value,'district1')" name="correspondance_state" required>
                                                            <option value="">Select</option>
                                                            @foreach ($states as $item)
                                                            <option value="{{ $item->id }}" @isset($summary) @if ($summary->correspondance_state == $item->id ) selected @endif @endisset >{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">3. District/जनपद <span
                                                                class="text-danger">*</span></label>
                                                        <input type="hidden" id="district5" @isset($summary) value="{{ $summary->correspondance_district }}" @endisset>
                                                        <select class="form-control form-select" id="district1" name="correspondance_district" required>
                                                            <option value="">Select</option>
                                                            @foreach ($districtall as $item)
                                                            <option value="{{ $item->id }}" @isset($summary) @if ($summary->correspondance_district == $item->id ) selected @endif @endisset > {{ $item->city }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">4. Pincode/पिन कोड <span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" required name="correspondance_pin" min="100000" max="999999" value="{{ isset($summary)  ? $summary->correspondance_pin : old('correspondance_pin')  }}" id="C_pincode" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="modal fade" id="Puprose1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Puprose</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="purpose" id="flexRadioDefault1" @isset($summary) @if ($summary->purpose == "1" ) checked="checked" @endif @endisset value="1">
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Provide fellowships to athletes to enhance their performance and motivation.
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="purpose" id="flexRadioDefault2" @isset($summary) @if ($summary->purpose == "2" ) checked="checked" @endif @endisset value="2">
                                                        <label class="form-check-label" for="flexRadioDefault2">
                                                            Prepare athletes for National and International competitions.
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="purpose" id="flexRadioDefault3" @isset($summary) @if ($summary->purpose == "3" ) checked="checked" @endif @endisset value="3">
                                                        <label class="form-check-label" for="flexRadioDefault3">
                                                            Offer International Training opportunities and expertise to both Athletes and Coaches.
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="purpose" id="flexRadioDefault4" @isset($summary) @if ($summary->purpose == "4" ) checked="checked" @endif @endisset value="4">
                                                        <label class="form-check-label" for="flexRadioDefault4">
                                                            Ensure that athletes have access to comprehensive Health Insurance coverage.
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="purpose" id="flexRadioDefault5" @isset($summary) @if ($summary->purpose == "5" ) checked="checked" @endif @endisset value="5">
                                                        <label class="form-check-label" for="flexRadioDefault5">
                                                            Fund “Sports Research Projects” through financial grants.
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="purpose" id="flexRadioDefault6" @isset($summary) @if ($summary->purpose == "6" ) checked="checked" @endif @endisset value="6">
                                                        <label class="form-check-label" for="flexRadioDefault6">
                                                            Allocate additional incentives for athletes with disabilities, transgender athletes, and female athletes.
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="purpose" id="flexRadioDefault7" @isset($summary) @if ($summary->purpose == "7" ) checked="checked" @endif @endisset value="7">
                                                        <label class="form-check-label" for="flexRadioDefault7">
                                                            Organize promotional visits for sports organizations to districts in UP for talent hunting.
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="purpose" id="flexRadioDefault7" @isset($summary) @if ($summary->purpose == "8" ) checked="checked" @endif @endisset value="8">
                                                        <label class="form-check-label" for="flexRadioDefault7">
                                                            Supply athletes with the necessary sports equipment they require.
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bhoechie-footer">
                                        <div class="row justify-content-center">
                                            <div class="col-md-2 d-grid">
                                                <button type="submit"
                                                    class="btn btn-outline-danger rounded-pill">Save & Proceed</button>
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
@endsection

@push('custom-scripts')
<script>
    function get_city(value, id) {
        // if (value != 23) {
        //     $(".same").attr("disabled", true);
        // } else {
        //     $(".same").removeAttr("disabled");
        // }

        let city = $("#district1").val();

        let h_city = $("#h_district").val();
        let h_city1 = $("#district2").val();
        let h_city5 = $("#district5").val();

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
                    if (h_city1) {
                        option += `<option value="${item.id}" ${item.id==h_city1?'selected':''}>${item.city}</option>`;
                    } else if (h_city5) {

                        option += `<option value="${item.id}" ${item.id==h_city5?'selected':''}>${item.city}</option>`;

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

    $(".same").change((e) => {
        if ($(".same").is(":checked")) {
            let address1 = $("#address2").val();
            let district1 = $("#district2").val();

            let permanent_pincode = $("#permanent_pincode").val();
            $("#state1").val(23);
            $("#address1").val(address1);
            $("#C_pincode").val(permanent_pincode);
            $('#state1').trigger('change');
            $("#district1").val(district1);

        } else {
            $("#address1").val('');
            $("#state1").val('');
            $("#district1").val('');
            $("#C_pincode").val('');


        }
    })

    $("#eklsubmit").submit(function(e) {

        e.preventDefault();
        if ($("#eklsubmit")[0].checkValidity() === false) {
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
        $("#eklsubmit").addClass("was-validated");
    });
</script>
@endpush
