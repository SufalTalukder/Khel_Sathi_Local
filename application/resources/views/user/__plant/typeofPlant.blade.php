@extends('layouts/layout')
@section('content')
<style>
    .mr-2 {
        margin-right: 4px !important;
    }
</style>
<div class="row">
    <div class="col-2">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary backbtn"><span class="icons icon-arrow-left"></span> Back to Dashboard</a>
        <div class="left-sidebar">
            <div >
                <ul>
                    <li>
                        <a href="{{ route('cp') }}">
                            <span class="icons icon-arrow-right"></span>Company Profile/Basic Details
                        </a>
                    </li>
                    <li>
                        @if(Auth::user()->profile_complete==1)
                        <a href="{{ url('registered-project') }}">
                            <span class="icons icon-arrow-right"></span>Project Details
                        </a>
                        @else
                        <a href="javascript:void(0)" onclick="showMsg()">
                            <span class="icons icon-arrow-right"></span>Project Details
                        </a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-10">
        <div class="col-md-12 pageheader mb-0">
            <div class="row">
                <div class="col-md-12">
                    <h4>Project Details</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Project Details</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="tab-content border-all-side">
            <div class="pagebody sidepage-pading pt-3 pb-3">
                <div class="emp-profile">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-head">
                                <!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="home-tab" data-toggle="tab" href="javascript:void(0)" role="tab" aria-controls="home" aria-selected="true">Project Details</a> </li>
                                </ul> -->
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <label for="username" class="placeholder">Project Category<span class="text-danger">*</span></label>
                                                    <div class="form-control projcat">

                                                        <div class="form-check form-check-inline" onclick="showPPA()">
                                                            <input value="1" class="form-check-input" type="radio" name="type" id="checkbox1">
                                                            <label class="form-check-label" for="class1">1. Solar Power Project PPA with UPPCL</label>
                                                        </div>

                                                        <div class="form-check form-check-inline" onclick="openAccessPlant()">
                                                            <input value="2" class="form-check-input" type="radio" name="type" id="checkbox2">
                                                            <label class="form-check-label" for="class7">2. Solar Power Project under Open Access</label>
                                                        </div>

                                                        <div class="form-check form-check-inline" onclick="showPPS()">
                                                            <input value="3" class="form-check-input" type="radio" name="type" id="Checkbox6">
                                                            <label class="form-check-label" for="class7">3. Solar Power Park Public Sector</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" onclick="showPPSPrivate()">
                                                            <input value="4" class="form-check-input" type="radio" name="type" id="Checkbox7">
                                                            <label class="form-check-label" for="class7">4. Solar Power Park Private Sector</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" onclick="hidePlant()">
                                                            <input value="5" class="form-check-input" type="radio" name="type" id="Checkbox7">
                                                            <label class="form-check-label" for="class7">5. Solar Project with Storage</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" onclick="hidePlant()">
                                                            <input value="6" class="form-check-input" type="radio" name="type" id="Checkbox7">
                                                            <label class="form-check-label" for="class7">6. Solarization of Agriculture Feeder</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" onclick="hidePlant()">
                                                            <input value="7" class="form-check-input" type="radio" name="type" id="Checkbox7">
                                                            <label class="form-check-label" for="class7">7. Solarization of PTW</label>
                                                        </div>

                                                        <div class="form-check form-check-inline" onclick="hidePlant()">
                                                            <input value="8" class="form-check-input" type="radio" name="type" id="Checkbox5">
                                                            <label class="form-check-label" for="class7">8. Solar Roof Top in Government Buildings</label>
                                                        </div>

                                                        <div class="form-check form-check-inline" onclick="otherInformation()">
                                                            <input value="8" class="form-check-input" type="radio" name="type" id="Checkbox5">
                                                            <label class="form-check-label" for="class7">9. Other</label>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- <div class="form-group mb-3" style="display:none" id="otherInformation_11">
                                                    <form action="AAAA" method="post" id="reloadSolar" class="needs-validation" novalidate="">
                                                        <label for="username" class="placeholder">Remark<span class="text-danger">*</span></label>

                                                        <textarea class="form-control" rows="4" name="remark" id="remark" required></textarea>
                                                        <div class="col-md-2 d-grid mt-2">
                                                            <button type="submit" class="btn btn-primary">Submit/???? ???</button>
                                                        </div>
                                                    </form>
                                                </div> -->
                                            </div>
                                        </div>


                                        <div class="bhoechie-footer hidebtn otherInformation othersolar" style="display:none">
                                            <div class="row justify-content-center">
                                                <div class="col-md-2 d-grid">
                                                    <a href="{{ route('other') }}" class="btn btn-primary">Proceed To Apply</a>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="bhoechie-footer hidebtn openAccessplant" style="display:none">
                                            <div class="row justify-content-center">
                                                <div class="col-md-2 d-grid">
                                                    <a href="{{ route('openaccess') }}" class="btn btn-primary">Proceed To Apply</a>
                                                </div>
                                                <!-- <div class="col-md-2 d-grid">
                                                    <button type="reset" class="btn btn-light">Reset</button>
                                                </div> -->
                                            </div>
                                        </div>

                                        <div class="bhoechie-footer hidebtn ppsoler" style="display:none">
                                            <div class="row justify-content-center">
                                                <div class="col-md-2 d-grid">
                                                    <a href="{{ route('pro_reg') }}" class="btn btn-primary">Proceed To Apply</a>
                                                </div>
                                                <!-- <div class="col-md-2 d-grid">
                                                    <button type="reset" class="btn btn-light">Reset</button>
                                                </div> -->
                                            </div>
                                        </div>


                                        <div class="bhoechie-footer hidebtn ppsolerppark" style="display:none">
                                            <div class="row justify-content-center">
                                                <div class="col-md-2 d-grid">
                                                    <a href="{{ route('solarPowerPark') }}" class="btn btn-primary">Proceed To Apply</a>
                                                </div>
                                                <!-- <div class="col-md-2 d-grid">
                                                    <button type="reset" class="btn btn-light">Reset</button>
                                                </div> -->
                                            </div>
                                        </div>

                                        <div class="bhoechie-footer hidebtn ppsolerpparkprivate" style="display:none">
                                            <div class="row justify-content-center">
                                                <div class="col-md-2 d-grid">
                                                    <a href="{{ route('solarPowerPrivatePark') }}" class="btn btn-primary">Proceed To Apply</a>
                                                </div>
                                                <!-- <div class="col-md-2 d-grid">
                                                    <button type="reset" class="btn btn-light">Reset</button>
                                                </div> -->
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
<script type="text/javascript">
    function showMsg() {
        info("Please Complete Your Profile");
    }
    function otherInformation()
    {
        $(".hidebtn").hide();
        $(".otherInformation").show();
    }
</script>
@endpush
