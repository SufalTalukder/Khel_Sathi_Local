@extends( 'layouts/admin_layout' )
@section( 'content' )


		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Erase Login Details</h4>
		</div>
		<div class="card">

			<div class="card-body">
				<form action="{{ asset('assets_admin/delete_login_history') }}" class="needs-validation " id="reload" novalidate method="post">

					<div class="form-group row">
						<label for="name" class="col-md-2">Email Id</label>
						<div class="col-md-3">
							<input type="email" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" class="form-control" id="email" name="email" required>
							<div class="invalid-feedback">
								Please provide a email id.
							</div>
						</div>


						<div class="col-md-3">
							<button class="btn btn-primary" type="submit">Erase</button>

						</div>


					</div>
				</form>

			</div>
		</div>

@endsection

