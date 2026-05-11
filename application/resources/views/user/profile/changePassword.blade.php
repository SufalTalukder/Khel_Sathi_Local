@extends( 'layouts/layout' )
@section( 'content' )


<div class="container">	
		<div class="pageheader">
			<div class="row">
				<div class="col-md-10">
											<h4>Change Password/पासवर्ड बदलें</h4>

				</div>
				
				<div class="col-md-2">
					
					
					<a class="btn btn-sm btn-dark w-100" href="{{ route('dashboard') }}">Dashboard/डैशबोर्ड</a>
					
				</div>
		

			</div>
		</div>



		<div class="card mt-3 mb-3">
						<div class="card-body">



							<form action="{{ url('updatePassword') }}" method="post" id="ajxReload" class="needs-validation" novalidate>

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




							<!-- <p>Last Changed 7/29/2020, 9:50 am</p> -->
						</div>
					</div>


		</div>
	</div>
	@endsection
