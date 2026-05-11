@extends('layouts/financelayout')
@section('content')

<div class="tab-content">
    <div class="pagebody removebg-color">
        <div class="pageheader">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="mb-0">Dashboard/डैशबोर्ड</h4>
                </div>
                @if((count($financial_assistance) == 0) && (count($monthly_pension) == 0))
                <div class="col-md-2 text-end">
                    <a class="btn btn-sm btn-dark" href="{{ route('facp') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp; Complete Your Profile</a>
                </div>
                @elseif((count($financial_assistance) != 0) && (count($monthly_pension) != 0))
                <div class="col-md-2 text-end">
                    <!-- <a class="btn btn-sm btn-dark" href="{{ url('financial-assistance/applyFor') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp; Apply For More</a> -->
                </div>
                @else
                <?php
                // dd($finalsubmit->final_submit);
                if (isset($finalsubmit->user_id)) { ?>
                <?php  } elseif (isset($finan->user_id)) {
                } else { ?>
                    <div class="col-md-2 text-end">
                        <a class="btn btn-sm btn-dark" href="{{ url('financial-assistance/applyFor') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp; Apply For More </a>
                    </div>
                <?php } ?>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-11">
                        <h5>Details of Submitted Application(s)/दर्ज आवेदनों का विवरण</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordred table-hover bg-white">
                        <thead>
                            <tr>
                                <th>S.No.<br>क्रम संख्या</th>
                                <th>Applied For<br>किस संदर्भ में आवेदन किया</th>
                                <th>Application No.<br>आवेदन संख्या</th>
                                <th>Applicant Name<br>आवेदक का नाम</th>
                                <th>Email ID<br>ईमेल आईडी</th>
                                <th>Mobile No.<br>मोबाइल नंबर</th>
                                <th>Date of Application<br>आवेदन की तिथि</th>
                                <th>Application Status<br>आवेदन की स्थिति</th>
                                <!-- <th>Final Status<br>अंतिम स्थिति</th> -->
                                <th>Amount<br>धनराशि</th>
                                <th style="width: 10%;">Query Status<br>संशय/आपत्ति</th>
                                <th class="text-center">View<br>देखें</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($financial_assistance) != 0)
                            @foreach($financial_assistance as $key=>$item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>FINANCIAL ASSISTANCE / वित्तीय सहायता</td>
                                <td>{{ $item->application_no }}</td>
                                <td>{{ $item->fullname }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->mobile }}</td>
                                <td>{{ dmy($item->created_at) }}</td>
                                {{--<td>{{ dmy($item->updated_at) }}</td>--}}
                                <!-- <td>@if(($item->final_submit)== 1) <strong class="btn btn-success btn-xs btn-block btn-block">Completed</strong> @else  <strong class="btn btn-primary btn-xs btn-block btn-block">Pending</strong> @endif</td> -->
                                <td><?php if ($item->form_status == 1) { ?>
                                        <span class="btn btn-success">Accepted</span>
                                    <?php } elseif ($item->form_status == 3) { ?>
                                        <span class="btn btn-warning">Pending</span>
                                    <?php } elseif ($item->form_status == 2) { ?>
                                        <span class="btn btn-danger">Declined</span>
                                    <?php } else { ?>
                                        <span class="btn btn-warning">Pending</span>
                                    <?php } ?>
                                </td>

                                <td><?php if ($item->form_status == 1) { ?>
                                            <?php if ($item->amount_release_status == 1) { ?>
                                            <b>Credited<br>भुगतान हो गया</b>
                                            <?php } else { ?>
                                            <b>Amount Not Credited<br>भुगतान नहीं हुआ</b>
                                            <?php } ?>
                                            <?php } else { ?>
                                            <b>Amount Not Credited<br>भुगतान नहीं हुआ</b>
                                            <?php } ?></td>

                                <?php $abc = marked_status((Auth::user()->id), 4);  ?>

                                <td>
                                    @if(isset($abc) && ($item->form_status == 0) && ($abc->is_closed == 0))
                                    @if(($abc->query_status) == 0)
                                    <strong class="btn btn-primary btn-xs btn-block">Marked<br>दर्ज की गई</strong>
                                    @else
                                    <strong class="btn btn-primary btn-xs btn-block">@if($abc->current_status == "RSO") RSO @endif Replied<br>प्रत्युत्तर भेजा गया</strong>
                                    @endif
                                    @elseif(isset($abc) && ($abc->is_closed == 1))
                                    <strong class="btn btn-danger btn-xs disabled">Closed</strong>
                                    @else

                                    <strong class="btn btn-danger btn-xs disabled">Not Marked<br>नहीं दर्ज की गई</strong>
                                    @endif
                                </td>

                                {{-- <td><?php if ($item->form_status == 3) { ?>
                                                <strong class="btn btn-primary btn-xs  btn-block" data-bs-toggle="modal" data-bs-target="#markedquery6">Marked</strong>
                                            <?php } elseif ($item->form_status == 1) { ?>
                                                <strong class="btn btn-danger btn-xs disabled">Not Marked</strong>
                                            <?php } elseif ($item->form_status == 2) { ?>
                                                <strong class="btn btn-danger btn-xs disabled">Not Marked</strong>
                                            <?php } else { ?>
                                                <strong class="btn btn-warning btn-xs disabled btn-block">Not Marked</strong>
                                            <?php } ?></td> --}}

                                <!-- <td>
                                    <strong class="btn btn-primary btn-xs btn-block btn-block">Pending</strong>
                                </td> -->
                                <td class="text-center">
                                    <a href="{{ route('financialformpreview')}}/{{$item->application_no}}" class="btn btn-primary btn-xs btn-block">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            @if(count($monthly_pension) != 0)
                            @foreach($monthly_pension as $key=>$item)
                            <!--Marked PopUp-->
                            <div class="modal fade" id="markedquery7" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Query</h5>
                                            <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                                        </div>
                                        <div class="modal-body">
                                            <h3 class="text-center"></h3>
                                        </div>
                                        <div class="modal-footer">
                                            <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                                            <button type="button" class="btn btn-info" data-bs-dismiss="modal">Yes</button>
                                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <tr>
                                <td>@if(count($financial_assistance) == 0){{ $key+1 }} @else {{ $key+2 }} @endif</td>
                                <td>MONTHLY PENSION / मासिक पेंशन</td>
                                <td>{{ $item->application_no }}</td>
                                <td>{{ $item->fullname }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->mobile }}</td>
                                <td>{{ dmy($item->created_at) }}</td>
                                {{--<td>{{ dmy($item->updated_at) }}</td>--}}
                                <!-- <td>@if(($item->final_submit)== 1) <strong class="btn btn-success btn-xs btn-block btn-block">Completed</strong> @else  <strong class="btn btn-primary btn-xs btn-block btn-block">Pending</strong> @endif</td> -->
                                <td><?php if ($item->form_status == 1) { ?>
                                        <span class="btn btn-success">Accepted</span>
                                    <?php } elseif ($item->form_status == 3) { ?>
                                        <span class="btn btn-warning">Pending</span>
                                    <?php } elseif ($item->form_status == 2) { ?>
                                        <span class="btn btn-danger">Declined</span>
                                    <?php } else { ?>
                                        <span class="btn btn-warning">Pending</span>
                                    <?php } ?>
                                </td>

                                <td><?php if ($item->form_status == 1) { ?>
                                            <?php if ($item->amount_release_status == 1) { ?>
                                            <b>Credited<br>भुगतान हो गया</b>
                                            <?php } else { ?>
                                            <b>Amount Not Credited<br>भुगतान नहीं हुआ</b>
                                            <?php } ?>
                                            <?php } else { ?>
                                            <b>Amount Not Credited<br>भुगतान नहीं हुआ</b>
                                            <?php } ?></td>
                                <?php $abc = marked_status((Auth::user()->id), 5); ?>
                                <td>
                                    @if(isset($abc) && ($item->form_status == 0) && ($abc->is_closed == 0))
                                    @if(($abc->query_status) == 0)
                                    <strong class="btn btn-primary btn-xs btn-block">Marked<br>दर्ज की गई</strong>
                                    @else
                                    <strong class="btn btn-primary btn-xs btn-block">@if($abc->current_status == "RSO") RSO @endif Replied<br>प्रत्युत्तर भेजा गया</strong>
                                    @endif
                                    @elseif(isset($abc) && ($abc->is_closed == 1))
                                    <strong class="btn btn-danger btn-xs disabled">Closed</strong>
                                    @else
                                    <strong class="btn btn-danger btn-xs disabled">Not Marked<br>नहीं दर्ज की गई</strong>
                                    @endif
                                </td>
                                {{-- <td><?php if ($item->form_status == 3) { ?>
                                                <strong class="btn btn-primary btn-xs btn-block"  data-bs-toggle="modal" data-bs-target="#markedquery7">Marked</strong>
                                            <?php } elseif ($item->form_status == 1) { ?>
                                                <strong class="btn btn-danger btn-xs disabled">Not Marked</strong>
                                            <?php } elseif ($item->form_status == 2) { ?>
                                                <strong class="btn btn-danger btn-xs disabled">Not Marked</strong>
                                            <?php } else { ?>
                                                <strong class="btn btn-warning btn-xs disabled btn-block">Not Marked</strong>
                                            <?php } ?></td> --}}

                                <!-- <td>
                                    <strong class="btn btn-primary btn-xs btn-block btn-block">Pending</strong>
                                </td> -->
                                <td class="text-center">
                                    <a href="{{ route('monthlypensionformpreview')}}/{{$item->application_no}}" class="btn btn-primary btn-xs btn-block">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- <div class="modal fade" id="markedquery6" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Query</h5>
                                            <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                                        </div>
                                        <form action="{{route('financial_mark_query')}}" method="post" enctype="multipart/form-data" class="needs-validation mt-4" novalidate="">
@csrf
<div class="modal-body">
    <h5 class="text-center">{{ $financial_assistance[0]->is_mark_query }}</h5>
    <!-- {{$financial_assistance[0]->query_doc}} -->
    @if($financial_assistance[0]->query_doc )
    <a download href="{{url('storage/rso_query',$financial_assistance[0]->query_doc)}}" target="_blank">
        <span class="btn btn-success  btn-xs">Download</span>
    </a>
    @endif

    <div class="form-group">
        <input type="hidden" name="user_id" value="{{$financial_assistance[0]->applicant_id}}">
        <textarea name="is_mark_query" id="is_mark_query" cols="95" rows="5"></textarea>
        <label>Upload Relevant Documents Justifying the Experience</label>
        <div class="input-group">
            <input type="file" name="query_doc" class="form-control" onchange="getfileext(this.value,10)" id="File10" aria-describedby="inputGroupFileAddon05" aria-label="Upload">

            <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
        </div>
        <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
    </div>

    <div class="modal-footer">
        <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
        <button type="button" class="btn btn-info" data-bs-dismiss="modal">Back</button>
        <button type="submit" class="btn btn-success">Submit Your Query</button>
    </div>
</div>
</form>
</div>
</div>
</div> --}}
