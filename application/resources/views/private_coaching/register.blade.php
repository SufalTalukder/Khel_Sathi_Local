@extends( 'layouts\private_coaching_layout' )
@section('content')





<div class="container-fluid">
    <a href="#" title="Instruction" class="help" data-bs-toggle="modal" data-bs-target="#myModal">
        <span class="item"> <img src="{{ url('RPCAA') }}/images/instruction.png" /> </span>
        <div class="circle" style="animation-delay: 0s"></div>
        <div class="circle" style="animation-delay: 1s"></div>
        <div class="circle" style="animation-delay: 2s"></div>
        <div class="circle" style="animation-delay: 3s"></div>
    </a>
    <div class="row">
        <div class="col-md-6 loginsidebar">
            <div class="row justify-content-center">
                <div class="col-4 col-lg-2 text-center mb-3"> <img src="{{ url('RPCAA') }}/images/logo.png" class="img-fluid"> </div>
                <div class="col-md-12 col-12 deptname">
                    <h3 class="hd-org">Khel Sathi Portal/खेल साथी पोर्टल</h3>
                    <h5>
                        Department of Sports, Government of Uttar Pradesh<br>
                        खेल विभाग, उत्तर प्रदेश सरकार
                    </h5>
                </div>
                <div class="col-md-12 col-12 deptname">
                    <h5 class="text-danger">
                        Registration of Pvt. Coaching Academies / Associations ,Gyms, Swimming Pools<br /> निजी कोचिंग अकादमियों / संघों, जिम, और तरणताल का पंजीकरण
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-md-6 bg-light1">
            <div class="login-form">
                <h3 class="mb-0 text-center">Registration/पंजीकरण</h3>
                <div class="d-flex text-center justify-content-center align-items-center mt-2">
                    <span class="fw-normal">
                        <a href="{{route('private_coaching_login')}}" class="fw-bold">
                            Already Registered ? Click Here to Login<br>
                            पहले से ही पंजीकृत ? लॉगिन करने हेतु यहां क्लिक करें
                        </a>
                    </span>
                </div>
                <form action="{{ route('private_coaching_register_store') }}" id="submitform" class="mt-2 needs-validation" novalidate
                method="post" >
                @csrf
                    <div class="form-group">
                        <label>1. Full Name/पूरा नाम</label>
                        <input type="text" class="form-control" id="fname" name="name"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" maxlength="255" required>
                    </div>

                    <div class="form-group">
                        <label>2. Designation/पदनाम</label>
                        <input type="text" class="form-control" id="fname" name="designation"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label>3. Email ID/ईमेल आईडी</label>
                        <input type="email" class="form-control" pattern="^[^ ]+@[^ ]+\.[a-z]{2,6}$"  name="email" placeholder="Email ID" maxlength="255" required>
                    </div>


                    <div class="form-group row ">
                        <label>4. Mobile No./मोबाइल नंबर</label>
                        <div class="input-group">
                            <div class="input-group-prepend"> <span class="input-group-text" style="padding: 0.5rem 0.75rem;">+91</span> </div>
                            <input type="text" name="mobile" class="form-control" pattern="[6-9][0-9]{9}$" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label>5. Aadhar No./आधार नंबर</label>
                            <input type="text" name="aadhar_no" class="form-control" pattern="[2-9]{1}[0-9]{11}" maxlength="12" minlength="12" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                        
                    </div>
                    <div class="form-group">
                        <label>5. 	Captcha/कैप्चा</label>
                        <div class="row">
                            <div class="col-lg-5"> <span id="captchaDiv">       <span class="unselectable" id="p_refresh">{{$Code1}}+{{$Code2}}</span>

                                <input name="captchacode" type="hidden" class="form-control captchacode unselectable h4" value="{{$Code1+$Code2}}" readonly>
                            </span> </div>
                            <div class="col-md-1 refresh">
                                <div class="cp_refresh"><a href="javascript:void(0)" class="refresh4554554" title="Refresh Captcha"><span
                                    class="fas fa-redo"></span></a> </div>
                            </div>
                            <div class="col-lg-6">
                                <input name="captcha" type="text" placeholder="Enter Captcha" class="form-control" required>
                                <small class="text-muted"></small>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <button type="submit" class="btn btn-outline-success "><i class="fa fa-user-plus"></i> Register <span class="fa fa-arrow-right"></span></button>
                        </div>
                        <div class="col-md-6 d-grid">
                            <button type="reset" class="btn btn-outline-secondary "><i class="fa fa-undo"></i> Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




@endsection


@push('custom-scripts')
<script>
    $(".refresh4554554").on("click", function () {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/private_coaching/cp_refresh/",
        dataType: "json",
        success: function (res) {
            console.log(res)
            $("#p_refresh").html(res.Code1 +'+'+ res.Code2);
            $(".captchacode").val(res.Code1 + res.Code2);
            // $(".refreshc").val(res.capchaCode);
        },
    });
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

</script>


@endpush
