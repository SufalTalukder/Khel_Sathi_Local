            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-envelope-o"></i> Details of Raised Indent </h4>
                <button type="button" class="noprint pull-right btn" data-bs-dismiss="modal" aria-label="Close">X</button>

            </div>
            <style>
                .table th, .info td{
                    color: #333 !important
                }
            </style>
        <form action="{{ route('pending_to_process') }}"  class="needs-validation" enctype="multipart/form-data" method="post" autocomplete="off">
            
            <div class="modal-body clearfix">
                <div class="table-responsive">   
                    <table  id="dataTable" class="table table-bordered">
                        <tbody><tr>
                            <th>
                                Indent Raised For
                            </th>
                            <td class="text-center">
                                @if($list[0]->indent_for == 1)
                                Section
                                @else
                                Individual
                                @endif
                            </td>
                            <th>
                                Section
                            </th>
                            <td>{{$list[0]->section}}</td>    
                        </tr>
                        <tr>
                            <th>
                                Indent Number
                            </th>
                            <td>{{$list[0]->indent_no}}</td>  
                            <th>
                                Date of Indent
                            </th>
                            <td>{{dmy($list[0]->indent_date)}}</td>    
                        </tr>
                    </tbody></table>
                    <table id="example2" class="table  datatable table-bordered ">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Item Type</th>
                                <th class="text-center">Item Category</th>
								<th class="text-center">Item Sub Category</th>  
                                <th class="text-center">Item Name</th>
                                <th class="text-center">Quantity Requested</th>
                                <th class="text-center">Item Quantity In Stock</th>
                                <th class="text-center">Approve Item Quantity</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>    
                        <tbody>
                        @foreach($list as $key=>$item)
                            <tr>
                            <input name="id[]" class="form-control ret" value="{{$item->id}}" type="hidden" >
                            <input name="item_type[]" class="form-control ret" value="{{$item->item_type_id}}" type="hidden" >
                                <td>{{ $key+1 }}</td>   
                                <td>
                                    @if($item->item_type_id == 1)
                                    Consumable
                                    @else
                                    Fixed Assets
                                    @endif
                                </td>   
                                <td>{{ $item->category }}</td>
                                <td>{{ $item->subcategory }}</td>
								<td>{{ itemName($item->item_type_id,$item->item_id) }}</td>
                                <?php $item_d=item($item->item_id); 
                                $instock=stock_item($item->item_id,$item->item_type_id);
                                ?>
                                <td>{{ $item->requested_quantity }}</td>
                                <td>{{$instock}}</td> 
                                {{--<td>{{$item_d->quantity_of_items_purchased}}</td> --}}
                                <?php
                                $vv=0;
                                if($item->requested_quantity > $instock){
                                    $vv= $instock;
                                }else{
                                    $vv=$item->requested_quantity;
                                }
                                ?>
                                <td>                                              
                                    <div class="input number">
                                        <input required name="approve_quantity[]" class="form-control" data-apro="77" min="0" max="{{$vv}}" type="number" id="approve_quantity{{$item->id}}" />
                                    </div>
                                </td>   
                                <td>
                                    <input type="radio" required name="approval_status[]{{$item->id}}" id="approval_status1" onclick="app_status(this.value,{{$item->id}})" value="1" class="approval_status" required>
                                    <label for="approval_status1">Approve</label>
                                    
                                    <input type="radio" name="approval_status[]{{$item->id}}" id="approval_status2" value="2" onclick="app_status(this.value,{{$item->id}})" class="approval_status"><label for="approval_status2">Disapprove</label>
                                 </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer clearfix">
                <button id="approveBtn" class="btn btn-primary pull-rigth" type="submit"><i class="fa fa-envelope"></i> Submit </button>&nbsp;&nbsp;
                <!--<button onclick="closemodel();" class="btn btn-danger" type="button"><i class="fa fa-times"></i> Cancel</button>-->
            </div>
        </form>
        <!-- @push( 'custom-scripts' )
	<script>
        function app_status(val,id){
            alert(val);
        }
	</script> 

@endpush -->
