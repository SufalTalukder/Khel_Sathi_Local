@extends( 'layouts\superadmin_layout' )
@section( 'content' )
	<style>
		.form-group label {
			margin-left: 0;
		}
.myDiv{
	display:none;

}
	</style>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="pageheader" id="menu-margin">
				<h4 class="mb-0">All Events

				<a href="{{ route('allevent') }}" class="btn btn-outline-dark float-end">Back</a>


				</h4>
			</div>
			<div class="card">
				<div class="card-body">

				<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label>Sport Name</label>
								<select class="form-select">
									<option selected>Select</option>
									<option value="1"></option>
									<option value="2"></option>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Coaching Camp Name </label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Venue </label>

								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>From Date</label>

								<input type="date" class="form-control">
							</div>
						</div>


						<div class="col-md-2">
							<div class="form-group">
								<label>To Date </label>

								<input type="date" class="form-control">
							</div>
						</div>

					
<div class="col-md-2">
							<div class="form-group">
								<label style="display: block;">&nbsp;</label>


									<button class="btn  btn-outline-success w-100">Search</button>

							</div>
						</div>

					</div>


				</div>
			</div>
		


			<div class="card">
			

				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordred ">

							<thead>
								<tr>
								  <th>Type of Events</th>

									<th>Sport Name</th>
									<th>Coaching Camp Name </th>
									<th>Venue </th>
									<th>From Date</th>
									<th>
To Date </th>
									<th>Document</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>



								<tr>
								  <td>&nbsp;</td>

									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td><a href="#" class="btn btn-outline-dark local">Download</a></td>
									<td><a class="btn btn-sm btn-dark stateup32" >
                                                            <i class="icon-pencil"></i>
                                                        </a>

									<a class="btn btn-sm btn-outline-danger stateup32" >
                                                            <i class="icon-trash"></i>
                                                        </a>
									</td>
								</tr>
							</tbody>
						</table>



					</div>
				</div>
			</div>


		</div>
	</div>

</div>

@endsection
