@extends( 'layouts/admin_layout' )
@section( 'content' )

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h5> Details of All Indents</h5>
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
											<th>Indent No.</th>    
											<th>Section</th>    
											<th>Raising Indent Date</th>  
											<th>Indent Type</th>  
											<th width="10%">Added By</th>
											<th width="15%" class="text-center">Status</th>  
											<th width="15%" class="text-center no-print">Action</th>  
											
											</tr>
										</thead>
										<tbody>
											@foreach($list as $key=>$item)
											<tr>

												<td>{{ $key+1 }}</td>
												<td>{{ $item->indent_no }}</td>
												<td>{{ $item->section }}</td>
												<td>{{ dmy($item->indent_date) }}</td>
												<td>
													@if($item->indent_for == 1)
													Section
													@else
													Individual
													@endif
												</td>
												<td>{{ rsoName($item->added_by) }}</td>
												<td class="text-center">
													@if($item->indent_status == 0)
													<span class="btn btn-danger">Pending</span>
													@else
													<span class="btn btn-success">Approved</span>
													@endif
												</td>
												
												
												<td class="text-center">
														<a class="btn btn-sm btn-dark pointer bt" href="{{ route('indent_history_details' , $item->indent_no) }}">
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
