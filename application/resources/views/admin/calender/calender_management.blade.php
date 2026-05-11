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
				<h4 class="mb-0">Calendar Management</h4>
			</div>
			<div class="card">
				<div class="card-body">

					<div class="row" style="margin-left: 0;">
					<div class="col-md-2">
					<label for="inputPassword" class="col-form-label" style="font-weight: 400;">Type of Events</label>

						</div>



						<div class="col-md-2">
							<select id="myselection" class="form-select">
							<option >Select</option>	<option value="One">Coaching Camp</option>
	<option value="Two">Competition Name</option>
</select>
						</div>

						<div class="col-md-8 text-right">
						<a href="{{ route('allevent') }}" class="btn btn-outline-dark float-end">View All Events</a>

						</div>


					</div>



				</div>
			</div>
			<div class=" myDiv" id="showOne">
			<div class="card">
				<div class="card-header">
					<b>Coaching Camp</b>
				</div>

				<div class="card-body">

					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Sport Name</label>
								<select class="form-select">
									<option selected>Select</option>
									<option value="1"></option>
									<option value="2"></option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Coaching Camp Name </label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Venue </label>

								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>From Date</label>

								<input type="date" class="form-control">
							</div>
						</div>


						<div class="col-md-3">
							<div class="form-group">
								<label>To Date </label>

								<input type="date" class="form-control">
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>&nbsp;</label>

								<div class="upload-btn-wrapper">
									<button class="btn">Upload Document</button>
									<input type="file" name="myfile"/>
								</div>
							</div>
						</div>

<div class="col-md-3">
							<div class="form-group">
								<label style="display: block;">&nbsp;</label>


									<button class="btn  btn-outline-success w-100">Submit</button>

							</div>
						</div>

					</div>
				</div>


			</div>

			</div>

			<div class="myDiv" id="showTwo">
			<div class="card">
				<div class="card-header">
					<b>Competition Name</b>
				</div>

				<div class="card-body">

					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Sport Name</label>
								<select class="form-select">
									<option selected>Select</option>
									<option value="1"></option>
									<option value="2"></option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Coaching Camp Name </label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Venue </label>

								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>From Date</label>

								<input type="date" class="form-control">
							</div>
						</div>


						<div class="col-md-3">
							<div class="form-group">
								<label>To Date </label>

								<input type="date" class="form-control">
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-group">
								<label>&nbsp;</label>

								<div class="upload-btn-wrapper">
									<button class="btn">Upload Document</button>
									<input type="file" name="myfile"/>
								</div>
							</div>
						</div>

<div class="col-md-3">
							<div class="form-group">
								<label style="display: block;">&nbsp;</label>


									<button class="btn  btn-outline-success w-100">Submit</button>

							</div>
						</div>

					</div>
				</div>


			</div>


			</div>

			<div class="card">
				<div class="card-header">
					<b>Event List</b>
				</div>

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
