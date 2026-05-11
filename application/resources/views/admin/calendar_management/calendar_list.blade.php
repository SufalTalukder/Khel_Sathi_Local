@extends( 'layouts/admin_layout' )
@section( 'content' )



<div class="col-md-12">

		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Calendar List  <a class="btn btn-primary btn-sm float-end" href="{{url('/admin/create_calendar_management/')}}" style="width: auto;">
<i class="fas fa-plus"></i>
			Add Calendar
		
			</a>
			</h4>
		</div> 
		<div class="card">
			<div class="card-body">
				<div class="">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordred table-hover bg-white datatable">
							<thead>
								<tr>
									<th width="6%">S.No.</th>
									<th width="20%">Header</th>
									<th class="text-center">Subject</th>
									<th>Media Data</th>
                                    <th>Remarks</th>
									<th class="text-center">Edit</th>
								</tr>
							</thead> 
							<tbody>
								@foreach($calendarList as $key=>$list)
								<tr>

                                <td>{{ $key+1 }}</td>
                                <td>{{ $list->header_name }}</td>
                                <td>{{ $list->subject_name }}</td>                               
								<?php if($list->type==1){ ?>
								<td>                                                    
									@if ($list->media_data)
									<a target="_blank" href="{{ asset('public/calendar_management/media_data/'.$list->media_data) }}" class="btn btn-primary btn-xs"><span class="fa fa-download"></span></a>
									@else
									NA
									@endif
								<?php }else if($list->type==2){?>
                                <td><a target="_blank" href="{{$list->media_data}}" class="btn btn-primary btn-xs"><span class="fa fa-link"></span></a></td>
								<?php }else{} ?>
                                <td>{{ $list->remarks }}</td>
                             
							
									<td class="text-center">										
                                        <a class="btn btn-sm btn-dark pointer bt px-2" href="{{url('/admin/edit_calendar/')}}/{{$list->id}}">
											<i class="fa fa-edit"></i>
										</a>

									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>











@endsection

