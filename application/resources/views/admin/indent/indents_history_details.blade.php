@extends( 'layouts/admin_layout' )
@section( 'content' )
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									
									<h5> Indents Report</h5>
								</div>
							
							</div>
						</div>
						<div class="card-body">

							
								<div class="table-responsive">
									<table  id="dataTable" class="table table-bordred table-hover bg-white" >
										<thead>
											<tr>
												<th >S.No.</th>
												<th >Indent Number</th>
												<th >Indent Raised For</th>
												<th >Item Type</th>
												<th >Item Category</th>
												<th>Item Name</th>
												<th >Total Quantity</th>
												<th >By</th>
												<th >Date</th>
											
											</tr>
										</thead>
										<tbody>
											@php $tttt=0 @endphp
											{{--<tr style=" background: burlywood; text-align: center; font-size: x-large; "> <td colspan="9">Old Record</td> </tr>
										
											
											 <tr>
												<td>1</td>
												<td>NA</td>
												<td>NA</td>
												<td>{{ $old_stock->item_name }}</td>
												<td>{{ $old_stock->vendor }}</td>
												<td>{{ $old_stock->quantity_of_items_purchased }}</td>
												<td>{{ rsoName($old_stock->added_by) }}</td>
												<td>{{ dmy($old_stock->purchase_date) }}</td>
											</tr> 
										@php $tttt += $old_stock->quantity_of_items_purchased; @endphp 
										--}}
										<tr style=" background: burlywood; text-align: center; font-size: x-large; "> <td colspan="9">Received Items</td> </tr>
										 @if(count($issued) > 0)
										@foreach($issued as $key=>$item)
											<tr>
												<td>{{ $key+1 }}</td>
												<td>{{ $item->indent_no }}</td>
												<td>
													@if($item->indent_for == 1)
													Section
													@else
													Individual
													@endif
												</td>

												<td >
													@if($item->item_type_id == 1)
													Consumable
													@else
													Fixed Assets
													@endif
												</td>
												<td>{{ $item->category }}</td>
												<td>{{ itemName($item->item_type_id,$item->item_id) }}</td>
												<td>{{ $item->issue_quantity }}</td>
												<td>{{ rsoName($item->issued_by) }}</td>
												<td>{{ dmy($item->date_of_issuance) }}</td>
											</tr>
											@php $tttt += $item->issue_quantity - $item->return_quantity; @endphp 
										@endforeach
										@else
										<tr style=" text-align: center; "> <td colspan="9">No Record Found</td> </tr>
										@endif 

										<tr style=" background: burlywood; text-align: center; font-size: x-large; "> <td colspan="9">Returned Items</td> </tr>
										 @if(count($return) > 0)
										@foreach($return as $key=>$item)
											<tr>
											<td>{{ $key+1 }}</td>
												<td>{{ $item->indent_no }}</td>
												<td>
													@if($item->indent_for == 1)
													Section
													@else
													Individual
													@endif
												</td>

												<td >
													@if($item->item_type_id == 1)
													Consumable
													@else
													Fixed Assets
													@endif
												</td>
												<td>{{ $item->category }}</td>
												<td>{{ itemName($item->item_type_id,$item->item_id) }}</td>
												<td>{{ $item->return_quantity }}</td>
												<td>{{ rsoName($item->return_by) }}</td>
												<td>{{ dmy($item->date_of_return) }}</td>
											</tr>
											
										@endforeach
										@else
										<tr style=" text-align: center; "> <td colspan="9">No Record Found</td> </tr>
										@endif 

										<tr style=" background: beige; font-size: 20px; font-weight: bold; "> 
											<td colspan="8"><span  style=" float: right; ">Total Available Quantity :</span></td>
											<td colspan="1">{{ $tttt }}</td>
										</tr>
										</tbody>
									</table>
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

		
	</script> 

@endpush
