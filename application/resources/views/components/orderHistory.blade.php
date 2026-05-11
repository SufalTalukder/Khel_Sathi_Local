        <div class="modal-header" style="overflow: hidden;height: auto" >
            <h4 class="modal-title pull-left"><i class="fa fa-envelope-o"></i> Details of Purchase Order </h4>
            <!-- <button onclick="closemodel();" class="pull-right btn" type="button">X</button> -->
            <button type="button" data-print="modal" class="noprint btn btn-sm  btn-outline-primary ms-2 float-end "   onclick="PrintDoc()"><span class="icons icon-printer"></span></button>
            <button type="button" class="noprint pull-right btn" data-bs-dismiss="modal" aria-label="Close">X</button>
            
            </div>
            <style>
                .table th, .info td{
                    color: #333 !important
                }
            </style>
            <div class="modal-body clearfix" style="overflow: auto;height: 450px;">

                <div class="table-responsive" id="export">   
                    <div class="clearfix"></div>
                    <div class="col-lg-12  bg-warning">
                    <p style="height: 40px;font-size: 26px;background: #91124f;color: white;">Order Details</p>
                    </div>
                    <table  id="dataTable" class="table table-bordered">
                        <tr>
                            <th>Vendor Name</th>
                            <td>{{$list[0]->vendor}}</td> 
                            <th>Order No.</th>
                            <td>{{$list[0]->orderNo}}</td>   
                        </tr>
                        <tr>
                            <th>Order Date</th>
                            <td>{{dmy($list[0]->order_date)}}</td>   
                            <th>Status</th>
                            <td>
                                @if($list[0]->order_status == 1)
                                    Order Created
                                @else
                                    PO Generated
                                @endif
                            </td>
                               
                        </tr>
                    </table>
                    <table id="example2" class="table datatable table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Asset Type</th>
                                <th class="text-center">Item Category</th>
                                <th class="text-center">Item Sub Category</th>
                                <th class="text-center">Item Name</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Rate Per Item</th>
                                <th class="text-center">Amount (in Rs.)</th>
                            </tr>
                        </thead>    
                        <tbody>
                            @foreach($list as $key=>$item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>@if($item->item_type_id == 1)
                                    Consumable
                                    @else
                                    Fixed-Assets
                                    @endif
                                </td>   
                                <td>{{$item->category}}</td>   
                                <td>{{$item->subcategory}}</td>   
                                <td>{{itemName($item->item_type_id,$item->item_id)}}</td>   
                                <td>{{$item->quantity}}</td>   
                                <td>{{$item->rate_per_item}}</td>   
                                <td>{{$item->total_amount}}</td>   
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="clearfix">
                        <div id="printDateTime" style=" float: right; padding: 25px; "></div>
                    </div>
                </div>
            </div>
        </div>
            <!-- /.modal-content -->
