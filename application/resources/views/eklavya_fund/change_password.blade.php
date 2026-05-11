@extends( 'layouts\eklavya_fund_dashboard_layout' )
@section('content')
 <!-- InstanceBeginEditable name="Content Area" -->
 <div class="container-fluid pagecontentbody">
    <div class="row">
        <div class="col-12">
            <div class="col-md-12 pageheader mb-0">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Change Password</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="tab-content border-all-side">
                <div class="pagebody sidepage-pading pt-3 pb-3">
                    <div class="card mt-3 mb-3">
                        <div class="card-body">
                            <form action="{{ url('eklavyaFund/change_password') }}" method="post" id="ajxReload" class="needs-validation" novalidate>
                                <div class="row">
									<div class="mb-1 col-md-3">
										<label for="exampleFormControlInput1" class="form-label">Current Password/वर्तमान पासवर्ड</label>
										<div class="input-group mb-3">
											<span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
											<input required type="password" name="old_password" placeholder="Password/पासवर्ड" class="form-control" id="password-field1">
											<span toggle="#password-field1" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
										</div>
									</div>
									<div class="mb-1 col-md-3">
										<label for="exampleFormControlInput2" class="form-label">New Password/नया पासवर्ड</label>
										<div class="input-group mb-3">
											<span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
											<input required type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password/पासवर्ड" class="form-control" id="password-field">
											<span toggle="#password-field" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
											<div class="invalid-feedback">
												Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.
											</div>
										</div>
									</div>
									<div class="mb-1 col-md-3">
										<label for="exampleFormControlInput3" class="form-label">Confirm Password/पासवर्ड की पुष्टि</label>
										<div class="input-group mb-3">
											<span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
											<input required type="password" name="password_confirmation" placeholder="Password/पासवर्ड" class="form-control" id="password-field2">
											<span toggle="#password-field2" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
										</div>
									</div>


									<div class="col-md-3">
										<label class="form-label">&nbsp;</label><br>
										<button type="submit" class="btn btn-info">Change Password/पासवर्ड बदलें</button>
									</div>
								</div>
                            </form>
                            {{-- <p>Last Changed 7/29/2020, 9:50 am</p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- InstanceEndEditable -->


@endsection

@push('custom-scripts')
<script>
    $(".toggle-password").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
@endpush
