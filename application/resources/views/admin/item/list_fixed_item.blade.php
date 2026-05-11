@extends( 'layouts/admin_layout' )
@section( 'content' )
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-10">

							<h5> Details of Added Fixed Assets</h5>
						</div>
						<div class="col-md-2">
							<a href="{{route('addFixedItem')}}" title="Vendor Master List" class="btn btn-sm btn-primary">
			                           <span> Add Assets</span>
			                        </a>
							<a title="Vendor Master List" class="btn btn-sm btn-success " onclick="ExportToExcel('xlsx')">
			                            <i class="fa fa-file-excel"></i> Export to Excel
			                        </a>
						
						</div>
					</div>
				</div>
				<div class="card-body">

					<div class="mb-4">
						<form action="{{ url()->current() }}" class="needs-validation" method="POST" autocomplete="off" id="formHostelMaster" novalidate>
							@csrf
							<div class="row">
								<div class="col-md-3">
									<div id="list1" class="dropdown-check-list">
										<label for="month">Category</label>
										<select class="form-control" id="category" onchange="get_subCategory(this.value)" name="category">
											<option value="all">--All--</option>
											@foreach($category as $category)
											<option {{request()->input('category') == $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
											</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="subcategory">Sub Category</label>
										<input type="hidden" id="sub_id" value="{{request()->input('subcategory')}}"/>
										<select class="form-control" id="subcategory" name="subcategory">
											<option value="all">--All--</option>
											@foreach($subcategory as $subcategory)
											<option {{request()->input('subcategory') == $subcategory->id ? 'selected' : ''}} value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
											</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="vendor">Vendor</label>
										<select class="form-control" id="vendor" name="vendor">
											<option value="all">--All--</option>
											@foreach($vendor as $vendor)
											<option {{request()->input('vendor') == $vendor->id ? 'selected' : ''}} value="{{ $vendor->id }}">{{ $vendor->name }}</option>
											</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-2 d-grid">
									<label class="form-label">&nbsp;</label>
									<button class="btn btn-primary form-group" type="submit">Search</button>
								</div>
								<div class="col-md-1 d-grid">
									<label class="form-label">&nbsp;</label>
									<a href="{{ url()->current() }}" class="btn btn-primary form-group" type="submit">Reset</a>
								</div>
							</div>
						</form>
					</div>

					<div class="">
						<div class="table-responsive">
							<table id="dataTable" class="table table-bordred table-hover bg-white datatable">
								<thead>
									<tr>
										<th width="6%">S.No.</th>
										<th width="20%">Category</th>
										<th width="20%">Sub Category</th>
										<th width="20%">Name of Item</th>
										<th width="20%">Code of Item</th>
										<th width="20%">QR Code</th>
										<th width="20%">Date of Purchase</th>
										<th width="20%">Quantity of Items Purchased</th>
										<th width="20%">Unit</th>
										<th width="20%">Rate Per Item (in Rs.)</th>
										<th width="20%">Total Cost of Assets (in Rs.)</th>
										<th width="20%">Vendor Name</th>
										<th width="20%">Voucher No.</th>
										<th width="20%">Serial Number of Asset</th>
										<th width="20%">Manufacturer</th>
										<th width="20%">Model No.</th>
										<th width="20%">Date of Expiry</th>
										<th width="20%">Last Date of Warranty</th>
										<th width="20%">Depreciation Cost in 1st Year (%)</th>
										<th width="20%">Asset Cost at the Beginning of 2nd Year</th>
										<th width="20%">Location of Asset</th>
										<th width="20%">Is AMC Required?</th>
										<th width="20%">AMC Period</th>
										<th width="20%">Asset Image 1</th>
										<th width="20%">Asset Image 2</th>
										<th width="10%">Added By</th>
										<th width="20%">Action</th>

									</tr>
								</thead>
								<tbody>
									@foreach($all_item as $key=>$item)
									<tr>

										<td>{{ $key+1 }}</td>
										<td>{{ $item->category }}</td>
										<td>{{ $item->subcategory }}</td>
										<td>{{ $item->item_name }}</td>
										<td>{{ $item->item_code }}</td>
										<td></td>
										<td>@if($item->purchase_date){{ dmy($item->purchase_date) }}@endif</td>
										<td>{{ $item->quantity_of_items_purchased }}</td>
										<td>{{ $item->unit }}</td>
										<td>{{ $item->rate_per_item }}</td>
										<td>{{ $item->total_cost_of_assets }}</td>
										<td>{{ $item->vendor_name }}</td>
										<td>{{ $item->voucher_number }}</td>
										<td>{{ $item->serial_number_of_asset }}</td>
										<td>{{ $item->manufacturer }}</td>
										<td>{{ $item->model_number }}</td>
										<td>@if(!empty($item->date_of_expiry)){{ dmy($item->date_of_expiry) }}@endif</td>
										<td>@if(!empty($item->last_date_of_warranty)){{ dmy($item->last_date_of_warranty) }}@endif</td>
										<td>{{ $item->depreciation_cost_in_1st_year }}</td>
										<td>{{ $item->asset_cost_at_beginning_of_2nd_year }}</td>
										<td>{{ $item->location_of_asset }}</td>
										<td>@if($item->AMC_required == 1)Yes @else No @endif</td>
										<td>{{ $item->AMC_period }}</td>
										<td>@if($item->asset_image)<img width="50" height="50" class="imgpty" src="{{url('public/item_asset/'.$item->asset_image)}}"> @else -- @endif </td>
										<td>@if($item->asset_image_2)<img width="50" height="50" class="imgpty" src="{{url('public/item_asset/'.$item->asset_image_2)}}"> @else -- @endif </td>
										<td>{{ rsoName($item->added_by) }}</td>
										<td class="text-center">
											<a class="btn btn-sm btn-dark pointer bt" href="{{ route('addFixedItem' , $item->id) }}">
													<i class="fa fa-edit"></i>
												</a>
										
											<a class="btn btn-sm btn-danger pointer bt" href="{{ route('deleteFixedItem' , $item->id) }}" onclick="return confirm('Are you sure you want to delete ?')">
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


	</div>@endsection
@push( 'custom-scripts' )
	<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>
	function ExportToExcel( type, fn, dl ) {
		var elt = document.getElementById( 'dataTable' );
		var wb = XLSX.utils.table_to_book( elt, {
			sheet: "sheet1"
		} );

		return dl ?
			XLSX.write( wb, {
				bookType: type,
				bookSST: true,
				type: 'base64'
			} ) :
			XLSX.writeFile( wb, fn || ( 'Vendor Master List.' + ( type || 'xlsx' ) ) );
	}

	function get_subCategory( value ) {
		var sub_id = $( '#sub_id' ).val();
		$.ajax( {
			type: "POST",
			url: "{{route('get_subcategory')}}",
			data: {
				value
			},

			success: function ( response ) {
				option = "<option value='all' >--All--</option>";
				response.forEach( ( item ) => {
					if ( sub_id == item.id ) {
						option += `<option selected value="${item.id}" >${item.name}</option>`;
					} else {
						option += `<option value="${item.id}" >${item.name}</option>`;
					}

				} );
				if ( response.length != 0 ) {
					$( "#subcategory" ).empty();
					$( "#subcategory" ).append( option );
				}

			}
		} );
	}
</script>

@endpush
