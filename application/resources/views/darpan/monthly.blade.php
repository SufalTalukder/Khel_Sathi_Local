@extends( 'layouts/darpan_nav' )
@section( 'content' )

	
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">List of Monthly Pension Applicant
            <a href="{{ url('darpan') }}"  class="btn btn-sm  btn-outline-primary ms-2 float-end " ><span class="icons icon-list"></span> Dashboard</a>
			</h4>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="mb-4">
					<form action="{{ url('darpan/monthly') }}" class="needs-validation" method="POST" autocomplete="off" id="formHostelMaster" novalidate>
						@csrf
						<div class="row">
						<div class="col-md-4">
								<div id="list1" class="dropdown-check-list">
									<label for="city_filter">District</label>
									<select class="form-control" id="city_filter" name="city_filter">
										<option value="all">--All--</option>
										@foreach($cities as $city)
										<option  {{$city == ($city->city) ? 'Selected':''}} value="{{ $city->city }}">{{ $city->city }}</option>
										</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="year_filter">Year</label>
									<select class="form-control" id="year_filter" name="year_filter">
										<option value="all">--All--</option>
										@for ($x = 2017; $x <= date("Y"); $x++) 
										<option {{$year ==$x ? 'Selected':''}} value="{{ $x }}">{{ $x }}</option>
										</option>
										@endfor
									</select>
								</div>
							</div>
					<!--  </div> -->
					<!--  <div class="row"> -->
							<div class="col-md-2 d-grid">
								<label class="form-label">&nbsp;</label>
								<button class="btn btn-primary form-group" type="submit">Search</button>
							</div>
							<div class="col-md-2 d-grid">
								<label class="form-label">&nbsp;</label>
								<a href="{{url('darpan/monthly')}}" class="btn btn-primary form-group" type="submit">Reset</a>
							</div>
						</div>
					</form>
				</div>
				

					<div class="table-responsive">
						<table  id="dataTable" class="table table-striped table-bordered datatable">
							<thead>   
								<tr>
									<th style="width: 50px;">S.No.</th>
									<th>District</th>
									<th>Applicant’s Name</th>
									<th>Mobile no.</th>
									<th>Email ID</th>
									<th>Year</th>
									<th>Status</th>
									
								</tr>
							</thead>
							<tbody>
								@foreach($data as $key=>$list)
								<tr>
									<td>{{$key+1}}</td>
									<td>{{$list->district}}</td> 
									<td>{{$list->name}}</td>
									<td>{{$list->mobile}}</td>  
									<td>{{$list->email}}</td>  
									<td>{{$list->year}}</td>  
									 <td>@if($list->status==2)Accepted @else Rejected @endif</td>
								</tr>
								@endforeach
							</tbody>
						</table>

					</div>
			</div>
		</div>



@endsection
