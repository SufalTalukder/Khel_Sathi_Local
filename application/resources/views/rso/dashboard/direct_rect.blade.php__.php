@extends('layouts/admin_layout')
@section('content')

<div class="pagebody removebg-color row">
                    <div class="pageheader">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="mb-0">Dashboard / Online Request For Direct Recruitment of Players as Gazetted Officers</h4>
                            </div>
                            <div class="col-md-2 d-grid">
                                <!--<a class="btn btn-sm btn-dark" href="ApplicationForm.html"><i class="fa fa-plus"></i>&nbsp;&nbsp; Application Form</a>-->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h5>List of Applications</h5>
                                    </div>
                                    <div class="col-md-1">
                                        <a class="btn btn-sm btn-success" href="{{ route('exportExcel',6) }}">
                                            <i class="fa fa-file-excel"></i>
                                        </a>
                                        <a class="btn btn-sm btn-danger" href="{{ route('exportPdf',6) }}">
                                            <i class="fa fa-file-pdf"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                 <div class="table-responsive" style="max-height: 350px;">
                                     <table  id="dataTable" class="table table-bordred table-hover bg-white">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Application No.</th>
                                            <th>Applicant Name</th>
                                            <th>Email ID</th>
                                            <th>Sports Name</th>
                                            <th>Date of Application</th>
                                            <th>Application Status</th>
                                            <th>Query Status</th>
                                            <!-- <th class="text-center">View</th>
                                            <th>Forward to Directorate</th> -->
                                            <th class="text-center">Action</th>
                                            <!-- <th>Amount</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($details as $key=>$list)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>DR{{$list->id}}</td>
                                            <td>{{$list->fullname}}</td>
                                            <td>{{$list->email}}</td>
                                            <td>{{$list->sportName}}</td>
                                            <td>{{date('d-m-Y',strtotime($list->created_at))}}</td>
                                            <td><?php if($list->form_status == 1) { ?>
                                            <span class="btn btn-success">Accepted</span>
                                            <?php } elseif($list->form_status == 3) { ?>
                                            <span class="btn btn-danger">Pending</span>
                                            <?php } elseif($list->form_status == 2) { ?>
                                            <span class="btn btn-danger">Declined</span>
                                            <?php } else { ?>
                                            <span class="btn btn-warning">Pending</span>
                                            <?php } ?></td>
                                           
                                            <?php $abc=marked_status( $list->user_id,6);?>
                                            <td>
                                            @if(isset($abc) && ($list->form_status == 0) && ($abc->is_closed == 0))
                                            @if(($abc->query_status) == 0)
                                            <strong class="btn btn-primary btn-xs btn-block" >Marked</strong>
                                            @else
                                            <strong class="btn btn-primary btn-xs btn-block" >@if($abc->current_status == "User") User @endif Replied</strong>
                                            @endif
                                            @else
                                            <strong class="btn btn-danger btn-xs disabled">Not Marked</strong>
                                            @endif
                                            </td>

                                            <td class="text-center"><a class="btn btn-sm btn-dark" href="{{ asset('assets_admin/direct_rect_view') }}/{{$list->id}}"><i class="fa fa-eye"></i></a>
                                            <!-- <td class="text-center"><a class="btn btn-sm btn-dark" href="javascript://"><i class="fa fa-eye"></i></a></td> -->
                                            <div style="display: inline-block;">
                                            <?php if($list->form_status == 3) { ?>
                                                <strong class="btn btn-danger btn-xs disabled">Not Forwarded</strong>
                                            <?php } elseif($list->form_status == 1) { ?> 
                                                <?php if($list->is_forwarded_by_rso == 1) { ?>
                                                    <strong class="btn btn-success btn-xs disabled btn-block">Forwarded</strong>
                                                <?php } else { ?>     
                                                <a href="#" class="btn btn-primary btn-xs btn-block show_data_id" data-id="{{$list->id}}" data-bs-toggle="modal" data-bs-target="#forwardedbtn1">Forward</a>
                                                <?php } ?>
                                            <?php } elseif($list->form_status == 2) {?>
                                                <strong class="btn btn-danger btn-xs disabled">Not Forwarded</strong>
                                            <?php } else { ?>
                                                <strong class="btn btn-danger btn-xs disabled">Not Forwarded</strong>
                                            <?php } ?>
                                            </div>
                                            </td>

                                            <!-- <td><?php if($list->form_status == 1) { ?>
                                                <?php if($list->amount_release_status == 1) { ?>
                                                <strong class="btn btn-success btn-xs disabled btn-block">Released</strong>
                                            <?php } else { ?>
                                                <a href="#" class="btn btn-info btn-xs btn-block show_released_id" data-id="{{$list->id}}" data-bs-toggle="modal" data-bs-target="#releasebtn1">Release</a></td>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <strong class="btn btn-info btn-xs disabled btn-block">Not Released</strong>
                                            <?php } ?></td> -->
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


<!--Release Button-->
<div class="modal fade" id="releasebtn1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" >Amount to be Released</h5>
                        <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                    </div>
                    <form action="{{route('direct_released_amount')}}" method="post" >
                    @csrf
                    <div class="modal-body">
                        <h3 class="text-center">
                            <div class="form-group mb-3">
                                <label for="amount">Release Amount in Rupees</label>
                                <input type="hidden" class="financial_released" name="id" value="" />
                                <input type="hidden" name="form_type" value="6"> 
                               <input type="number" class="form-control " name="amount_release" id="release">
                            </div>
                        </h3>
                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                        <button type="submit" class="btn btn-info">Yes</button>
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!--Forwarded Button-->
        <div class="modal fade" id="forwardedbtn1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Forward to Directorate</h5>
                        <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                    </div>
                    <div class="modal-body">
                        <h3 class="text-center"></h3>
                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                        <form action="{{route('direct_forward_directorate')}}" method="post" >
                            @csrf
                        <input type="hidden" class="financial_forward" name="id" value="" />
                        <input type="hidden" name="form_type" value="6"> 
                        <input type="submit" class="btn btn-info" value="Yes">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



@push('custom-scripts')
<script type="text/javascript">

</script>
@endpush