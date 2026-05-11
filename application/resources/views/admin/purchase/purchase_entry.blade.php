@extends( 'layouts/admin_layout' )
@section( 'content' )

				<style>
					.panel-heading{
						padding: 10px 15px;
						border-bottom: 1px solid transparent;
						border-top-left-radius: 3px;
						border-top-right-radius: 3px;
						color: #31708f;
						background-color: #d9edf7;
						border-color: #bce8f1;
					}
					table th{
						color:#212529;
					}
					</style>

				

					<div class="pageheader" id="menu-margin">
						<div class="row">
							<div class="col-md-8">
								<h4 class="mb-0">Purchase Order Invoice Details</h4>
							</div>
							<div class="col-md-4">
							<!-- <a href="{{route('listOrder')}}" class="btn btn-primary" style="float: right;">Details of Purchase Details</a> -->
							</div>
						</div>
					</div>
					
					<div class="card mb-3">

						<div class="card-body">
								<div class="row">
									<div class="row mt-3">
										<div class="col-md-6">
											<div class="form-group">
												<label for="vendor_id">Vendor Name <span class="text-danger">*</span></label>
													<select  id="vendor_id" class="form-control"  name="vendor_id"  required>
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
										<div class="col-md-6">
											<div class="form-group">
												<label for="order_id">Order No. <span class="text-danger">*</span></label>
													<select  id="order_id" class="form-control"  name="order_id"  required>
														
													</select>
												<div class="invalid-feedback">
													Please provide Order No.
												</div>
												@if ($errors->has('order_id'))
												<span class="error_mess">{{ $errors->first('order_id') }}</span> @endif
											</div>
										</div>
									
										<div class="col-lg-12" id="itemdetail">

											
										</div>

										</div>
									</div>
								</div>
						</div>
				


@endsection
@push( 'custom-scripts' )
	<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
	<script>

		$(document.body).on('change', '#vendor_id', function () {
			var vendor_id = $(this).val();
			if(vendor_id){
			$.ajax({
				type: "POST",
				url: "{{route('get_vendor_order')}}",
				data: {vendor_id: vendor_id},
				
				success: function (response) {
					option ="<option value='' >- Select -</option>";
					if(response){
						response.forEach((item)=>{
								option +=`<option  value="${item.orderNo}" >${item.orderNo}</option>`;
						});
					}
					$('#order_id').empty();
					$('#order_id' ).append(option);
				}
			});
		}
		});

		$(document.body).on('change', '#order_id', function () {
			var order_id = $(this).val();
			var vendor_id = $('#vendor_id').val();
			if(order_id){
			$.ajax({
				type: "POST",
				url: "{{route('get_vendor_order_detail')}}",
				data: {vendor_id: vendor_id,order_id:order_id},
				
				success: function (response) {
					
					$('#itemdetail').empty();
					$('#itemdetail').append(response);
				}
			});
		}
		});
		
	</script> 

@endpush
