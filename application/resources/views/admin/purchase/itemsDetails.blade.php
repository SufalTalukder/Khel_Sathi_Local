        <div class="modal-header" style="overflow: hidden;height: auto" >
            <h4 class="modal-title pull-left"><i class="fa fa-envelope-o"></i> Details of Received Item</h4>
            <!-- <button onclick="closemodel();" class="pull-right btn" type="button">X</button> -->
            <!-- <button type="button" data-print="modal" class="noprint btn btn-sm  btn-outline-primary ms-2 float-end "   onclick="PrintDoc()"><span class="icons icon-printer"></span></button> -->
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
                    <p style="height: 40px;font-size: 26px;background: #91124f;color: white;">Item @if($type==1)Received @elseif($type==2)Returned @endif  Details</p>
                    </div>
                    <table  id="dataTable" class="table table-bordered">
                        <tr>
                            <th>Order No.</th>
                            <td>@if(isset($list) && count($list) != 0)
                                    {{$list[0]->orderNo}}
                                @endif
                            </td> 
                            <th>Vendor Name</th>
                            <td>@if(isset($list) && count($list) != 0)
                                 {{$list[0]->vendor}}
                                @endif
                            </td> 
                        </tr>
                            <tr>
                            <th>Item Name</th>
                            <td>@if(isset($list) && count($list) != 0)
                                
                                 {{itemName($list[0]->item_type_id,$list[0]->item_id)}} 
                                 @endif
                            </td> 
                            <th>Item Type</th>
                            <td>
                                @if((isset($list) && count($list) != 0))
                                @if((isset($list) && count($list) != 0 && $list[0]->item_type_id == 1))
                                    Consumable
                                    @else
                                    Fixed-Assets
                                @endif
                                @endif
                            </td>   
                        </tr>
                    </table>
                    <table id="example2" class="table datatable table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Quantity @if($type==1)Recieved  @elseif($type==2) Returned @endif</th>
                                <th class="text-center">Challan No.</th>
                                <th class="text-center">Challan Date</th>
                                <th class="text-center">Received By</th>
                                <th class="text-center">Received  Date</th>
                            </tr>
                        </thead>    
                        <tbody>
                            @php $total=0; @endphp;
                            @foreach($list as $key=>$item)
                            @php  
                                if($type==1)
                                    $total += $item->quantity_recieved ;
                               elseif($type==2)
                                    $total += $item->quantity_return ;
                               
                            @endphp
                            <tr>
                                <td>{{$key + 1}}</td>
                                @if($type==1)
                                <td>{{$item->quantity_recieved}}</td>
                                @elseif($type==2) 
                                <td>{{$item->quantity_return}}</td>
                                @endif 
                                <td>{{$item->challan_no}}</td>   

                                @if($type==1)
                                <td>{{dmy($item->challan_date)}}</td>
                                @elseif($type==2) 
                                <td>{{dmy($item->return_date)}}</td>
                                @endif  
                                <td>{{rsoName($item->added_by)}}</td>
                                <td>{{dmy($item->created_at)}}</td>

                            </tr>
                            @endforeach
                            <tr>
                            
                            </tr>
                        </tbody>
                    </table>
                    <p style="height: 40px;font-size: 26px;background: #f0ca3d;color: white;width: 50%;float: right;">Total @if($type==1)Recieved  @elseif($type==2)Returned @endif Item : {{$total}}</p>
                    <div class="clearfix">
                        <div id="printDateTime" style=" float: right; padding: 25px; "></div>
                    </div>
                </div>
            </div>
        </div>
            <!-- /.modal-content -->
