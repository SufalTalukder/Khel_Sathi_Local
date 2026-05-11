@extends( 'layouts/superadmin_layout' )
@section( 'content' )
	<div class="row">
		<x-sidebar_left_menu/>
		<div class="col-md-6">
			<div class="pageheader" id="menu-margin">
				<h4 class="mb-0">User
				
					</h4>
			</div>



			<div class="card">

				<div class="card-body">

					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<label for="role">Name</label>

								<input class="form-control" style="pointer-events: none;" type="text" value="{{ Auth::guard('admin')->user()->name }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="role">Username</label>

								<input class="form-control" style="pointer-events: none;" type="text" value="{{ Auth::guard('admin')->user()->username }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="role">Email</label>

								<input class="form-control" style="pointer-events: none;" type="text" value="{{ Auth::guard('admin')->user()->email }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="role">Mobile</label>

								<input class="form-control" style="pointer-events: none;" type="text" value="{{ Auth::guard('admin')->user()->mobile }}">
							</div>
						</div>
						<div class="col-md-6">

							<div class="form-group">
								<label for="role">Designation</label>

								<input class="form-control" style="pointer-events: none;" type="text" value="{{ Auth::guard('admin')->user()->designation }}">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>

		@endsection
