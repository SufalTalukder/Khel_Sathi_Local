@extends( 'layouts/darpan_nav' )
@section( 'content' )

	
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">List of Award Applicant
            <a href="{{ url('darpan') }}"  class="btn btn-sm  btn-outline-primary ms-2 float-end " ><span class="icons icon-list"></span> Dashboard</a>
			<a  title="List of Nomination for Prize Money" class="btn btn-sm btn-success ms-2 float-end" onclick="ExportToExcel('List of Nomination for Prize Money','xlsx')">
				<i class="fa fa-file-excel"></i>Export to Excel
			</a>
				<!-- <a class="btn btn-success btn-sm float-end" id="dexportExcel">	
					<i class="fa fa-file-excel"></i>
				</a>
				<a class="btn btn-danger btn-sm float-end" id="dexportPdf">   	
					<i class="fa fa-file-pdf"></i>
				</a> -->
			</h4>
		</div>
		<div class="card">
		
			<div class="card-body">
					<div class="mb-4">
						<form action="{{ url()->current() }}" class="needs-validation" method="POST" autocomplete="off" id="formHostelMaster" novalidate>
							@csrf
							<div class="row">
							<div class="col-md-2">
									<div id="list1" class="dropdown-check-list">
										<label for="month">Month</label>
										<select class="form-control" id="month" name="month">
											<option value="all">--All--</option>
											@foreach($months as $month)
											<option {{request()->input('month') == $month->id ? 'selected' : ''}} value="{{ $month->id }}">{{ $month->month_name }}</option>
											</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<!-- <div class="form-group"> -->
										<label for="year_filter">Year</label>
										<select class="form-control" id="year_filter" name="year_filter">
											<option value="all">--All--</option>
											@for ($x = 2017; $x <= date("Y"); $x++) 
											<option {{request()->input('year_filter') == $x ? 'selected' : ''}} value="{{ $x }}">{{ $x }}</option>
											</option>
											@endfor
										</select>
									<!-- </div> -->
								</div>
								<div class="col-md-2">
									<label for="from_date">From Date</label>
									<input readonly value="{{request()->input('from_date')}}" name="from_date"  id="from_date" type="text" required class="form-control datepicker-here" placeholder="From Date" data-language="en">
								</div>
								<div class="col-md-2">
									<label for="to_date">To Date</label>
									<input readonly name="to_date" value="{{request()->input('to_date')}}" id="to_date"  type="text" required class="form-control datepicker-here" placeholder="To Date" data-language="en">
								</div>
								<div class="col-md-2 d-grid">
									<label class="form-label">&nbsp;</label>
									<button class="btn btn-primary form-group" type="submit">Search</button>
								</div>
								<div class="col-md-2 d-grid">
									<label class="form-label">&nbsp;</label>
									<a href="{{ url()->current() }}" class="btn btn-primary form-group" type="submit">Reset</a>
								</div>
							</div>
						</form>
					</div>
					<div class="table-responsive table-bordred">
						<table  id="dataTable" class="table table-striped table-bordered datatable"> 
							<thead>   
								<tr>
									<th style="width: 50px;">S.No.</th>
									<th>District</th>
									<th>Applicant’s Name</th>
									<th>Mobile no.</th>
									<th>Email ID</th>
									<th>Month</th>
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
									<td>{{$list->mobile ? $list->mobile : "NA"}}</td>  
									<td>{{$list->email ? $list->email : "NA"}}</td> 
									<td>{{month_name($list->month)}}</td>  
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
