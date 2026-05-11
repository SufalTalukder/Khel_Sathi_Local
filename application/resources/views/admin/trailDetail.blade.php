@extends( 'layouts/admin_layout' )
@section( 'content' )

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-12">
									 <!-- <a  title="Division Map List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
			                            <i class="fa fa-file-excel"></i> Export to Excel
			                        </a> -->
									<h5>Status Change Log Details List</h5>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="alert alert-primary">
								<div class="row">
								<?php if($type==6){
									$class="col-md-3";
								}
								else{
									$class="col-md-4";
								}
								
								?>
									@if($type==6)
									<div class={{$class}}><label>Post Name : </label> {{AppliedPostName($item->id)}}</div>
									@endif
									<div class={{$class}}><label>Name : </label> {{$item->fullname}}</div>
									<div class={{$class}}><label>Email : </label> {{$item->email}}</div>
									<div class={{$class}}><label>Mobile : </label> {{$item->mobile}}</div>
									
								</div>
							</div>
								<div class="table-responsive">
									<table  id="dataTable" class="table table-bordred table-hover bg-white datatable" >
										
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
											@if($type == 7)
												<?php 
												$ddd= data_gett($type,$item->id);
												?>
												<tr>
													<td>1</td>
													<td>Form Submitted by Applicant</td>
													<td>{{ dmyHi($ddd->created_at) }}</td>
												</tr>
											@endif
											@foreach($lists as $key=>$list)
											<tr>

												<td>@if($type == 7) {{ $key+2 }} @else {{ $key+1 }} @endif</td>
												<!-- <td>{{ applicantName($list->user_id,$list->form_id) }}</td> -->
												<td>{{ $list->new_status }}</td>
                                                <td>{{ dmyHi($list->created_at) }}</td>
												<!-- <td class="text-center">
													<a class="btn btn-sm btn-danger pointer bt" href="{{url('/admin/log-detail/')}}/{{$list->user_id}}" >
                                                            <i class="fa fa-view"></i>
                                                        </a>
												
												</td> -->
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
