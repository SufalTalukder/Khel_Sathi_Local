@extends( 'layouts/admin_layout' )
@section( 'content' )

			<div class="row">

				<div class="col-md-12">

					<div class="pageheader" id="menu-margin">
						<h4 class="mb-0">@if(isset($pvendor)) Edit @else Create @endif Vendor</h4>
					</div>
					<div class="card mb-3">

						<div class="card-body">
							<form action="{{ route('saveVendor') }}" id="inventory" class="needs-validation" method="post" autocomplete="off" novalidate>
								<div class="row">
									@if(isset($pvendor)) 
									<input type="hidden" name="id" value="{{ $pvendor->id }}">
									@endif
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="name">1) Vendor Name <span class="text-danger">*</span></label>
												<input type="text" class="form-control" id="name" name="name" @if(isset($pvendor)) value="{{ $pvendor->name }}" @else  value="{{ old('name') }}" @endif placeholder="Enter Vendor Name" required="">
												<div class="invalid-feedback">
													Please provide Vendor Name.
												</div>
												@if ($errors->has('name'))
												<span class="error_mess">{{ $errors->first('name') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="mobile">2) Contact No. <span class="text-danger">*</span></label>
												<input type="text" class="form-control" id="mobile" name="mobile" @if(isset($pvendor)) value="{{ $pvendor->mobile }}" @else  value="{{ old('mobile') }}" @endif placeholder="Enter Contact No." pattern="[6-9][0-9]{9}$" required maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
												<div class="invalid-feedback">
													Please provide Contact No.
												</div>
												@if ($errors->has('mobile'))
												<span class="error_mess">{{ $errors->first('mobile') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="email">3) Email ID <span class="text-danger">*</span></label>
												<input type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"   id="email" name="email" @if(isset($pvendor)) value="{{ $pvendor->email }}" @else  value="{{ old('email') }}" @endif placeholder="Enter Email ID" required="">
												<div class="invalid-feedback">
													Please provide Email ID.
												</div>
												@if ($errors->has('email'))
												<span class="error_mess">{{ $errors->first('email') }}</span> @endif
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="pan">4) PAN No. <span class="text-danger">*</span></label>
												<input type="text" class="form-control" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" id="pan" name="pan" @if(isset($pvendor)) value="{{ $pvendor->pan }}" @else  value="{{ old('pan') }}" @endif placeholder="Enter PAN No." required="">
												<div class="invalid-feedback">
													Please provide PAN No.
												</div>
												@if ($errors->has('pan'))
												<span class="error_mess">{{ $errors->first('pan') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="gst">5) GST No. <span class="text-danger">*</span></label>
												<input type="text" pattern="^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$" class="form-control" id="gst" name="gst" @if(isset($pvendor)) value="{{ $pvendor->gst }}" @else  value="{{ old('gst') }}" @endif placeholder="Enter GST no." required="">
												<div class="invalid-feedback">
													Please provide GST No.
												</div>
												@if ($errors->has('gst'))
												<span class="error_mess">{{ $errors->first('gst') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="address">6) Address <span class="text-danger">*</span></label>
												<textarea id="address" class="form-control" name="address" rows="1" cols="50" required>@if(isset($pvendor)) {{ $pvendor->address }} @endif</textarea>
												<!-- <input type="text" class="form-control" id="name" name="name" @if(isset($pvendor)) value="{{ $pvendor->name }}" @else  value="{{ old('name') }}" @endif placeholder="Enter Measurement Unit" required=""> -->
												<div class="invalid-feedback">
													Please provide Address.
												</div>
												@if ($errors->has('address'))
												<span class="error_mess">{{ $errors->first('address') }}</span> @endif
											</div>
										</div>
									
										
										<div class="col-md-12">
											<div class="form-group">
												<label for="name">7) Status <span class="text-danger">*</span></label>
												<div class="form-control">
													<input @if(isset($pvendor) && $pvendor->status == 1) checked @endif required type="radio" class="form-check-input col-md-0" name="status" id="status" value="1" >
													<label for="status" class="form-check-label col-md-2">Active</label>
													<input @if(isset($pvendor) && $pvendor->status == 2) checked @endif type="radio" class="form-check-input col-md-0" name="status" id="status2" value="2" >
													<label for="status2" class="form-check-label col-md-2">Banned</label>
													<input @if(isset($pvendor) && $pvendor->status == 3) checked @endif type="radio" class="form-check-input col-md-0" name="status" id="status3" value="3" >
													<label for="status3" class="form-check-label col-md-2">Blacklisted</label>&nbsp;&nbsp;
													<input @if(isset($pvendor) && $pvendor->status == 4) checked @endif type="radio" class="form-check-input col-md-0" name="status" id="status4" value="4" >
													<label for="status4" class="form-check-label col-md-3">Suspended</label>
												</div>
												<div class="invalid-feedback">
													Please provide Measurement Unit.
												</div>
												@if ($errors->has('name'))
												<span class="error_mess">{{ $errors->first('name') }}</span> @endif
											</div>
										</div>
									</div>
									<div class="col-md-2 d-grid">
										<button class="btn btn-primary" type="submit">@if(isset($pvendor)) Update @else Submit @endif</button>
									</div>
									<div class="col-md-2 d-grid">
										<button type="reset" class="btn btn-danger">Reset</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>


				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-12">
									 <a  title="Vendor Master List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
			                            <i class="fa fa-file-excel"></i> Export to Excel
			                        </a>
									<h5> Vendor Master List</h5>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="">
								<div class="table-responsive">
									<table  id="dataTable" class="table table-bordred table-hover bg-white datatable" >
										<thead>
											<tr>
												<th width="6%">S.No.</th>
												<th width="20%">Vendor Code</th>
												<th width="20%">Vendor Name</th>
												<th width="20%">Contact No.</th>
												<th width="20%">Email ID</th>
												<th width="20%">PAN No.</th>
												<th width="20%">GST No.</th>
												<th width="20%">Address</th>
												<th width="10%">Added By</th>
												<th width="20%">Status</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($vendor as $key=>$unit)
											<tr>

												<td>{{ $key+1 }}</td>
												<td>{{ $unit->vendor_code }}</td>
												<td>{{ $unit->name }}</td>
												<td>{{ $unit->mobile }}</td>
												<td>{{ $unit->email }}</td>
												<td>{{ $unit->pan }}</td>
												<td>{{ $unit->gst }}</td>
												<td>{{ $unit->address }}</td>
												<td>{{ rsoName($unit->added_by) }}</td>
												<td>
													@if($unit->status==1)Active 
													@elseif($unit->status==2)Banned 
													@elseif($unit->status==3)Blacklisted 
													@else Suspended 
													@endif
												</td>
												<td class="text-center">
												<a class="btn btn-sm btn-dark pointer bt" href="{{ route('editVendor' , $unit->id) }}">
													<i class="fa fa-edit"></i>
												</a>
												<a class="btn btn-sm btn-danger pointer bt"
													href="{{ route('deleteVendor' , $unit->id) }}" 
													onclick="return confirm('Are you sure you want to delete ?')">
													<i class="fa fa-trash"></i>
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


			</div>
	
@endsection
@push( 'custom-scripts' )
	<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
	<script>
	    function ExportToExcel(type, fn, dl) {
	       var elt = document.getElementById('dataTable');
	       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
	     
	       return dl ?
	         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
	         XLSX.writeFile(wb, fn || ('Vendor Master List.' + (type || 'xlsx')));
	    }
	</script> 

@endpush
