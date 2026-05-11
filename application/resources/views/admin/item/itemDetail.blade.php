@extends( 'layouts/admin_layout' )
@section( 'content' )
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									
									<h5> Items Report</h5>
								</div>
							
							</div>
						</div>
						<div class="card-body">

							
								<div class="table-responsive">
									<table  id="dataTable" class="table table-bordred table-hover bg-white" >
										<thead>
											<tr>
												<th width="6%">S.No.</th>
												<th width="20%">Order No.</th>
												<th width="20%">Challan No.</th>
												<th width="20%">Item Name</th>
												<th width="20%">Vendor Name</th>
												<th width="20%">Total Quantity</th>
												<th width="20%">Added By</th>
												<th width="20%">Purchase Date</th>
											
											</tr>
										</thead>
										<tbody>
											@php $tttt=0 @endphp
										<tr style=" background: burlywood; text-align: center; font-size: x-large; "> <td colspan="8">Opening Stock</td> </tr>
										
											
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

										<!--  -->
										<tr style=" background: burlywood; text-align: center; font-size: x-large; "> <td colspan="8">Requested Items</td> </tr>
										@if(count($order_history) > 0)
										@foreach($order_history as $key=>$item)
											<tr>
												<td>{{ $key+1 }}</td>
												<td>{{ $item->orderNo }}</td>
												<td>NA</td>
												<td>{{ itemName(1,$item->item_id) }}</td>
												<td>{{ $item->vendor }}</td>
												<td>{{ $item->quantity }}</td>
												<td>{{ rsoName($item->added_by) }}</td>
												<td>{{ dmy($item->created_at) }}</td>
											</tr>
										@endforeach
										@else
										<tr style=" text-align: center; "> <td colspan="8">No Record Found</td> </tr>
										@endif

										<!--  -->

										<tr style=" background: burlywood; text-align: center; font-size: x-large; "> <td colspan="8">Received Items</td> </tr>
										@if(count($new_stock) > 0)
										@foreach($new_stock as $key=>$item)
											<tr>
												<td>{{ $key+1 }}</td>
												<td>{{ $item->orderNo }}</td>
												<td>{{ $item->challan_no }}</td>
												<td>{{ itemName(1,$item->item_id) }}</td>
												<td>{{ $item->vendor }}</td>
												<td>{{ $item->quantity_recieved }}</td>
												<td>{{ rsoName($item->added_by) }}</td>
												<td>{{ dmy($item->created_at) }}</td>
											</tr>
											@php $tttt += $item->quantity_recieved; @endphp 
										@endforeach
										@else
										<tr style=" text-align: center; "> <td colspan="8">No Record Found</td> </tr>
										@endif

										<tr style=" background: burlywood; text-align: center; font-size: x-large; "> <td colspan="8">Returned Items</td> </tr>
										@if(count($return_stock) > 0)
										@foreach($return_stock as $key=>$item)
											<tr>
												<td>{{ $key+1 }}</td>
												<td>{{ $item->orderNo }}</td>
												<td>{{ $item->challan_no }}</td>
												<td>{{ itemName(1,$item->item_id) }}</td>
												<td>{{ $item->vendor }}</td>
												<td>{{ $item->quantity_return }}</td>
												<td>{{ rsoName($item->added_by) }}</td>
												<td>{{ dmy($item->created_at) }}</td>
											</tr>
											@php $tttt -= $item->quantity_return; @endphp 
										@endforeach
										@else
										<tr style=" text-align: center; "> <td colspan="8">No Record Found</td> </tr>
										@endif

										<!--  -->
										<tr style=" background: burlywood; text-align: center; font-size: x-large; "> <td colspan="8">Approved Indents </td> </tr>
										@if(count($approved_indents) > 0)
										@foreach($approved_indents as $key=>$item)
											<tr>
												<td>{{ $key+1 }}</td>
												<td>NA</td>
												<td>NA</td>
												<td>{{ itemName($item->item_type_id,$item->item_id) }}</td>
												<td>NA</td>
												<td>{{ $item->issued_quantity }}</td>
												<td>{{ rsoName($item->added_by) }}</td>
												<td>{{ dmy($item->created_at) }}</td>
											</tr>
											
										@endforeach
										@else
										<tr style=" text-align: center; "> <td colspan="8">No Record Found</td> </tr>
										@endif

										<!--  -->

										<!--  -->
										<tr style=" background: burlywood; text-align: center; font-size: x-large; "> <td colspan="8">Returned Indents </td> </tr>
										@if(count($returned_indents) > 0)
										@foreach($returned_indents as $key=>$item)
											<tr>
												<td>{{ $key+1 }}</td>
												<td>NA</td>
												<td>NA</td>
												<td>{{ itemName($item->item_type_id,$item->item_id) }}</td>
												<td>NA</td>
												<td>{{ $item->return_quantity }}</td>
												<td>{{ rsoName($item->added_by) }}</td>
												<td>{{ dmy($item->created_at) }}</td>
											</tr>
											
										@endforeach
										@else
										<tr style=" text-align: center; "> <td colspan="8">No Record Found</td> </tr>
										@endif

										<!--  -->

										<tr style=" background: beige; font-size: 20px; font-weight: bold; "> 
											<td colspan="6"><span  style=" float: right; ">Total Stock Quantity :</span></td>
											<td colspan="2">{{ stock_item($item_id,1) }}</td>
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
