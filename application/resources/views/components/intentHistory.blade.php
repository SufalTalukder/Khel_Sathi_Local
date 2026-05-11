        <div class="modal-header" style="overflow: hidden;height: auto" >
            <h4 class="modal-title pull-left"><i class="fa fa-envelope-o"></i> Details of Indents Request </h4>
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
                    <p style="height: 40px;font-size: 26px;background: #91124f;color: white;">Indent</p>
                    </div>
                    <table  id="dataTable" class="table table-bordered">
                        <tr>
                            <th>Section</th>
                            <td>{{$list[0]->section}}</td> 
                            <th>Indent No</th>
                            <td>{{$list[0]->indent_no}}</td>   
                        </tr>
                        <tr>
                            <th>Indent Date</th>
                            <td>{{dmy($list[0]->indent_date)}}</td>   
                            <!-- <th>Status</th>
                            <td>
                                @if($list[0]->indent_status == 0)
                                    Pending
                                    @elseif($list[0]->indent_status == 2)
													<span class="btn btn-danger">Disapprove</span>
                                @else
                                    Approved
                                @endif
                            </td> -->
                               
                       
                            <th>Indent Type</th>
                            <td>
                            @if($list[0]->indent_for == 1)
                                Section
                            @else
                                Individual
                            @endif
                            </td>
                        </tr>
                    </table>
                    <table id="example2" class="table datatable table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Item Type</th>
                                <th class="text-center">Item Category</th>
                                <th class="text-center">Item Sub Category</th>
                                <th class="text-center">Item Name</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Action</th>
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
                                <td>{{$item->requested_quantity}}</td>  
                                <td class="text-center">
                                    @if($item->indent_status == 0)
                                    <a class="btn btn-sm btn-danger pointer bt"
                                        href="{{ route('deleteIntentById' , $item->id) }}" 
                                        onclick="return confirm('Are you sure you want to delete ?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    @elseif($item->indent_status == 2)
													<span class="btn btn-danger">Disapprove</span>
                                    @else
                                    <span class="btn btn-success">Approved</span>
                                    @endif
                                </td>  
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- <table id="example2" class="table datatable table-bordered ">
                        <thead>
                            <tr>
                                <th class="text-center">Sr.No.</th>
                                <th class="text-center">Issue No</th>
                                <th class="text-center">Item Type</th>
                                <th class="text-center">Item Category</th>
                                <th class="text-center">Item Name</th>
                                <th class="text-center">Issued</th>
                                <th class="text-center">Return</th>
                                <th class="text-center">Date</th>
                            </tr>

                        </thead>    
                        <tbody>
                        </tbody>
                    </table> -->
                    <div class="clearfix">
                        <div id="printDateTime" style=" float: right; padding: 25px; "></div>
                    </div>
                </div>
            </div>
        </div>
            <!-- /.modal-content -->
