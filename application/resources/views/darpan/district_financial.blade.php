@extends( 'layouts/darpan_nav' )
@section( 'content' )


		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">List of Financial Assistance Applicant
            <a href="{{ url('darpan') }}"  class="btn btn-sm  btn-outline-primary ms-2 float-end " ><span class="icons icon-list"></span> Dashboard</a>
			</h4>
		</div>
		<div class="card">
			<div class="card-body">
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
									<td align="center"><a href="{{ url('darpan/financial/'.$list->district) }}">{{$list->total}}</a></td>

									<td align="center"><a href="{{ url('darpan/financial/1/'.$list->district) }}">{{$list->total_pending}}</a></td>
									<td align="center"><a href="{{ url('darpan/financial/2/'.$list->district) }}">{{$list->total_accepted}}</a></td>
									<td align="center"><a href="{{ url('darpan/financial/3/'.$list->district) }}">{{$list->total_rejected}}</a></td>

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
