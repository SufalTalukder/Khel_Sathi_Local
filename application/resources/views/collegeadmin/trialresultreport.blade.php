@extends( 'layouts/admin_layout' )
@section( 'content' )

<style>
	table.dataTable>thead>tr>th:not(.sorting_),
	table.dataTable>thead>tr>td:not(.sorting_) {
		padding-right: 0;
	}
	
	table.table-bordered.dataTable tbody th,
	table.table-bordered.dataTable tbody td {
		border-color: #000;
	}
	
	.table>:not(caption)> *> * {
		padding: 0.1rem;
	}
	
	table.table-bordered.dataTable th,
	table.table-bordered.dataTable td {}
	
	div#DataTables_Table_0_filter input {
		border: 1px solid #ced4da;
	}
	
	table th {
		color: #000 !important;
		font-weight: 700;
		background: #dbdfe3 !important;
		border-color: #000;
	}
	
	.table>:not(:last-child)>:last-child> * {
		border-bottom: 1px solid #000000;
	}
	
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}
	
	/* Firefox */
	input[type=number] {
		-moz-appearance: textfield;
	}

</style>


		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">

                   Trial Result Report
				<a href="{{route('collegeadmintrialList')}}"  class="btn btn-sm  btn-outline-primary ms-2 float-end rounded-pill" ><span class="icons icon-list"></span>Trial List</a>
						  <a href="{{ url('collegeadmin/dashboard') }}" class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill m-0"><span class="icons icon-arrow-left"></span>Back/पीछे</a> 
				
				</h4>

		


		</div>

		<div class="card">

			<div class="card-body">
				<form action="{{route('collegeadminfiltertrialresultreport')}}" method="post" class="filterform">
					@csrf
					<div class="row">
						<div class="mb-3 col-md-2">


							<label>Name of The Sport</label>
							<select name="sport" id="sport" onchange="sportfilter(this.value)">
								<option value="">select</option>
								@foreach ($sports as $sport)
								<option value="{{$sport->id}}" @if(isset($sportId)) @if ($sportId==$sport->id) selected @endif @endif>{{$sport->name}}</option>
								@endforeach

							</select>



						</div>

						<div class="mb-3 col-md-1">

							<label class="form-label">&nbsp;</label>
							<button class="btn btn-primary form-group mt-4" type="submit">Filter</button>


						</div>

						<div class="mb-3 col-md-2">

							<label class="form-label">&nbsp;</label>
							<a href="{{route('collegeadmintrialresultreport')}}" class="btn btn-primary form-group mt-4">Reset</a>


						</div>
				
						</div>
				</form>



				</div>


			</div>
	
		<div class="card">

			<div class="card-body input_new">



				<div class="table-responsive">
					<table id="dataTable" class="table datatable text-center table-bordered" style="
    font-size: smaller;
">
						<thead>
							<tr>
								<th rowspan="3" valign="top">क्रस/<br> S.No.
								</th>
								<th rowspan="3" valign="top">फार्म सं0/<br> Application No.</th>
								<th valign="top">उम्मीदवार का नाम/<br> Candidate's Name</th>
								<th valign="top">जन्म तिथि/<br> DOB
								</th>
								<th rowspan="3" valign="top">मण्डल/<br> Division
								</th>
								<th rowspan="3" valign="top">Sport
								</th>
								<th rowspan="3" valign="top">Sub Sport
								</th>
								<th rowspan="3" valign="top">Gender
								</th>
								<th rowspan="3" valign="top">Added By
								</th>
								<th rowspan="3" valign="top">Date
								</th>
								<th colspan="12" valign="top">शारीरिक परीक्षा/<span lang="en">
                                   Physical Examination</span>
									पूर्णांक/ Max. Marks - 50</th>










							</tr>
							<tr>
								<th rowspan="2" valign="top">&nbsp;

								</th>
								<th rowspan="2" valign="top">&nbsp;

								</th>
								<th colspan="2" valign="top">100मी/Mtr<br> 10 अंक/No.</th>
								<th colspan="2" valign="top">800मी0/Mtr<br> 10अंक/No.
								</th>
								<th colspan="2" valign="top">ब्रॉड जम्प/Broad Jump<br> 10अंक/No.
								</th>
								<th colspan="2" valign="top">शटल रन/Shuttle Run<br> 10अंक/No.
								</th>
								<th colspan="2" valign="top">बाल थ्रो/Ball Throw<br> 10अंक/No.
								</th>
								<th rowspan="2" valign="top">कुल प्रा०/<br> Max. Marks - 50<br>
								</th>







								</th>

							</tr>
							<tr>
								<th valign="top">स०</th>
								<th valign="top">अं०/No.</th>
								<th valign="top">स०</th>
								<th valign="top">
									अं०/No.</th>
								<th valign="top">दू०/Dist.</th>
								<th valign="top" class="border-dark">अं०/No.</th>
								<th valign="top">स०</th>
								<th valign="top">अं०/No.</th>
								<th valign="top">दू०/Dist</th>
								<th valign="top">अं०/No.</th>




							</tr>

						</thead>
						<tbody>


							@foreach ($applicants as $key=>$applicant )

							<tr>
								<td valign="top">
									{{$key + 1}}
								</td>
								<td valign="top">
									{{$applicant->application_no}}
								</td>
								<td valign="top">
									{{$applicant->fullname}}
								</td>
								<td valign="top">
									{{dmy($applicant->dob)}}
								</td>
								<td valign="top">
									{{$applicant->city}}
								</td>
								<td valign="top">
									{{$applicant->name}}
								</td>

								<td valign="top">
									@if ($applicant->sub_sport_id) {{get_subSportName($applicant->sub_sport_id)}} @else NA @endif
								</td>
								<td valign="top">
									@if ($applicant->gender == 1) Male @else Female @endif
								</td>
								<td valign="top">
									{{rsoName($applicant->addedby)}}
								</td>
								<td valign="top">
									{{dmy($applicant->date)}}
								</td>
								<td valign="top">
									{{$applicant->hundred_mt_time}}
								</td>
								<td valign="top">
									{{$applicant->hundred_mt_mark}}
								</td>
								<td valign="top">
									{{$applicant->eight_hundred_mt_time}}
								</td>
								<td valign="top">
									{{$applicant->eight_hundred_mt_mark}}
								</td>
								<td valign="top">
									{{$applicant->broad_jump_distance}}
								</td>
								<td valign="top">
									{{$applicant->broad_jump_mark}}
								</td>
								<td valign="top">
									{{$applicant->shuttle_run_time}}
								</td>
								<td valign="top">
									{{$applicant->shuttle_run_mark}}
								</td>
								<td valign="top">
									{{$applicant->ball_throw_distance}}
								</td>
								<td valign="top">
									{{$applicant->ball_throw_mark}}
								</td>
								<td valign="top">
									{{$applicant->physical_total_mark}}
								</td>


							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>

		</div>



@endsection
@push( 'custom-scripts' )
	<script>
		// function sportfilter(sport){

		// 	$("#myTable tbody tr").filter(function() {
		// 		alert($(this).text().toLowerCase().indexOf(sport) > -1);
		// 		$(this).toggle(tr)
		// });
		// }
	</script>
@endpush
