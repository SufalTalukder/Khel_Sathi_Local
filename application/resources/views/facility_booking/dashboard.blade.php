@extends('layouts/facility_booking_auth')
@section('content')


<div class="container-fluid pagecontentbody">
    <div class="tab-content">
        <div class="pagebody removebg-color">
            <div class="col-md-12 pageheader pb-2">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="mb-0">Applicant Details</h4>
                    </div>
                    <div class="col-md-2 d-grid"> <a class="btn btn-outline-success" href="{{route('facility_booking_application')}}"><i class="fa fa-plus"></i>&nbsp;Application Form</a> </div>
                </div>
            </div>
            @if (count($application) > 0)


            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordred table-hover bg-white">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Application No.</th>
                                    <th>Service Type</th>
                                    <th>Applicant Name</th>
                                    <th>Email ID</th>
                                    <th class="text-center">Mobile No.</th>
                                    <th class="text-center">Status of Application</th>
                                    <th class="text-center">Payment Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($application as $key=>$item )


                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>@if ($item->application_no)
                                        {{$item->application_no}}
                                        @else
                                        NA
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->service == 1)
                                        Swimming Pool (Mini)
                                        @elseif ($item->service == 2)
                                        Guest Room
                                        @elseif ($item->service == 3)
                                        Swimming Pool (Adult)
                                        @elseif ($item->service == 4)

                                        Gymnasium
                                        @elseif ($item->service == 5)
                                        Stadium
                                        @endif
                                    </td>
                                    <td>{{Auth::guard('facility_booking')->user()->name}}</td>
                                    <td>{{Auth::guard('facility_booking')->user()->email}}</td>
                                    <td class="text-center">{{Auth::guard('facility_booking')->user()->mobile}}</td>
                                    <td class="text-center">
                                        @if ($item->status == 1 && $item->final_submit == 1)

                                        <span class="badge bg-success ">Accepted</span>
                                        <br>{{dmy($item->accept_reject_date)}}
                                        @elseif ($item->status == 2 && $item->final_submit == 1)
                                        <span class="badge bg-danger ">Rejected</span>
                                        <br>{{dmy($item->accept_reject_date)}}
                                        @elseif($item->final_submit == 1 && $item->query_status == 2)
                                        <button type="button" class="btn btn-outline-primary btn-sm"> Re-Submitted</button>
                                        <br>{{dmy($item->final_submit_date)}}
                                        @elseif( $item->final_submit == 1 && $item->query_status == 1)

                                        <button type="button" class="btn btn-outline-warning btn-sm"> Query Marked</button>
                                        <br> {{dmy($item->marked_on)}}

                                        @elseif($item->final_submit == 1)
                                        <span class="badge bg-success ">Submitted</span>
                                        <br>{{dmy($item->final_submit_date)}}
                                        @else
                                        <span class="badge bg-primary ">Pending</span>
                                        @endif
                                    </td>


                                    <td class="text-center">
                                        @if ($item->status == 1 && $item->payment_status == 1)

                                        <span class="badge bg-success ">Success</span> <br>

                                        <a href="{{route('facility_booking_payment_receipt', $item->application_no)}}" class="btn btn-primary btn-xs ">Receipt</a><br>
                                        <br>
                                        {{rajkosh_payment_booking($item->application_no)->Depchallan}} <br>
                                        {{dmy($item->payment_date)}} <br>
                                        <strong> {{$item->amount_to_be_paid}} INR. </strong>

                                        @elseif ($item->status == 1 && $item->payment_status != 1)

                                        @if ($item->fee_exemption_status == 1)
                                        <span class="badge bg-warning">Fee Exemption</span>
                                        @else
                                        <a href="{{route('facility_booking_payment_request', $item->id)}}" class="btn btn-primary btn-xs ">Proceed To Pay</a><br>
                                        <strong> {{$item->amount_to_be_paid}} INR. </strong>
                                        @endif


                                        @else
                                        NA

                                        @endif
                                    </td>
                                    <td class="text-center">

                                        @if($item->final_submit != 1 || ($item->final_submit == 1 && $item->query_status == 1))
                                        <a class="btn btn-outline-primary btn-sm" href="{{route('facility_booking_application_update', $item->id)}}"><i class="fa fa-edit"></i> </a>

                                        @endif


                                        <a class="btn btn-outline-success btn-sm" href="{{route('facility_booking_application_preview', $item->id)}}"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="viewQuery" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Query Details</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Query</th>
                            <th>Query Date</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody id="testt">
                        <tr>
                            <td><b>1</b></td>
                            <td>Upload Related Documents</td>
                            <td>1</td>
                            <td><a class="btn btn-primary btn-sm" href="#" title="View File"><i class="fa fa-eye"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>






</script>

@endsection
