@extends( 'layouts/admin_layout' )
@section( 'content' )

			<div class="row">
			
				<div class="col-md-12">
					
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-12">
									
									<h5> Indents Issued Report
										<a  title="Division Manager List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
											<i class="fa fa-file-excel"></i> Export to Excel
										</a>
										<a  href="{{url('admin/indentReportPdf')}}" title="Order Report List" class="btn btn-sm btn-primary float-end" >
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
												<th>Employee</th>  
												<th>Item Type</th>   
												<th>Item Category</th>   
												<th>Item Name</th>   
												<th>Quantity Issued</th>   
												<th>Date of Issuance</th>   
												<th>Added By</th>
											</tr>
										</thead>
										<tbody>
											@foreach($list as $key=>$item)
											<tr>

												<td>{{ $key+1 }}</td>
												<td>{{ $item->indent_no }}</td>
												<td>{{ $item->section }}</td>
												<td>
													@if( $item->employee_id)
														{{employeeName($item->employee_id)}}
														@else
														N/A
													@endif
												</td>
												<td>
													@if( $item->item_type_id == 1)
														Consumable
														@else
														Fixed-Assets
													@endif
												</td>
												<td>{{ $item->category }}</td>
												<td>{{itemName($item->item_type_id,$item->item_id)}}</td>
												<td>{{ $item->issued_quantity }}</td>
												<td>{{ dmy($item->issuance_date) }}</td>
												<td>{{ rsoName($item->added_by) }}</td>
												
												
												
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
	         XLSX.writeFile(wb, fn || ('Indents Issued Report.' + (type || 'xlsx')));
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
