@extends( 'layouts/admin_layout' )
@section( 'content' )


					<div class="pageheader" id="menu-margin">
						<div class="row">
							<div class="col-md-8">
								<h4 class="mb-0">@if(isset($list)) Edit @else Add @endif  Purchase Order Details</h4>
							</div>
							<div class="col-md-4">
							<a href="{{route('listOrder')}}" class="btn btn-primary" style="float: right;">Details of Purchase Details</a>
							</div>
						</div>
					</div>
					
					<div class="card mb-3">

						<div class="card-body">
							<form action="{{ route('saveOrder') }}" id="preregistration" class="needs-validation" enctype="multipart/form-data" method="post" autocomplete="off" novalidate>
								<div class="row">
									

									
									<div class="row mt-3">
										<div class="col-md-4">
											<div class="form-group">
												<label for="vendor_id">Vendor Name <span class="text-danger">*</span></label>
													<select  id="vendor_id" class="form-control" name="vendor_id"  required>
														<option value="">Select</option>
														@foreach ($vendor as $type)
														<option  value="{{$type->id}}" @if(isset($list) && $list[0]->vendor_id == $type->id ) selected @endif {{ old('vendor') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
														@endforeach
													</select>
												<div class="invalid-feedback">
													Please provide Vendor Name.
												</div>
												@if ($errors->has('vendor_name'))
												<span class="error_mess">{{ $errors->first('vendor_name') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="order_date">Order Date <span class="text-danger">*</span></label>
												<input type="date" class="form-control" onchange="exp_date(this.value);"  min="<?php echo date("Y-m-d"); ?>" id="order_date" name="order_date" @if(isset($list)) value="{{ $list[0]->order_date }}" @else  value="{{ old('order_date') }}" @endif placeholder="Enter Date of Order" required="">
												<div class="invalid-feedback">
													Please provide Date of Order.
												</div>
												@if ($errors->has('order_date'))
												<span class="error_mess">{{ $errors->first('order_date') }}</span> @endif
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="supply_date">Last Date of Supply <span class="text-danger">*</span></label>
												<input type="date" class="form-control"   id="supply_date" name="supply_date" @if(isset($list)) value="{{ $list[0]->supply_date }}" @else  value="{{ old('supply_date') }}" @endif placeholder="Enter Date of Supply" required="">
												<div class="invalid-feedback">
													Please provide Date of Supply.
												</div>
												@if ($errors->has('supply_date'))
												<span class="error_mess">{{ $errors->first('supply_date') }}</span> @endif
											</div>
										</div>
										
									</div>
									
									<div class="col-sm-12  mt-3">
										<div class="form-group pull-right">
											<button type="button" id="addmore" class="btn btn-info "><i class="fa fa-plus"></i> Items</button>
										</div>
									</div>

									<div class="col-md-12 mt-3">
										<div class="form-group">
											<form name="add_name" id="add_name">
												<table   class="table" id="paperdetails">
													<thead>
														<tr>
															<td ><label>Item Type</label></td>
															<td ><label>Item Category</label></td>
															<td ><label>Item Sub Category</label></td>
															<td ><label>Item Name</label></td>
															<td ><label>Unit</label></td>
															<td ><label>Quantity</label></td>
															<td ><label>Rate Per Item</label></td>
															<td ><label>Amount (in Rs.)</label></td>
															<td ><label>Action</label></td>
															
														</tr>
													</thead>
													<tbody>
														@if(isset($list)) 
														@foreach($list as $key=>$item)
															@if(isset($list)) 
																<input type="hidden" name="orderNo" value="{{ $item->orderNo }}">
															@endif
														<tr>
															<td>
																<select name="item_type_id[]" required class="form-select itemtype">
																	<option value="">- Select -</option>
																	<option  {{$item->item_type_id=='1'?'Selected':''}} value="1">Consumable</option>
																	<option  {{$item->item_type_id=='2'?'Selected':''}} value="2">Fixed-Assets</option>
																</select>
															</td>
															<td>
																<input type="hidden" value="{{$item->category_id}}" class="catid1">
																<select class="form-select catid" name="category_id[]" id="category_id" required>
																	<option value="">- Select -</option>
																</select>
															</td>
															<td>
																<input type="hidden" value="{{$item->sub_category_id}}" class="sub_cat1">
																<select class="form-select sub_cat" name="sub_category_id[]"   id="sub_category_id" required>
																	<option value="">- Select -</option>
																</select>
															</td>
															<td>
																<input type="hidden" value="{{$item->item_id}}" class="item_id1">
																<select class="form-select item_id" name="item_id[]" id="item_id" required>
																	<option value="">- Select -</option>
																</select>
															</td>

															<td><input type="text" required value="{{$item->unit}}" name="unit[]" placeholder="Unit" readonly class="form-control unit"></td>
															<td><input type="text"  maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control quantity" id="quantity" name="quantity[]" value="{{ $item->quantity }}" placeholder="Quantity." required=""></td>
															<td><input type="text" maxlength="10"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control rate" id="rate_per_item" name="rate_per_item[]" value="{{ $item->rate_per_item }}" placeholder="Enter Rate Per Item." required=""></td>
															<td><input type="text" required value="{{$item->total_amount}}" readonly name="total_amount[]" placeholder="Amount (in Rs.)" class="form-control amount"></td>
															
															<td>
																@if($key==1)
																<button type='button'  class='btn btn-danger remove' title='Remove'><i class='fa fa-remove'></i></button>
																@endif
															</td>
														</tr>
														@endforeach
														@else
														<tr>
															<td>
																<select name="item_type_id[]" required class="form-select itemtype">
																	<option value="">- Select -</option>
																	<option  {{old('item_type_id')=='1'?'Selected':''}} value="1">Consumable</option>
																	<option  {{old('item_type_id')=='2'?'Selected':''}} value="2">Fixed-Assets</option>
																</select>
															</td>
															<td>
																<select class="form-select catid" name="category_id[]" id="category_id" required>
																	<option value="">- Select -</option>
																</select>
															</td>
															<td>
																<select class="form-select sub_cat" name="sub_category_id[]"   id="sub_category_id" required>
																	<option value="">- Select -</option>
																</select>
															</td>
															<td>
																<select class="form-select item_id" name="item_id[]" id="item_id" required>
																	<option value="">- Select -</option>
																</select>
															</td>

															<td><input type="text" required value="{{old('unit') }}" name="unit[]" placeholder="Unit" readonly class="form-control unit"></td>
															<td><input type="text"  maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control quantity" id="quantity" name="quantity[]" @if(isset($list)) value="{{ $list->quantity }}" @else  value="{{ old('quantity') }}" @endif placeholder="Quantity." required=""></td>
															<td><input type="text" maxlength="10"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control rate" id="rate_per_item" name="rate_per_item[]" @if(isset($list)) value="{{ $list->rate_per_item }}" @else  value="{{ old('rate_per_item') }}" @endif placeholder="Enter Rate Per Item." required=""></td>
															<td><input type="text" required value="{{old('total_amount') }}" readonly name="total_amount[]" placeholder="Amount (in Rs.)" class="form-control amount"></td>
															
															<td>
																
															</td>
														</tr>
														@endif
													</tbody>
												</table>
												<!--<input type="submit" class="btn btn-success" name="submit" id="submit" value="Submit">-->
											</form>
										</div>
									</div>
									<div class="col-md-2 d-grid">
										<label class="form-label">&nbsp;</label>
										<!-- <a class="btn btn-info btn-sm" id="check1">Save</a> -->
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
				


@endsection
@push( 'custom-scripts' )
	<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
	<script>

		// $('#check1').click(function() {
            
        //         $('#order_view').modal('toggle');
		// 		var thehtm=$("#paperdetails").html();
		// 		$("#order_details").append7($("#paperdetails").html());
        // });
	    function ExportToExcel(type, fn, dl) {
	       var elt = document.getElementById('dataTable');
	       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
	     
	       return dl ?
	         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
	         XLSX.writeFile(wb, fn || ('Vendor Master List.' + (type || 'xlsx')));
	    }

		$(document.body).on('keyup', '.quantity', function () {
			var rate = $(this).parent().next().find('.rate');
			var quantity = $(this);
			
			if(quantity.val()!="" && rate.val()!=""){
				var totsquan =  (parseFloat(rate.val()) * parseFloat(quantity.val())).toFixed(2);
				$(this).parent().next().next().find('.amount').val(totsquan);
			} else {
				$(this).parent().next().next().find('.amount').val();
			}
			$(this).parent().next().next().find('.amount').val();
		});
		$(document.body).on('keyup', '.rate', function () {
			var rate = $(this);
			var quantity = $(this).parent().prev().find('.quantity');

			if (quantity.val() == '' && quantity.val() <= 0) {
				alert("Please enter quantity first and then enter rate.!");
				return false;
			} if(quantity.val()!="" && rate.val()!=""){
				var totsrate = (parseFloat(rate.val()) * parseFloat(quantity.val())).toFixed(2);;
				$(this).parent().next().find('.amount').val(totsrate);
			} else {
				$(this).parent().next().find('.amount').val();
			} 
			$(this).parent().next().next().find('.amount').val();
			
		});
		function exp_date(value){
			$("#supply_date").attr({
			"min" : value   
			});
		}

	
	
		$(document.body).on('change', '.itemtype', function () {
			var catid = $(this).parent().next().find('.catid');
			var catid1 = $(this).parent().next().find('.catid1').val();
			
			var itemtype = $(this).val();                       
			$.ajax({
            type: "POST",
            url: "{{route('get_category')}}",
            data: {value:itemtype},
            
            success: function (response) {
				option ="<option value='' >- Select -</option>";
				if(response){
					response.forEach((item)=>{
						if(catid1){
							option +=`<option ${item.id==catid1?'selected':''} value="${item.id}" >${item.name}</option>`;

						}else{
							option +=`<option value="${item.id}" >${item.name}</option>`;

						}
					
					});
				}
               
				$(catid ).empty();
				$(catid ).append(option);
				$(catid).trigger("change");
                // $(this).parent().next().find('.catid').append(option); 
            }
           });
		});

		$(document.body).on('change', '.catid', function () {
			var sub_cat = $(this).parent().next().find('.sub_cat');
			var sub_cat1 = $(this).parent().next().find('.sub_cat1').val();
			var itemtype = $(this).val();                       
			$.ajax({
            type: "POST",
            url: "{{route('get_subcategory')}}",
            data: {value:itemtype},
            success: function (response) {
				option ="<option value='' >- Select -</option>";
				if(response){
					response.forEach((item)=>{
						if(sub_cat1){
							option +=`<option  ${item.id==sub_cat1?'selected':''} value="${item.id}" >${item.name}</option>`;
						}else{
							option +=`<option value="${item.id}" >${item.name}</option>`;
						}
					
					});
				}
                // $(this).parent().next().find('.sub_cat').html(option); 
				$(sub_cat ).empty();
				$(sub_cat ).append(option);
				$(sub_cat).trigger("change");
            }
           });
		});

		

		$(document.body).on('change', '.sub_cat', function () {
			var itemtype = $(this).closest('tr').find('td:first').find('.itemtype');
			if (itemtype.val() === '') {
				$(this).val('');
				return false;
			}
			var item_id = $(this).parent().next().find('.item_id');
			var item_id1 = $(this).parent().next().find('.item_id1').val();
			var sub_cat = $(this).val();
			$.ajax({
				type: "POST",
				url: "{{route('get_item')}}",
				data: {sub_cat: sub_cat, itemtype: itemtype.val()},
				
				success: function (response) {
					option ="<option value='' >- Select -</option>";
					if(response){
						response.forEach((item)=>{
							if(item_id1){
								option +=`<option ${item.id==item_id1?'selected':''} data-unit="${item.unit}" value="${item.id}" >${item.item_name}</option>`;
							}else{
								option +=`<option data-unit="${item.unit}" value="${item.id}" >${item.item_name}</option>`;
							}
						
						});
					}
					$(item_id ).empty();
					$(item_id ).append(option);
					$(item_id).trigger("change");
				}
			});
		});

		$(document.body).on('change', '.item_id', function () {
			var selecteditem = $(this);
			var selectedcat = selecteditem.parent().prev().find(".sub_cat")
			$('.item_id').each(function (index, value) {
				var item = $(this);
				var cat = item.parent().prev().find(".sub_cat");
				if (item.val() != '' && (!selecteditem.is(item))) {
					if (cat.val() === selectedcat.val() && item.val() === selecteditem.val()) {
						// console.log("cat.val()" + cat.val())
						// console.log("selectedcat.val()" + selectedcat.val())
						// console.log("item.val()" + item.val())
						// console.log("selecteditem.val()" + selecteditem.val())

						selecteditem.val("");
						alert("Item Already Selected");
						return false;
					}
				}
			});
			var unit = $(this).parent().next().find('.unit');
			unit.val($(this).find(':selected').attr('data-unit'));
		});


		$('#addmore').on('click', function () {
			var itemtype = $('.itemtype').parent();
			var catid = $('.catid').parent();
			var sub_cat = $('.sub_cat').parent();
			var item_id = "<select name='item_id[]' class='form-select item_id'><option value=''>- Select -</option></select>"
			var unit = "<input type='text' required='' value='' name='unit[]' placeholder='Unit' readonly='' class='form-control unit'>";
			var quantity = "<input type='text'  maxlength='10'  oninput='this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');' class='form-control quantity' id='quantity' name='quantity[]'  value='' placeholder='Quantity.' required=''>";
			var rate = "<input type='text'  maxlength='10'  oninput='this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');' class='form-control rate' id='rate_per_item' name='rate_per_item[]'   value=''  placeholder='Rate Per Item.' required=''>";
			var amount = "<input type='text' readonly='readonly' name='total_amount[]' class='form-control amount'>";
			var remove = "<button type='button'  class='btn btn-danger remove' title='Remove'><i class='fa fa-remove'></i></button>";
			$('#paperdetails').find('tr:last').after("<tr><td>" + itemtype.html() + "</td><td>" + catid.html()+ "</td><td>" + sub_cat.html() + "</td><td>" + item_id + "</td><td>" + unit + "</td><td>" + quantity + "</td><td>" + rate + "</td><td>" + amount + "</td><td>" + remove + "</td></tr>");
		});

		$(document.body).on('click', '.remove', function () {
			if ($('#paperdetails tr').length > 1) {
				$(this).closest('tr').remove();
			}
		});

		$(document.body).on('keypress', '.quantity', function (e) {
			var unit = $(this).parent().prev().find('.unit').val();
			if(unit === "Piece"){
				console.log(e)
				var charCode = (e.which) ? e.which : event.keyCode       

				if (String.fromCharCode(charCode).match(/[^0-9]/g))       

				return false;   
			}
		});
	</script> 

@endpush
