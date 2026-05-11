@extends( 'layouts/admin_layout' )
@section( 'content' )
			<div class="row">

				<div class="col-md-12">

					<div class="pageheader" id="menu-margin">
						<div class="row">
							<div class="col-md-8">
								<h4 class="mb-0">@if(isset($list)) Edit @else Add @endif  Consumable  Items Purchased</h4>
							</div>
							<div class="col-md-4">
							<a href="{{route('ConsumableItem')}}" class="btn btn-primary" style="float: right;">Details of Added Consumable Item</a>
							</div>
						</div>
					</div>
					
					<div class="card mb-3">

						<div class="card-body">
							<form action="{{ route('saveConsumableItem') }}" id="preregistration" class="needs-validation" enctype="multipart/form-data" method="post" autocomplete="off" novalidate>
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
												<label for="subcategory">2)Sub Category <span class="text-danger">*</span></label>
												
												<input type="hidden" id="sub_id" @if(isset($list)) value="{{$list->subcategory}}" @endif/>
												
													<select  id="subcategory" class="form-control" name="subcategory"  required>
														
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
												<input type="date" class="form-control"   id="purchase_date" name="purchase_date" @if(isset($list)) value="{{ $list->purchase_date }}" @else  value="{{ old('purchase_date') }}" @endif placeholder="Enter Date of Purchase" required="">
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
													<select  id="unit" class="form-control"  onchange="get_type(this.value)"  name="unit"  required>
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
												<!-- <input type="text"  maxlength="10" onkeyup="total_cost()"  class="form-control" id="quantity_of_items_purchased" name="quantity_of_items_purchased" @if(isset($list)) value="{{ $list->quantity_of_items_purchased }}" @else  value="{{ old('quantity_of_items_purchased') }}" @endif placeholder="Quantity of Items Purchased." required=""> -->
												<input type="text"  maxlength="10" onkeyup="total_cost()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="quantity_of_items_purchased" name="quantity_of_items_purchased" @if(isset($list)) value="{{ $list->quantity_of_items_purchased }}" @else  value="{{ old('quantity_of_items_purchased') }}" @endif placeholder="Quantity of Items Purchased." required="">
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
												<label for="description">11) Description</label>
												<textarea id="description" class="form-control" name="description" rows="1" cols="50" >@if(isset($list)) {{ $list->description }} @endif</textarea>
												
												<!-- <input type="text"  class="form-control"  id="asset_image" name="asset_image"> -->
												
											</div>
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
			// alert("hello");
			var item=$("#quantity_of_items_purchased").val();
			var rate=$("#rate_per_item").val();
			if(item && rate){
				var total=(item*rate).toFixed(2);
				$("#total_cost_of_assets").val(total);
			}

        }
		function get_type(value)
        {
			$("#quantity_of_items_purchased").val('');
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
				console.log(e)
				var charCode = (e.which) ? e.which : event.keyCode       

				if (String.fromCharCode(charCode).match(/[^0-9]/g))       

				return false;   
			}
	  		                                            

		});      
		
	</script> 

@endpush
