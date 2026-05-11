@extends( 'layouts/admin_layout' )
@section( 'content' )
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-12">
									
									<h5> Items Report</h5>
								
									<a  href="{{url('admin/itemsInventoryPdf')}}" title="Order Report List" class="btn btn-sm btn-primary float-end" >
										<i class="fa fa-file-pdf"></i> Export to PDF
									</a>
									<a  title="Items Report" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
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
												<select class="form-control" id="category"  onchange="get_subCategory(this.value)"  name="category">
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
												<input type="hidden" id="sub_id"  value="{{request()->input('subcategory')}}" />
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

						
								<div class="table-responsive">
									<table  id="dataTable1" class="table table-bordred table-hover bg-white datatable" >
										<thead>
											<tr>
												<th width="6%">S.No.</th>
												<th width="20%">Category</th>
												<th width="20%">Sub Category</th>
												<th width="20%">Name of Item</th>
												<th width="20%">Code of Item</th>
												<th width="20%">Stock Quantity</th>
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
												
												{{--<td>{{ tItem($item->quantity_of_items_purchased,$item->id) }}</td>--}}
												<td>{{ stock_item($item->id,1) }}</td>
												<td>{{ rsoName($item->added_by) }}</td>
												<td class="text-center">
												<a class="btn btn-sm btn-dark pointer bt" href="{{ route('itemDetail' , $item->id) }}">
													<i class="fa fa-eye"></i>
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
@endsection
<!-- modal for stock alert -->
<div class="modal fade" id="stock_alert" tabindex="-1" aria-labelledby="forwrdedLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="forwrdedLabel">Stock Alert</h5>
										<button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<div class="">
								<div class="table-responsive">
												<table  id="dataTable" class="table table-bordred table-hover bg-white datatable" >
													<thead>
														<tr>
															<th width="6%">S.No.</th>
															<th width="20%">Name of Item</th>
															<th width="20%">Code of Item</th>
															<th width="20%">Stock Quantity</th>
															<th width="10%">Added By</th>
															<th width="20%">Alert Stock Quantity</th>
														
														</tr>
													</thead>
													<tbody>
														@foreach($stock_alert as $key=>$item)
														<tr>

															<td>{{ $key+1 }}</td>
															<td>{{ $item->item_name }}</td>
															<td>{{ $item->item_code }}</td>
															<td>{{ $item->in_stock }}</td>
															<td>{{ rsoName($item->added_by) }}</td>
															<td>{{ $item->stock_alert }}</td>
														</tr>
														@endforeach
													</tbody>															
												</table>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
									</div>
							</div>
						</div>
					</div>
				<!-- end modal for stock alert -->	
@push( 'custom-scripts' )
	<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
	<script>
		
		$(window).on('load', function() {
			var aaa = '<?= count($stock_alert);?>';
			if(aaa!=0){
				$('#stock_alert').modal('show');
			}
		});
		

	    function ExportToExcel(type, fn, dl) {
	       var elt = document.getElementById('dataTable1');
	       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
	     
	       return dl ?
	         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
	         XLSX.writeFile(wb, fn || ('Items Report.' + (type || 'xlsx')));
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
	</script> 

@endpush
