@extends( 'layouts/admin_layout' )
@section( 'content' )

			<div class="pageheader" id="menu-margin">
				<h4 class="mb-0">Login / Logout Details List			</h4>

			</div>
			<div class="alert alert-warning">

				<div class="row" style="padding-top: 7px;margin-bottom: 10px; ">
					<div class="col-md-3"><label>Name : </label><br> {{$item->name}}</div>
					<div class="col-md-3"><label>Email : </label><br> {{$item->email}}</div>
					<div class="col-md-3"><label>Mobile : </label><br> {{$item->mobile}}</div>
					<div class="col-md-3"><label>Designation : </label><br> {{$item->designation}}</div>
				</div>

			</div>
			<div class="card">

				<div class="card-body">

					<div class="table-responsive">
						<table id="dataTable" class="table table-bordred table-hover bg-white datatable">

							<thead>
								<tr>
									<th width="6%">S.No.</th>
									<!-- <th width="20%">Applicant's Name</th> -->
									<th>Status</th>
									<th>Date</th>
									<!-- <th>Details</th> -->
								</tr>
							</thead>
							<tbody>
								@foreach($lists as $key=>$list)
								<tr>

									<td>{{ $key+1 }}</td>
									<td>@if($list->type==1)Login @else Logout @endif</td>
									<td>{{ dmyHi($list->date) }}</td>

								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		
@endsection
