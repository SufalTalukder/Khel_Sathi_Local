@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="row" id="menu-margin">
	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Change Password</h4>
		</div>

		<form action="{{ route('adminupdatePassword') }}" method="post" id="ajxReload" class="needs-validation" novalidate>

			<div class="row">
				<div class="mb-1 col-md-4">
					<div class="card">

						<div class="card-body">
							<label for="exampleFormControlInput1" class="form-label">Current Password</label>
							<div class="input-group mb-3">
								<span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
								<input required type="password" name="old_password" placeholder="Password/पासवर्ड" class="form-control" id="password-field1">
								<span toggle="#password-field1" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
							</div>

							<label for="exampleFormControlInput2" class="form-label">New Password</label>
							<div class="input-group mb-3">
								<span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
								<!-- <input required type="password" name="password" placeholder="Password/पासवर्ड" class="form-control" id="password-field"> -->
								<!-- <span toggle="#password-field" class="input-group-text toggle-password fa fa-fw fa-eye"></span> -->
								<input required type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password/पासवर्ड" class="form-control" id="password-field">
								<span toggle="#password-field" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
								<div class="invalid-feedback">
									Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.
								</div>
							</div>

							<label for="exampleFormControlInput3" class="form-label">Confirm Password</label>
							<div class="input-group mb-3">
								<span class="input-group-text" id="basic-addon1"><span class="icons icon-lock-open"></span></span>
								<input required type="password" name="password_confirmation" placeholder="Password/पासवर्ड" class="form-control" id="password-field2">
								<span toggle="#password-field2" class="input-group-text toggle-password fa fa-fw fa-eye"></span>
							</div>

							<button type="submit" class="btn btn-info">Change Password</button>
						</div>
					</div>
				</div>
			</div>
		</form>

	</div>

</div>


@endsection
