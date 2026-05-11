@extends( 'layouts/admin_layout' )
@section( 'content' )
	<div class="card">
		
	<div class="card-header">
							<div class="row">
								<div class="col-md-12">
									
									<h5> Purchase Order Report

										<a  title="Order Report List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
											<i class="fa fa-file-excel"></i> Export to Excel
										</a>
										<a  href="{{url('admin/orderReportPdf')}}" title="Order Report List" class="btn btn-sm btn-primary float-end" >
											<i class="fa fa-file-pdf"></i> Export to PDF
										</a>
										
									</h5>
								</div>
							
							</div>
						</div>
						<div class="card-body">
							<div class="mb-4">
								<form action="{{ url()->current() }}" class="needs-validation" method="POST" autocomplete="off" id="formHostelMaster" novalidate>
									@csrf
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label for="vendor">Vendor</label>
												<select class="form-control" id="vendor" onchange="get_orderList(this.value)" name="vendor">
													<option value="all">--All--</option>
													@foreach($vendor as $vendor)
													<option {{request()->input('vendor') == $vendor->id ? 'selected' : ''}} value="{{ $vendor->id }}">{{ $vendor->name }}</option>
													</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="subcategory">Order No.</label>
												<input type="hidden" id="req_order_no"  value="{{request()->input('order_no')}}" />
												<select class="form-control" id="order_no" name="order_no">
													<option value="all">--select--</option>
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
							<div class="" id="proDiv">
							<div class="table-responsive">
									<table  id="dataTable" class="table table-bordred table-hover bg-white datatable" >
										<thead>
											<tr>
											<th>Sr. No.</th>    
											<th>Vendor Name</th>    
											<th>Order No.</th>    
											<th>Order Date</th>  
											<th>Item Type</th>  
											<th>Item Category</th>  
											<th>Item Name</th>  
											<th>Quantity</th>  
											<th>Rate Per Item</th>  
											<th>Amount (in Rs.)</th>   
											<th>Order Status</th>   
											<th>Added By</th>
											</tr>
										</thead>
										<tbody>
											@foreach($list as $key=>$item)
											<tr>

												<td>{{ $key+1 }}</td>
												<td>{{ $item->vendor }}</td>
												<td>{{ $item->orderNo }}</td>
												<td>{{ dmy($item->order_date) }}</td>
												<td>
													@if( $item->item_type_id == 1)
														Consumable
														@else
														Fixed-Assets
													@endif
												</td>   
												<td>{{ $item->category }}</td>
												<td>{{itemName($item->item_type_id,$item->item_id)}}</td>
												<td>{{ $item->quantity }}</td>
												<td>{{ $item->rate_per_item }}</td>
												<td>{{ $item->total_amount }}</td>
												<td class="text-center">
													@if($item->order_status == 1)
													Not Submitted
													@else
													Submitted
													@endif
												</td>
												<td>{{ rsoName($item->added_by) }}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
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
	         XLSX.writeFile(wb, fn || ('Purchase Order Report.' + (type || 'xlsx')));
	    }

		function get_subCategory(value)
        {
			var sub_id = $('#sub_id').val();
           $.ajax({
            type: "POST",
            url: "{{route('get_subcategory')}}",
            data: {value},
            
            success: function (response) {
				option ="<option value='all' >--All--</option>";
                response.forEach((item)=>{
                   if(sub_id == item.id){
                    option +=`<option selected value="${item.id}" >${item.name}</option>`;
				   }else{
                    option +=`<option value="${item.id}" >${item.name}</option>`;
				   }
                 
                });
				if(response.length !=0){
					$("#subcategory").empty();
                	$("#subcategory").append(option);
				}
              
            }
           });
        }

		function get_orderList(value)
        {
			var req_order_no = $('#req_order_no').val();
           $.ajax({
            type: "POST",
            url: "{{route('get_order_list')}}",
            data: {value},
            
            success: function (response) {
				option ="<option value='all' >--All--</option>";
                response.forEach((item)=>{
                   if(req_order_no == item.orderNo){
                    option +=`<option selected value="${item.orderNo}" >${item.orderNo}</option>`;
				   }else{
                    option +=`<option value="${item.orderNo}" >${item.orderNo}</option>`;
				   }
                 
                });
				if(response.length !=0){
					$("#order_no").empty();
                	$("#order_no").append(option);
				}
              
            }
           });
        }
	</script> 
@endpush
