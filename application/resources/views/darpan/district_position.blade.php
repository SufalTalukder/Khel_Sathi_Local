@extends( 'layouts/darpan_nav' )
@section( 'content' )


		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">List of Award Applicant
            <a href="{{ url('darpan') }}"  class="btn btn-sm  btn-outline-primary ms-2 float-end " ><span class="icons icon-list"></span> Dashboard</a>
			</h4>
		</div>
		<div class="card">
			<div class="card-body">
				<!-- <div class="mb-4">
					<form action="{{ url('darpan/direct') }}" class="needs-validation" method="POST" autocomplete="off" id="formHostelMaster" novalidate>
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
							<div class="col-md-2 d-grid">
								<label class="form-label">&nbsp;</label>
								<button class="btn btn-primary form-group" type="submit">Search</button>
							</div>
							<div class="col-md-2 d-grid">
								<label class="form-label">&nbsp;</label>
								<a href="{{url('darpan/direct')}}" class="btn btn-primary form-group" type="submit">Reset</a>
							</div>
						</div>
					</form>
				</div> -->


					<div class="table-responsive">
						<table  id="dataTable" class="table table-striped table-bordered datatable">
							<thead>
								<tr>
                                    <th>S.No</th>
									<th>District Name</th>
									<th align="center">Total Application Received</th>
									<th align="center">Applications Pending</th>
									<th align="center">Applications Accepted</th>
									<th align="center">Applications Rejected</th>
								</tr>
							</thead>
							<tbody>
								@foreach($data as $key=>$list)
								<tr>
                                    <td>{{$key + 1}}</td>
									<td>{{$list->district}}</td>
									<td align="center"><a href="{{ url('darpan/position/'.$list->district) }}">{{$list->total}}</a></td>

									<td align="center"><a href="{{ url('darpan/position/1/'.$list->district) }}">{{$list->total_pending}}</a></td>
									<td align="center"><a href="{{ url('darpan/position/2/'.$list->district) }}">{{$list->total_accepted}}</a></td>
									<td align="center"><a href="{{ url('darpan/position/3/'.$list->district) }}">{{$list->total_rejected}}</a></td>

								</tr>
								@endforeach
                                <tr>

                                    <td>{{ count($data)+1 }}</td>
                                    <td align="center" >Total</td>
                                    <td align="center">{{ $data_total[0]->total }}</td>
                                    <td align="center">{{ $data_total[0]->total_pending }}</td>
                                    <td align="center">{{ $data_total[0]->total_accepted }}</td>
                                    <td align="center">{{ $data_total[0]->total_rejected }}</td>

                                </tr>
							</tbody>
						</table>

					</div>
			</div>
		</div>



@endsection
