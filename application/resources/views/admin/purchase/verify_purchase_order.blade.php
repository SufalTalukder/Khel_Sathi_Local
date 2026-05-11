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
								<h4 class="mb-0">Verify PO Invoice Details</h4>
							</div>
							<div class="col-md-4">
							<!-- <a href="{{route('listOrder')}}" class="btn btn-primary" style="float: right;">Details of Purchase Details</a> -->
							</div>
						</div>
					</div>
					
					<div class="card mb-3">

							<div class="card-body">
								<div class="row">
									
									<form action="{{ url()->current() }}" class="needs-validation" method="POST" autocomplete="off" id="formHostelMaster" novalidate>
										@csrf
										<div class="row mt-3">
										<div class="col-md-6">
											<div class="form-group">
												<label for="order_id">Order No <span class="text-danger">*</span></label>
													<select  id="order_id" class="form-control"  name="order_id"  required>
														<option value="">Select</option>
														@foreach ($list as $type)
														<option {{request()->input('order_id') == $type->orderNo ? 'selected' : ''}} value="{{$type->orderNo}}">{{$type->orderNo}}</option>
														@endforeach
													</select>
													<div class="invalid-feedback">
														Please provide Order No.
													</div>
													@if ($errors->has('order_id'))
													<span class="error_mess">{{ $errors->first('order_id') }}</span> @endif
											</div>
										</div>
										<div class="col-md-3">
											<label for="order_id">&nbsp;</label>
											<input id="searchBtn" class="btn btn-primary form-control btn-block" type="submit" value="Search">
										</div>
										<div class="col-md-3">
											<label for="order_id">&nbsp;</label>
											<a href="{{ url()->current() }}" class="btn btn-danger form-control" type="submit">Reset</a>
										</div>
										</div>
									</form>
									<form action="{{ route('po_verify') }}"   enctype="multipart/form-data" id="inventory" method="post" autocomplete="off" >
									@csrf
										@if($data !="")
											<div class="table-responsive mt-5">
												<table  id="dataTable" class="table table-bordred table-hover bg-white datatable" >
													<thead>
														<tr>
															<th>Sr. No.</th>    
															<th>Order No.</th>    
															<th>Item Type</th>    
															<th>Item Category</th>  
															<th>Item Name</th>  
															<th>Quantity</th>  
															<th>Status</th>  
															<th>Select</th>  
														</tr>
													</thead>
													<tbody>
													@foreach($data as $key=>$item)
													<tr>

														<td>{{ $key+1 }}</td>
														<td>{{ $item->orderNo }}</td>
														<td>{{ $item->item_type_id }}</td>
														<td>{{ $item->category }}</td>
														<td>{{ itemName($item->item_type_id,$item->item_id) }}</td>
														<td>{{ $item->quantity_recieved }}</td>
														<td>
															@if($item->po_approved_status == 1)
																<span class="badge bg-success">Verified</span>
															@else
																<span class="badge bg-warning">Pending</span>
															@endif
														</td>
														<td>
														<input type="checkbox" name="purchase_order_id[]" value="{{$item->id}}" id="PurchaseEntry" @if($item->po_approved_status == 1) disabled @endif>
														</td>

													</tr>
													@endforeach
													</tbody>
												</table>
											</div>
											<div class="col-lg-12">
												<div class="submit"><input class="btn btn-warning pull-right" type="submit" value="Verify"></div>                    
											</div>
										@endif
									</form>
								</div>
									
							</div>
						</div>
					



@endsection
