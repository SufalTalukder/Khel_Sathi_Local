@extends( 'layouts/admin_layout' )
@section( 'content' )
	<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h5> Details of Added  Assets</h5>
								</div>
								<div class="col-md-2">
									 <a  href="{{route('addOrder')}}" title="Master List" class="btn btn-sm btn-primary">
			                           <span> Add Order</span>
			                        </a>
									<a  title="Vendor Master List" class="btn btn-sm btn-success " onclick="ExportToExcel('xlsx')">
			                            <i class="fa fa-file-excel"></i> Export to Excel
			                        </a>
								</div>
							</div>
						</div>
						<div class="card-body">
							{{-- <div class="mb-4">
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
							</div> --}}
							<div class="">
								<div class="table-responsive">
									<table  id="dataTable" class="table table-bordred table-hover bg-white datatable" >
										<thead>
											<tr>
											<th>Sr. No.</th>    
											<th>Vendor Name</th>    
											<th>Order No.</th>    
											<th>Order Date</th>  
											<th width="10%">Added By</th>
											<th width="15%" class="text-center">Status</th>  
											<th width="15%" class="text-center no-print">Action</th>  
											
											</tr>
										</thead>
										<tbody>
											@foreach($list as $key=>$item)
											<tr>

												<td>{{ $key+1 }}</td>
												<td>{{ $item->vendor }}</td>
												<td>{{ $item->orderNo }}</td>
												<td>{{ dmy($item->order_date) }}</td>
												<td>{{ rsoName($item->added_by) }}</td>
												<td class="text-center">
													@if($item->order_status == 1)
													<a class="btn btn-sm btn-danger pointer bt"
													href="{{ route('generatePO' , $item->orderNo) }}" 
													onclick="return confirm('Are you sure for submit PO ?')">
													Submit PO
													</a>
													@else
													PO Generated
													@endif
												</td>
												
												
												<td class="text-center">
												<a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="orderDetails({{$item->orderNo}})"><i class="fa fa-eye"></i></a>
													@if($item->order_status == 1)
														<a class="btn btn-sm btn-dark pointer bt" href="{{ route('addOrder' , $item->orderNo) }}">
															<i class="fa fa-edit"></i>
														</a>
														<a class="btn btn-sm btn-danger pointer bt"
															href="{{ route('deleteOrder' , $item->orderNo) }}" 
															onclick="return confirm('Are you sure you want to delete ?')">
															<i class="fa fa-trash"></i>
														</a>
													@endif
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
