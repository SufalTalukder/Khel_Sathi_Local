@extends( 'layouts/admin_layout' )
@section( 'content' )


						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{route('ad')}}">Dashboard</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Registered User</li>
							</ol>
						</nav>


							<div class="card">
								<div class="card-header">
									<div class="row">
										<div class="col-md-11">
											<h5>Registered User List</h5>
											<a  title="User List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
			                            <i class="fa fa-file-excel"></i> Export to Excel
			                        </a>
											<span><a href="" class="btn btn-primary btn-sm float-end" >Add User</a></span>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="">
								<div class="table-responsive">
											<table  id="dataTable" class="table table-bordred table-hover bg-white datatable" >
												<thead>
													<tr>
														<th>S.No.</th>
														<th>Name</th>
														<th>Email</th>
														<th>Mobile</th>
														<th>Company Name</th>
														<th>User Type</th>
														<th>Legal Status</th>
														<th>Pan NO.</th>
														<th>GST NO.</th>
														<th>Doc File</th>
													</tr>
												</thead>
												<tbody>
													@foreach($users as $key=>$item)
													<tr>
														<td>{{ $key+1 }}</td>
														<td>{{ $item->fullname }}</td>
														<td>{{ $item->email }}</td>
														<td>{{ $item->mobile }}</td>
														<td>{{ $item->company_name }}</td>
														<td>{{ $item->investor_type }}</td>
														<td>{{ $item->legal_status }}</td>
														<td>{{ $item->pan_no }}</td>
														<td>{{ $item->gstin_no }}</td>
														<td>
															<ul class="navbar-nav me-auto mb-2 mb-lg-0">
																<li class="nav-item dropdown">
																	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Show
                                                                </a>
																
																	<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
																		@if($item->pan_card_doc!='')
																		<li><a target="_blank" class="dropdown-item" href="{{ url('') }}/public/doc/{{ $item->pan_card_doc}}">PAN Card</a>
																		</li>
																		@endif @if($item->gst_file!='')
																		<li><a target="_blank" class="dropdown-item" href="{{ url('') }}/public/doc/{{ $item->gst_file}}">GST</a>
																		</li>
																		@endif @if($item->byelawsfile!='')
																		<li><a target="_blank" class="dropdown-item" href="{{ url('') }}/public/doc/{{ $item->byelawsfile}}">Association/Registered Society</a>
																		</li>
																		@endif @if($item->company_id_proof_doc!='')
																		<li><a target="_blank" class="dropdown-item" href="{{ url('') }}/public/doc/{{ $item->company_id_proof_doc}}">Certified copy of Partnership Deed</a>
																		</li>
																		@endif @if($item->pan_card_doc=='' && $item->gst_file=='' && $item->byelawsfile=='' && $item->company_id_proof_doc=='')
																		<li><a class="dropdown-item" href="javascript:void(0)">Doc Not Found !</a>
																		</li>
																		@endif
																	</ul>
																</li>
															</ul>
														</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
					

@endsection


@push('custom-scripts')
<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>
    function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('dataTable');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('UserList.' + (type || 'xlsx')));
    }
</script> 
@endpush
