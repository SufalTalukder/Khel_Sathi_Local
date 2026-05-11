@extends( 'layouts\gymnasium_swimming_dashboard' )
@section('content')

<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <form action="{{route('gymnasium_swimming_changepasswordStore')}}" id="gymsubmit" class="needs-validation" novalidate method="post">

            <div class="row">
                <div class="col-12">
                    <div class="pageheader" id="menu-margin">
                        <h4 class="mb-0">Change Password </h4>
                    </div>
                </div>
                <div class="col-md-12 mb-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-1 col-md-3">
                                    <label for="exampleFormControlInput1" class="form-label">Old Password</label>
                                    <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                                        <input type="password" placeholder="Password/पासवर्ड" name="old_password" class="form-control text-start" id="password-field1" value="{{old('oldpassword')}}" required>
                                        <span toggle="#password-field1" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
                                        @error('oldpassword')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 col-md-3">
                                    <label for="exampleFormControlInput2" class="form-label">New Password</label>
                                    <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                                        <input type="password" placeholder="Password/पासवर्ड" name="new_password" minlength="8" class="form-control text-start" id="password-field" value="{{old('newpassword')}}" required>
                                        <span toggle="#password-field" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
                                        @error('newpassword')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-1 col-md-3">
                                    <label for="exampleFormControlInput3" class="form-label">Confirm Password</label>
                                    <div class="input-group mb-3"> <span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
                                        <input type="password" placeholder="Password/पासवर्ड" minlength="8" name="confirm_password" class="form-control text-start" id="password-field2" value="{{old('confirmpassword')}}" required>
                                        <span toggle="#password-field2" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
                                        @error('confirmpassword')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">&nbsp;</label>
                                    <br>
                                    <button type="submit" class="btn btn-outline-danger rounded-pill">Change Password</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@push('custom-scripts')

<script>



    $("#gymsubmit").submit(function (e) {

        e.preventDefault();
        if ($("#gymsubmit")[0].checkValidity() === false) {
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
        $("#gymsubmit").addClass("was-validated");
    });




    </script>
@endpush
