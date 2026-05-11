@extends( 'layouts/admin_layout' )
@section( 'content' )
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-10">
									<h5> Return Indents</h5>
								</div>
							</div>
						</div>
						<div class="card-body">

							<div class="mb-4">
								<form action="{{ url()->current() }}" class="needs-validation" method="POST" autocomplete="off" id="formHostelMaster" novalidate>
									@csrf
									<div class="row">
										<div class="col-md-6">
											<div id="list1" class="dropdown-check-list form-group">
												<label for="month">Indent Number</label>
												<input type="text" name="indent_no" value="{{request()->input('indent_no')}}" class="form-control">
											</div>
										</div>
										<div class="col-md-3 d-grid">
											<label class="form-label">&nbsp;</label>
											<button class="btn btn-primary form-group" type="submit">Search</button>
										</div>
										<div class="col-md-3 d-grid">
											<label class="form-label">&nbsp;</label>
											<a href="{{ url()->current() }}" class="btn btn-primary form-group" type="submit">Reset</a>
										</div>
									</div>
								</form>
							</div>

							<form action="{{ route('save_indent_return') }}"   enctype="multipart/form-data" method="post" autocomplete="off" >
							@csrf
								<div class="col-lg-12" id="issued_btn">
									<div class="row">
										<div class="col-lg-4">
											<label>Date<span class="text-danger">*</span></label>
											<div class="input text"><input required name="date_of_issuance" class="form-control" type="date" max="<?php echo date('Y-m-d'); ?>" id="issue_date"></div>
										</div>
										<div class="col-lg-2">
											<label>&nbsp; </label>
											<div><input class="btn btn-success form-group col-sm-12" id="issuebtn" name="submit" type="submit" value="Return"></div>
										</div>
									</div>
								</div>
								<div class="table-responsive">
									<table  id="dataTable" class="table table-bordred table-hover bg-white datatable" >
										<thead>
											<tr>
												<th width="6%">S.No.</th>
												<th width="20%">Indent Number</th>
												<th width="20%">Indent Raised For</th>
												<th width="20%">Issuing Authority</th>
												<th width="20%">Item Category</th>
												<th width="20%">Item Name</th>
												<th width="20%">Issued Item Quantity</th>
												<th width="20%">Returned Item Quantity</th>
												<th width="20%">Return Item Quantity</th>
												<th width="10%">Added By</th>
												<th width="20%">Remark</th>
												<th width="20%">Select <br></th>
											</tr>
										</thead>
										<tbody>
										 @foreach($list as $key=>$item)
											<tr>

												<td>{{ $key+1 }}</td>
												<td>{{ $item->indent_no }}</td>
												<td>@if($item->indent_for == 1)
													Section
													@else
													Individual
													@endif
												</td>
												<td>{{ rsoName($item->added_by) }}</td>
												<td>{{ $item->category }}</td>
												<td>{{ itemName($item->item_type_id,$item->item_id) }}</td>
												<td>{{ $item->issued_quantity }}</td>
												<td>{{ $item->return_quantity }}</td>
												<td>{{ rsoName($item->added_by) }}</td>
												<td><input   name="data[PurchaseIndentIssue][{{$key}}][return_quantity]" value="0" min="0" max="{{($item->issued_quantity - $item->return_quantity)}}" class="form-control issueq" type="number" id="PurchaseEntryRecevied"></td>
												<td><input   name="data[PurchaseIndentIssue][{{$key}}][remark]"  class="form-control" type="text" ></td>
												<td class="text-center">
													<input type="hidden" name="data[PurchaseIndentIssue][{{$key}}][intent_no]" value="{{$item->indent_no}}" />
													<input type="checkbox" class="che" name="data[PurchaseIndentIssue][{{$key}}][indent_id]" value="{{$item->id}}">
												</td>
												
											</tr>
											@endforeach 
										</tbody>
									</table>
								</div>
							</form>
				
						</div>
					</div>
				</div>

				

			</div>
@endsection
<!-- modal for stock alert -->

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
		<script type="text/javascript">
			$('#issued_btn').hide(); 
		// $(document).on('click', '.cheall', function () {
        //             if ($(this).is(':checked'))
        //             {
        //                 $('.che').each(function () {
        //                     $(this).prop('checked', true);
        //                 });
        //             } else {
        //                 $('.che').each(function () {
        //                     $(this).removeProp('checked');
		// 					$(this).prop('checked', false);
        //                 });
        //             }
        //         });

				$(document).on('click', '.che', function () {                      
					var numberOfChecked = $('input:checkbox.che:checked').length;
					if (numberOfChecked == 0) {
					$('#issued_btn').hide();                  
					} else {
						$('#issued_btn').show();
					}
				})

				 //issue button 
				 $('#issuebtn').click(function () {                        
                        var numberOfChecked = $('input:checkbox.che:checked').length;
                        
                        var flag = 0; 
                      
                       if (numberOfChecked == 0) {
                            error("Please checked at least one Indent.");
                            flag++;     
							return false;                       
                        } else {
                            var k = 1;
                            $(".che").each(function(){
                                if($(this).is(':checked')) {                               
                                    var issueQua = $(this).parent().prev().find(".issueq").val();
                                    if(issueQua == 0 || issueQua == ""){
                                        k++;
                                    }                                    
                                }
                            });
                            if(k > 1){
                                error("Return Quantity should be more than 0 !");
                                flag++; 
								return false;
                            }
                        }
                        // if ($('#remark').val() == "") {
                        //     error("Please Enter Remark.");
						// 	 return false;
                        //     flag++;
                        //     $('#remark').addClass("errorMsg");
						// 	return false;
                        // } else {
                        //     $('#remark').removeClass("errorMsg");
                        // }
                        if ($('#issue_date').val() == "") {
                            error("Please Select Date.");
                            flag++;
                            $('#issue_date').addClass("errorMsg");
							return false;
                        } else {
                            $('#issue_date').removeClass("errorMsg");
                        }
                        if (flag == 0) {
                            return true;
                        } else {
                            return false;
                        }
                    });
	</script> 

@endpush
