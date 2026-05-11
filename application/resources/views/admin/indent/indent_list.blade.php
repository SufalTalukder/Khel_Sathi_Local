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
								<div class="col-md-2">
									 <a  href="{{route('indent')}}" title="Consumable Master List" class="btn btn-sm btn-primary">
			                           <span> Add Indent</span>
			                        </a>
									<a  title="Vendor Master List" class="btn btn-sm btn-success " onclick="ExportToExcel('xlsx')">
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
											<div id="list1" class="dropdown-check-list form-group">
												<label for="month">Indent Number</label>
												<input type="text" name="indent_no" value="{{request()->input('indent_no')}}" class="form-control">
											</div>
										</div>
									
										<div class="col-md-3">
											<div class="form-group">
												<label for="section">Section</label>
												<select class="form-control" id="section" name="section">
													<option value="all">--All--</option>
													@foreach($section as $section)
													<option {{request()->input('section') == $section->id ? 'selected' : ''}} value="{{ $section->id }}">{{ $section->name_hn }}</option>
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
									<table  id="dataTable" class="table table-bordred table-hover bg-white datatable" >
										<thead>
											<tr>
											<th>Sr. No.</th>    
											<th>Indent No.</th>    
											<th>Section</th>    
											<th>Raising Indent Date</th>  
											<th>Indent Type</th>
											<th width="10%">Added By</th>  
											<!-- <th width="15%" class="text-center">Status</th>   -->
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
												<!-- <td class="text-center">
													@if($item->indent_status == 0)
													<span class="btn btn-danger">Pending</span>
													@elseif($item->indent_status == 2)
													<span class="btn btn-danger">Disapprove</span>
													@else
													<span class="btn btn-success">Approved</span>
													@endif
												</td> -->
												
												<td>{{ rsoName($item->added_by) }}</td>
												<td class="text-center">
												<a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="intentDetails({{$item->indent_no}})"><i class="fa fa-eye"></i></a>
													@if($item->indent_status == 0)
														<!-- <a class="btn btn-sm btn-dark pointer bt" href="{{ route('addOrder' , $item->indent_no) }}">
															<i class="fa fa-edit"></i>
														</a> -->
														<a class="btn btn-sm btn-danger pointer bt"
															href="{{ route('deleteIntent' , $item->indent_no) }}" 
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
