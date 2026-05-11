@extends( 'layouts/admin_layout' )
@section( 'content' )
			<div class="row">

				<div class="col-md-12">

					<div class="pageheader" id="menu-margin">
						<div class="row">
							<div class="col-md-8">
								<h4 class="mb-0">@if(isset($list)) Edit @else Add @endif  Fixed Assets Purchased</h4>
							</div>
							<div class="col-md-4">
							<a href="{{route('FixedItem')}}" class="btn btn-primary" style="float: right;">Details of Added Fixed Assets</a>
							</div>
						</div>
					</div>
					
					<div class="card mb-3">

						<div class="card-body">
							<form action="{{ route('savefixedItem') }}" id="preregistration" class="needs-validation" enctype="multipart/form-data" method="post" autocomplete="off" novalidate>
								<div class="row">
									@if(isset($list)) 
									<input type="hidden" name="id" value="{{ $list->id }}">
									@endif

									<!--  -->
									<div class="row mt-3">
										<div class="col-md-4">
											<div class="form-group">
												<label for="category">1)Category <span class="text-danger">*</span></label>
												<select  id="category" class="form-control" onchange="get_subCategory(this.value)" name="category"  required>
														<option value="">Select</option>
														@foreach ($category as $type)
														<option  value="{{$type->id}}" @if(isset($list) && $list->category == $type->id ) selected @endif {{ old('category') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
														@endforeach
														
													</select>
												<div class="invalid-feedback">
													Please provide category.
												</div>
												@if ($errors->has('category'))
												<span class="error_mess">{{ $errors->first('category') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="subcategory">2)Sub Category </label>
												
												<input type="hidden" id="sub_id" @if(isset($list)) value="{{$list->subcategory}}" @endif/>
												
													<select  id="subcategory" class="form-control" name="subcategory" >
														
													</select>
												<div class="invalid-feedback">
													Please provide Sub Category.
												</div>
												@if ($errors->has('subcategory'))
												<span class="error_mess">{{ $errors->first('subcategory') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="item_name">3) Name of Item. <span class="text-danger">*</span></label>
												<input type="text" class="form-control" id="item_name" name="item_name" @if(isset($list)) value="{{ $list->item_name }}" @else  value="{{ old('item_name') }}" @endif placeholder="Name of Item"  required >
												<div class="invalid-feedback">
													Please provide Name of Item.
												</div>
												@if ($errors->has('item_name'))
												<span class="error_mess">{{ $errors->first('item_name') }}</span> @endif
											</div>
										</div>
									</div>
										<!--  -->
									<div class="row mt-3">
										<div class="col-md-4">
											<div class="form-group">
												<label for="email">4) Date of Purchase <span class="text-danger">*</span></label>
												<input type="date" class="form-control" onchange="exp_date(this.value);"  id="purchase_date" name="purchase_date" @if(isset($list)) value="{{ $list->purchase_date }}" @else  value="{{ old('purchase_date') }}" @endif placeholder="Enter Date of Purchase" required="">
												<div class="invalid-feedback">
													Please provide Date of Purchase.
												</div>
												@if ($errors->has('purchase_date'))
												<span class="error_mess">{{ $errors->first('purchase_date') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="unit">5)Unit <span class="text-danger">*</span></label>
												<select  id="unit" onchange="get_type(this.value)" class="form-control" name="unit"  required>
														<option value="">Select</option>
														@foreach ($unit as $type)
														<option  value="{{$type->id}}" @if(isset($list) && $list->unit == $type->id ) selected @endif {{ old('unit') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
														@endforeach
													</select>
												<div class="invalid-feedback">
													Please provide Unit.
												</div>
												@if ($errors->has('unit'))
												<span class="error_mess">{{ $errors->first('unit') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="quantity_of_items_purchased">6) Quantity of Items Purchased <span class="text-danger">*</span></label>
												<input type="text"   @if(isset($list)) value="{{ $list->quantity_of_items_purchased }}" @else  value="{{ old('quantity_of_items_purchased') }}" @endif  maxlength="10" onkeyup="total_cost()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="quantity_of_items_purchased" name="quantity_of_items_purchased" placeholder="Quantity of Items Purchased." required="">
												<div class="invalid-feedback">
													Please provide Quantity of Items Purchased.
												</div>
												@if ($errors->has('quantity_of_items_purchased'))
												<span class="error_mess">{{ $errors->first('quantity_of_items_purchased') }}</span> @endif
											</div>
										</div>
										
										
									</div>

									<!--  --> 

									<div class="row mt-3">
										
										<div class="col-md-4">
											<div class="form-group">
												<label for="rate_per_item">7) Rate Per Item (in Rs.) <span class="text-danger">*</span></label>
												<input type="text" maxlength="10" onkeyup="total_cost()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="rate_per_item" name="rate_per_item" @if(isset($list)) value="{{ $list->rate_per_item }}" @else  value="{{ old('rate_per_item') }}" @endif placeholder="Enter Rate Per Item." required="">
												<div class="invalid-feedback">
													Please provide Rate Per Item.
												</div>
												@if ($errors->has('rate_per_item'))
												<span class="error_mess">{{ $errors->first('rate_per_item') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="total_cost_of_assets">8) Total Cost of Assets (in Rs.) <span class="text-danger">*</span></label>
												<input type="text" readonly maxlength="10" class="form-control" id="total_cost_of_assets" name="total_cost_of_assets" @if(isset($list)) value="{{ $list->total_cost_of_assets }}" @else  value="{{ old('total_cost_of_assets') }}" @endif placeholder="Enter Rate Per Item." required="">
												
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="vendor_name">9) Vendor Name <span class="text-danger">*</span></label>
												<!-- <input type="text" class="form-control" id="vendor_name" name="vendor_name" @if(isset($list)) value="{{ $list->vendor_name }}" @else  value="{{ old('vendor_name') }}" @endif placeholder="Enter Vendor Name." required=""> -->
													<select  id="vendor_name" class="form-control" name="vendor_name"  required>
														<option value="">Select</option>
														@foreach ($vendor as $type)
														<option  value="{{$type->id}}" @if(isset($list) && $list->vendor_name == $type->id ) selected @endif {{ old('vendor') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
														@endforeach
													</select>
												<div class="invalid-feedback">
													Please provide Vendor Name.
												</div>
												@if ($errors->has('vendor_name'))
												<span class="error_mess">{{ $errors->first('vendor_name') }}</span> @endif
											</div>
										</div>
									</div>

								<!--  -->
									<div class="row mt-3">
										
										<div class="col-md-4">
											<div class="form-group">
												<label for="voucher_number">10) Voucher Number <span class="text-danger">*</span></label>
												<input type="text"  class="form-control" id="voucher_number" name="voucher_number" @if(isset($list)) value="{{ $list->voucher_number }}" @else  value="{{ old('voucher_number') }}" @endif placeholder="Enter Voucher Number." required="">
												<div class="invalid-feedback">
													Please provide Voucher Number.
												</div>
												@if ($errors->has('voucher_number'))
												<span class="error_mess">{{ $errors->first('voucher_number') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="serial_number_of_asset">11) Serial Number of Asset </label>
												<input type="text"  class="form-control" id="serial_number_of_asset" name="serial_number_of_asset" @if(isset($list)) value="{{ $list->serial_number_of_asset }}" @else  value="{{ old('serial_number_of_asset') }}" @endif placeholder="Enter Serial Number of Asset." >
												
												<div class="invalid-feedback">
													Please provide Serial Number of Asset.
												</div>
												@if ($errors->has('serial_number_of_asset'))
												<span class="error_mess">{{ $errors->first('serial_number_of_asset') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="manufacturer">12) Manufacturer</label>
												<input type="text" class="form-control" id="manufacturer" name="manufacturer" @if(isset($list)) value="{{ $list->manufacturer }}" @else  value="{{ old('manufacturer') }}" @endif placeholder="Enter Manufacturer." >
												<div class="invalid-feedback">
													Please provide Manufacturer.
												</div>
												@if ($errors->has('manufacturer'))
												<span class="error_mess">{{ $errors->first('manufacturer') }}</span> @endif
											</div>
										</div>
									</div>

									<div class="row mt-3">
										
										<div class="col-md-4">
											<div class="form-group">
												<label for="model_number">13) Model Number</label>
												<input type="text"  class="form-control" id="model_number" name="model_number" @if(isset($list)) value="{{ $list->model_number }}" @else  value="{{ old('model_number') }}" @endif placeholder="Enter Model Number.">
												<div class="invalid-feedback">
													Please provide Model Number.
												</div>
												@if ($errors->has('model_number'))
												<span class="error_mess">{{ $errors->first('model_number') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="date_of_expiry">14) Date of Expiry</label>
												<input type="date" class="form-control"    id="date_of_expiry" name="date_of_expiry" @if(isset($list)) value="{{ $list->date_of_expiry }}" @else  value="{{ old('date_of_expiry') }}" @endif placeholder="Enter Date of Expiry" >
												<div class="invalid-feedback">
													Please provide Date of Expiry.
												</div>
												@if ($errors->has('date_of_expiry'))
												<span class="error_mess">{{ $errors->first('date_of_expiry') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="last_date_of_warranty">15) Last Date of Warranty</label>
												<input type="date" class="form-control" id="last_date_of_warranty" name="last_date_of_warranty" @if(isset($list)) value="{{ $list->last_date_of_warranty }}" @else  value="{{ old('last_date_of_warranty') }}" @endif placeholder="Enter Last Date of Warranty." >
												<div class="invalid-feedback">
													Please provide Last Date of Warranty.
												</div>
												@if ($errors->has('last_date_of_warranty'))
												<span class="error_mess">{{ $errors->first('last_date_of_warranty') }}</span> @endif
											</div>
										</div>
									</div>

									<div class="row mt-3">
										<div class="col-md-4">
											<div class="form-group">
												<label for="depreciation_cost_in_1st_year">16) Depreciation Cost in 1st Year (%) </label>
												<input type="text"  class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="depreciation_cost_in_1st_year" name="depreciation_cost_in_1st_year" @if(isset($list)) value="{{ $list->depreciation_cost_in_1st_year }}" @else  value="{{ old('depreciation_cost_in_1st_year') }}" @endif placeholder="Enter Depreciation Cost in 1st Year (%)" >
												<div class="invalid-feedback">
													Please provide Depreciation Cost in 1st Year (%).
												</div>
												@if ($errors->has('depreciation_cost_in_1st_year'))
												<span class="error_mess">{{ $errors->first('depreciation_cost_in_1st_year') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="asset_cost_at_beginning_of_2nd_year">17) Asset Cost at the Beginning of 2nd Year </label>
												<input type="text"  class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="asset_cost_at_beginning_of_2nd_year" name="asset_cost_at_beginning_of_2nd_year" @if(isset($list)) value="{{ $list->asset_cost_at_beginning_of_2nd_year }}" @else  value="{{ old('asset_cost_at_beginning_of_2nd_year') }}" @endif placeholder="Enter Asset Cost at the Beginning of 2nd Year">
												<div class="invalid-feedback">
													Please provide Asset Cost at the Beginning of 2nd Year.
												</div>
												@if ($errors->has('asset_cost_at_beginning_of_2nd_year'))
												<span class="error_mess">{{ $errors->first('asset_cost_at_beginning_of_2nd_year') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="location_of_asset">18) Location of Asset  </label>
												<input type="text" class="form-control"  id="location_of_asset" name="location_of_asset" @if(isset($list)) value="{{ $list->location_of_asset }}" @else  value="{{ old('location_of_asset') }}" @endif placeholder="Enter Location of Asset." >
												<div class="invalid-feedback">
													Please provide Location of Asset.
												</div>
												@if ($errors->has('location_of_asset'))
												<span class="error_mess">{{ $errors->first('location_of_asset') }}</span> @endif
											</div>
										</div>
									</div>

									<div class="row mt-3">
										
										<div class="col-md-4">
											<div class="form-group">
												<label for="AMC_required">19) Is AMC Required? <span class="text-danger">*</span></label>
												<div class="form-control">
													<input type="radio" @if(isset($list) && $list->AMC_required == 1) checked @endif class="form-check-input amc_required" required name="AMC_required" id="status" value="1" >
													<label for="status" class="form-check-label">Yes</label>
													<input type="radio" @if(isset($list) && $list->AMC_required == 2) checked @endif class="form-check-input amc_required" name="AMC_required" id="status2" value="2" >
													<label for="status2" class="form-check-label">No</label>
													<div class="invalid-feedback">
													Please Check Is Amc Required?.
												</div>
												@if ($errors->has('AMC_required'))
												<span class="error_mess">{{ $errors->first('AMC_required') }}</span> @endif
												</div>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="AMC_period">20) AMC Period (in days) <span class="text-danger" id="amc_div">*</span></label>
												<input type="text" id="amc_field" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="AMC_period" name="AMC_period" @if(isset($list)) value="{{ $list->AMC_period }}" @else  value="{{ old('AMC_period') }}" @endif placeholder="Enter AMC Period (in days)" >
												<div class="invalid-feedback">
													Please provide AMC Period (in days).
												</div>
												@if ($errors->has('AMC_period'))
												<span class="error_mess">{{ $errors->first('AMC_period') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="name">21) Asset Image(1)(Max File Size: 2 MB)</label>
												<input type="file"  onchange="getfileext2(this,'T4')" id="FileT4" class="form-control"   name="asset_image">
												@if(isset($list))
												<input type="hidden"  value="{{$list->asset_image}}" class="form-control"  id="asset_image1" name="asset_image1">
												@endif
											</div>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-md-4">
											<div class="form-group">
												<label for="asset_image_2">22) Asset Image(2)(Max File Size: 2 MB)</label>
												<input type="file"  onchange="getfileext2(this,'T3')" id="FileT3" class="form-control"  id="asset_image_2" name="asset_image_2">
												@if(isset($list))
												<input type="hidden"  value="{{$list->asset_image_2}}" class="form-control"  name="asset_image2">
												@endif
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<label for="stock_alert">22) Stock Alert Quantity <span class="text-danger">*</span></label>
												<input type="text"  class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="stock_alert" name="stock_alert" @if(isset($list)) value="{{ $list->stock_alert }}" @else  value="{{ old('stock_alert') }}" @endif placeholder="Enter Stock Alert Quantity" required="">
												<div class="invalid-feedback">
													Please provide Stock Alert Quantity.
												</div>
												@if ($errors->has('stock_alert'))
												<span class="error_mess">{{ $errors->first('stock_alert') }}</span> @endif
											</div>
										</div>
										<div class="col-md-2 d-grid">
											<label class="form-label">&nbsp;</label>
											<button class="btn btn-primary form-group btn-sm" type="submit">@if(isset($list)) Update @else Submit @endif</button>
										</div>
										<div class="col-md-2 d-grid">
											<label class="form-label">&nbsp;</label>
											<button type="reset" class="btn btn-danger btn-sm">Reset</button>
										</div>
									</div>
								</div>
							</form>
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

		function get_subCategory(value)
        {
			
			var sub_id = $('#sub_id').val();
           $.ajax({
            type: "POST",
            url: "{{route('get_subcategory')}}",
            data: {value},
            
            success: function (response) {
				option ="<option value='' >Select</option>";
                response.forEach((item)=>{
                   if(sub_id == item.id){
                    option +=`<option selected value="${item.id}" >${item.name}</option>`;
				   }else{
                    option +=`<option value="${item.id}" >${item.name}</option>`;
				   }
                 
                });
                $("#subcategory").empty();
                $("#subcategory").append(option);
            }
           });
        }

		 function total_cost()
        {
			var item=$("#quantity_of_items_purchased").val();
			var rate=$("#rate_per_item").val();
			if(item && rate){
				var total=(item*rate).toFixed(2);
				$("#total_cost_of_assets").val(total);
			}

        }

		function exp_date(value){
			$("#date_of_expiry,#last_date_of_warranty").attr({
			"min" : value   
			});
			
		}
		function get_type(value)
        {
			// $("#quantity_of_items_purchased").val('');
			// var fdcds="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"

			// alert(value);
			// $("#quantity_of_items_purchased").attr({
			// "oninput" : fdcds   
			// });
			// $("#quantity_of_items_purchased").attr("oninput","fdcds");
			
        }
		$('#quantity_of_items_purchased').keypress(function (e) {       
      
			var item=$("#unit").val();
			if(item == 1){
				var charCode = (e.which) ? e.which : event.keyCode       

				if (String.fromCharCode(charCode).match(/[^0-9]/g))       

				return false;   
			}
	  		                                            

		}); 
		$('.amc_required').click(function(e){
			var item=$('input[name="AMC_required"]:checked').val();
			if(item==1){
				$('#amc_div').text('*');
				$('#amc_field').prop('required',true);
			}else{
				$('#amc_div').text('');
				$('#amc_field').removeAttr('required');
			}
		})
	</script> 

@endpush
