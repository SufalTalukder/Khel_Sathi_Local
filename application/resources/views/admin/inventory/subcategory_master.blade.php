@extends( 'layouts/admin_layout' )
@section( 'content' )
	
			<div class="row">

				<div class="col-md-12">

					<div class="pageheader" id="menu-margin">
						<h4 class="mb-0">@if(isset($psubcategory)) Edit @else Create @endif Sub Category Master</h4>
					</div>
					<div class="card mb-3">
						<div class="card-body">
							<form action="{{ route('subCategory') }}" id="inventory" class="needs-validation" method="post" autocomplete="off" novalidate>
								<div class="row">
									@if(isset($psubcategory)) 
									<input type="hidden" name="id" value="{{ $psubcategory->id }}">
									@endif

									<div class="col-md-3">
										<div class="form-group">
											<label for="name">1)Category <span class="text-danger">*</span></label>
											<select  id="category" class="form-control" name="category"  required>
                                                    <option value="">Select</option>
                                                    @foreach ($category as $type)
                                                    <option  value="{{$type->id}}" @if(isset($psubcategory) && $psubcategory->category_id == $type->id ) selected @endif {{ old('category') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                                    @endforeach
                                                    
                                                </select>
											<div class="invalid-feedback">
												Please provide category.
											</div>
											@if ($errors->has('name'))
											<span class="error_mess">{{ $errors->first('name') }}</span> @endif
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="name">2)Sub Category <span class="text-danger">*</span></label>
											<input type="text" class="form-control" id="name" name="name" @if(isset($psubcategory)) value="{{ $psubcategory->name }}" @else  value="{{ old('name') }}" @endif placeholder="Enter Sub Category Name" required="">
											<div class="invalid-feedback">
												Please provide Measurement Unit.
											</div>
											@if ($errors->has('name'))
											<span class="error_mess">{{ $errors->first('name') }}</span> @endif
										</div>
									</div>

										<!-- <div class="col-md-3">
											<div class="form-group">
												<label for="name">3) Item Type <span class="text-danger">*</span></label>
												<div class="form-control">
													<input @if(isset($psubcategory) && $psubcategory->type == 1) checked @endif  type="radio" class="form-check-input" required name="item_type" id="item_type" value="1" >
													<label for="item_type" class="form-check-label">Consumable</label>
													<input @if(isset($psubcategory) && $psubcategory->type == 2) checked @endif type="radio" class="form-check-input" name="item_type" id="item_type2" value="2" >
													<label for="item_type2" class="form-check-label">Fixed Asset</label>
													<div class="invalid-feedback">
													Please Check Item Type.
												</div>
												@if ($errors->has('name'))
												<span class="error_mess">{{ $errors->first('name') }}</span> @endif
												</div>
											</div>
										</div> -->

										<!-- <div class="col-md-3">
											<div class="form-group">
												<label for="name">4) Is AMC Required? <span class="text-danger">*</span></label>
												<div class="form-control">
													<input type="radio" @if(isset($psubcategory) && $psubcategory->amc_required == 1) checked @endif class="form-check-input" required name="amc_required" id="status" value="1" >
													<label for="status" class="form-check-label">Yes</label>
													<input type="radio" @if(isset($psubcategory) && $psubcategory->amc_required == 2) checked @endif class="form-check-input" name="amc_required" id="status2" value="2" >
													<label for="status2" class="form-check-label">No</label>
													<div class="invalid-feedback">
													Please Check Is Amc Required?.
												</div>
												@if ($errors->has('name'))
												<span class="error_mess">{{ $errors->first('name') }}</span> @endif
												</div>
											</div>
										</div> -->
									<div class="col-md-2 d-grid">
										<label class="form-label">&nbsp;</label>
										<button class="btn btn-primary form-group btn-sm" type="submit">@if(isset($psubcategory)) Update @else Submit @endif</button>
									</div>
									<div class="col-md-2 d-grid">
										<label class="form-label">&nbsp;</label>
										<button type="reset" class="btn btn-danger form-group btn-sm">Reset</button>
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
									 <a  title="Division Manager List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
			                            <i class="fa fa-file-excel"></i> Export to Excel
			                        </a>
									<h5> Sub Category Master List</h5>
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
												<th width="20%">Category</th>
												<th width="20%">Sub Category</th>
												<th  width="10%">Added By</th>
												<!-- <th width="20%">Type</th>
												<th width="20%">Is AMC Required?</th> -->
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($subcategory as $key=>$unit)
											<tr>

												<td>{{ $key+1 }}</td>
												<td>{{ $unit->category }}</td>
												<td>{{ $unit->name }}</td>
												<td>{{ rsoName($unit->added_by) }}</td>
												<!-- <td>@if($unit->type ==1)Consumable @else Fixed Asset @endif</td>
												<td>@if($unit->amc_required ==1)Yes @else No @endif</td> -->
												<td class="text-center">
												<a class="btn btn-sm btn-dark pointer bt" href="{{ route('subCategory' , $unit->id) }}">
													<i class="fa fa-edit"></i>
												</a>
												<a class="btn btn-sm btn-danger pointer bt"
													href="{{ route('deleteSubCategory' , $unit->id) }}" 
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
	         XLSX.writeFile(wb, fn || ('Item Category Master List.' + (type || 'xlsx')));
	    }
	</script> 

@endpush
