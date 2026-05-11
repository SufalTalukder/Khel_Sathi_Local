@extends( 'layouts/darpan_nav' )
@section( 'content' )

<style>
	.cursor_prevent {
		/* pointer-events: none; */
	}

</style>

@php
$cursor_prevent = "cursor_prevent";

@endphp

<!-- 
1 => Directorate( admin )
2 => RSO
3 => Associate
4 => Recruitment Cell
	-->



<div class="row">
	
	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<div class="row">
				<h4 class="col-md-10 mb-0">Dashboard</h4>
				<!-- <h4 class="col-md-2 mb-0"><button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end "   onclick="PrintIt( 'Darpan')"><span class="icons icon-printer"></span></button></h4> -->
			</div>
		</div>
		
		<div class="table-responsive" id="prodiv">
			
			<table  id="dataTable" class="table table-striped table-hover table-bordered">

				<thead>
					<tr>
						<!-- <th align="center">S.No.</th> -->
						<th>Module Name</th>
						<th align="center">Total Application Received</th>
						<!-- <th align="center">Applications Forwarded</th> -->
						<th align="center">Applications Pending</th>
						<th align="center">Applications Accepted</th>
						<th align="center">Applications Rejected</th>
						<!-- <th align="center">Total</th> -->
					</tr>
				</thead>
				<tbody>
                <tr class="{{$cursor_prevent}}">
						 @foreach($direct as $key=>$list) 
						<!-- <td align="center">1</td> -->
						<td>Direct Recruitment </td>
						<td align="center"><a href="{{ url('darpan/district_direct') }}">{{$list->total}}</a></td>
						
						<td align="center"><a href="{{ url('darpan/district_direct',1) }}">{{$list->total_pending}}</a></td>
						<td align="center"><a href="{{ url('darpan/district_direct',2) }}">{{$list->total_accepted}}</a></td>
						<td align="center"><a href="{{ url('darpan/district_direct',3) }}">{{$list->total_rejected}}</a></td>
						<!-- <td align="center">&nbsp;</td> -->
						 @endforeach 
					</tr>
				
					<tr class="{{$cursor_prevent}}">
						@foreach($financial as $key=>$list)
						<!-- <td align="center">2</td> -->
						<td>Financial Assistance / Monthly Pension</td>
						<td align="center"><a href="{{ url('darpan/district_financial') }}">{{$list->total}}</a></td>
						
						<td align="center"><a href="{{ url('darpan/district_financial',1) }}">{{$list->total_pending}}</a></td>
						<td align="center"><a href="{{ url('darpan/district_financial',2) }}">{{$list->total_accepted}}</a></td>
						<td align="center"><a href="{{ url('darpan/district_financial',3) }}">{{$list->total_rejected}}</a></td>
						<!-- <td align="center">&nbsp;</td> -->
						@endforeach 
					</tr>
					{{--<tr class="{{$cursor_prevent}}">
                    @foreach($monthly as $key=>$list)
						<!-- <td align="center">3</td> -->
						<td>Monthly Pension</td>
						<td align="center"><a href="{{  url('darpan/monthly') }}">{{$list->total}}</a></td>
						
						<td align="center"><a href="{{ url('darpan/monthly',1) }}">{{$list->total_pending}}</a></td>
						<td align="center"><a href="{{ url('darpan/monthly',2) }}">{{$list->total_accepted}}</a></td>
						<td align="center"><a href="{{ url('darpan/monthly',3) }}">{{$list->total_rejected}}</a></td>
						<!-- <td align="center">&nbsp;</td> -->
						@endforeach 
					</tr>--}}
					<tr class="{{$cursor_prevent}}">
                  	@foreach($award as $key=>$list)
						<!-- <td align="center">4</td> -->
						<td>Nomination for Laxman And Rani Laxmibai Award</td>
						<td align="center"><a href="{{ url('darpan/district_award') }}">{{$list->total}}</a></td>
						
						<td align="center"><a href="{{ url('darpan/district_award',1) }}">{{$list->total_pending}}</a></td>
						<td align="center"><a href="{{ url('darpan/district_award',2) }}">{{$list->total_accepted}}</a></td>
						<td align="center"><a href="{{ url('darpan/district_award',3) }}">{{$list->total_rejected}}</a></td>
						<!-- <td align="center">&nbsp;</td> -->
						@endforeach 
					</tr>
					{{--<tr class="{{$cursor_prevent}}">
						@foreach($ranilaxmibai as $key=>$list)
						<!-- <td align="center">5</td> -->
						<td>Nomination for Rani Laxmibai Award</td>
						<td align="center"><a href="{{ route('laxmibai') }}">{{$list->total}}</a></td>
						
						<td align="center"><a href="{{ route('laxmibai_spe',1) }}">{{$list->total_pending}}</a></td>
						<td align="center"><a href="{{ route('laxmibai_spe',2) }}">{{$list->total_accepted}}</a></td>
						<td align="center"><a href="{{ route('laxmibai_spe',3) }}">{{$list->total_rejected}}</a></td>
						<!-- <td align="center">&nbsp;</td> -->
						@endforeach
					</tr>--}}
				
					<tr class="{{$cursor_prevent}}">
                    @foreach($position as $key=>$list)
						<!-- <td align="center">6</td> -->
						<td>Nomination for Prize Money</td>
						<td align="center"><a href="{{url('darpan/district_position')}}">{{$list->total}}</a></td>
						
						<td align="center"><a href="{{ url('darpan/district_position',1) }}">{{$list->total_pending}}</a></td>
						<td align="center"><a href="{{ url('darpan/district_position',2) }}">{{$list->total_accepted}}</a></td>
						<td align="center"><a href="{{ url('darpan/district_position',3) }}">{{$list->total_rejected}}</a></td>
						<!-- <td align="center">&nbsp;</td> -->
						@endforeach
					</tr>
					
				</tbody>
			</table>



		</div>
		




	</div>
</div>




@endsection

