@extends('layouts/layout')
@section('content')

        <div class="pageheader">
            <div class="row">
                <div class="col-md-8">
                    <h4 class="mb-0">Dashboard/डैशबोर्ड</h4> 
                </div>
                @if((count($laxman) == 0) && (count($ranilaxmibai) == 0) && (count($position_holder) == 0) && $chkk == 0 )
                    <div class="col-md-4 text-end">
                    <a class="btn btn-sm btn-dark" href="{{ route('cp') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp; Create Profile/प्रोफाइल सृजित करें </a>
                </div>
                 @elseif((count($laxman) == 0) && (count($ranilaxmibai) == 0) && (count($position_holder) == 0))
                 <div class="col-md-4 text-end">
                    <a class="btn btn-sm btn-dark" href="{{ route('applyFor') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp; Apply for Nomination/नामांकन हेतु आवेदन करें</a>
                 </div>                 
                 {{-- @elseif($apply_check == 1) --}}                
                 @else                
                <div class="col-md-4 text-end">
                    <a class="btn btn-sm btn-dark" href="{{ route('applyFor') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp; Apply For More Award</a>
                </div>
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
                    <table  id="dataTable" class="table table-bordred table-hover bg-white">
                            
                    <thead>
                            <tr>
                                <th>S.No.<br>क्रम संख्या</th>
                                <th>Applied For<br>किस संदर्भ में आवेदन किया</th>
                                <th>Application No.<br>आवेदन संख्या</th>
                                <th>Applicant’s Name<br>आवेदक का नाम</th>
                                <th>Email ID<br>ईमेल आईडी</th>
                                <th>Mobile No.<br>मोबाइल नंबर</th>
                                <th>Date of Application<br>आवेदन की तिथि</th>
                                <th>Application Status<br>आवेदन की स्थिति</th>
                                <!-- <th>Final Status<br>अंतिम स्थिति</th> -->
                                <th>Amount<br>धनराशि</th>
                                <th>Query Status<br>संशय/आपत्ति</th>
                                <th class="text-center">View<br>देखें</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- for laxman -->

                            @foreach($laxman as $key=>$item)

                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>Laxman Award</td>
                                <td>{{ $item->application_no }}</td> 
                                <td>{{ $item->fullname }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->mobile }}</td>
                                <td>{{ dmy($item->created_at) }}</td>
                                {{--<td>{{ dmy($item->updated_at) }}</td>--}}
                                <!-- <td>@if(($item->final_submit)== 1) <strong class="btn btn-success btn-xs btn-block btn-block">Completed</strong> @else  <strong class="btn btn-primary btn-xs btn-block btn-block">Pending</strong> @endif</td> -->
                                <td><?php if($item->form_status == 1) { ?>
                                            <span class="btn btn-success">Accepted</span>
                                            <?php } elseif($item->form_status == 3) { ?>
                                            <span class="btn btn-warning">Pending </span>
                                            <?php } elseif($item->form_status == 2) { ?>
                                            <span class="btn btn-danger">Declined</span>
                                            <?php } else { ?>
                                            <span class="btn btn-warning">Pending</span>
                                            <!-- <span class="btn btn-warning">Pending for Final Submission/अंतिम रूप से दर्ज करने हेतु लंबित</span> -->
                                            <?php } ?></td>

                                            <td><?php if($item->form_status == 1) { ?>
                                            <?php if($item->amount_release_status == 1) { ?>
                                            <b>Credited<br>भुगतान हो गया</b>
                                            <?php }else{ ?>
                                            <b>Amount Not Credited<br>भुगतान नहीं हुआ</b>
                                            <?php } ?>
                                            <?php } else { ?>
                                            <b>Amount Not Credited<br>भुगतान नहीं हुआ</b>
                                            <?php } ?></td>

                                            <?php $abc=marked_status(($item->application_no),1);?>
                                            <td>
                                            @if(isset($abc) && ($item->form_status == 0) && ($abc->is_closed == 0))
                                            @if(($abc->query_status) == 0)
                                            <strong class="btn btn-primary btn-xs btn-block" >Marked<br>दर्ज की गई</strong>
                                            @else
                                            <strong class="btn btn-primary btn-xs btn-block" >@if($abc->current_status == "RSO") RSO @endif Replied<br>प्रत्युत्तर भेजा गया</strong>
                                            @endif
                                            @elseif(isset($abc) && ($abc->is_closed == 1))
                                            <strong class="btn btn-danger btn-xs disabled">Closed</strong>
                                            @else
                                            <strong class="btn btn-danger btn-xs disabled">Not Marked<br>नहीं दर्ज की गई</strong>
                                            @endif
                                            </td>

                                {{-- <td><?php if($item->form_status == 3) { ?>
                                                <strong class="btn btn-primary btn-xs  btn-block" data-bs-toggle="modal" data-bs-target="#markedquery6">Marked/दर्ज की गई</strong>
                                            <?php } elseif($item->form_status == 1) { ?>
                                                <strong class="btn btn-danger btn-xs disabled">Not Marked<br>नहीं दर्ज की गई</strong>
                                            <?php } elseif($item->form_status == 2) { ?>
                                                <strong class="btn btn-danger btn-xs disabled">Not Marked<br>नहीं दर्ज की गई</strong>
                                            <?php } else { ?>
                                                <strong class="btn btn-warning btn-xs disabled btn-block">Not Marked<br>नहीं दर्ज की गई</strong>
                                            <?php } ?></td> --}}
                                <!-- <td><strong class="btn btn-danger btn-xs disabled">Not Marked</strong></td> -->
                                
                                
                                <!-- <td>
                                    <strong class="btn btn-primary btn-xs btn-block btn-block">Pending</strong>
                                </td> -->
                                <td class="text-center">
                                    <a href="{{ route('laxmandetailForm' )}}/{{$item->application_no}}" class="btn btn-primary btn-xs btn-block">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            @endforeach
                            <!-- for ranilaxmibai -->
                            @foreach($ranilaxmibai as $key=>$item)

                                <tr>
                                    <td>@if(count($laxman) == 0){{ $key+1 }} @else {{ $key+2 }} @endif</td>
                                    <td>Rani Laxmi Bai Award</td>
                                    <td>{{ $item->application_no }}</td> 
                                    <td>{{ $item->fullname }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ dmy($item->created_at) }}</td>
                                    {{--<td>{{ dmy($item->updated_at) }}</td>--}}
                                    <!-- <td>@if(($item->final_submit)== 1) <strong class="btn btn-success btn-xs btn-block btn-block">Completed</strong> @else  <strong class="btn btn-primary btn-xs btn-block btn-block">Pending</strong> @endif</td> -->
                                    <td><?php if($item->form_status == 1) { ?>
                                            <span class="btn btn-success">Accepted</span>
                                            <?php } elseif($item->form_status == 3) { ?>
                                            <span class="btn btn-warning">Pending</span>
                                            <?php } elseif($item->form_status == 2) { ?>
                                            <span class="btn btn-danger">Declined</span>
                                            <?php } else { ?>
                                            <span class="btn btn-warning">Pending</span>
                                            <?php } ?></td>

                                            <td><?php if($item->form_status == 1) { ?>
                                            <?php if($item->amount_release_status == 1) { ?>
                                            <b>Credited<br>भुगतान हो गया</b>
                                            <?php }else{ ?>
                                            <b>Amount Not Credited<br>भुगतान नहीं हुआ</b>
                                            <?php } ?>
                                            <?php } else { ?>
                                            <b>Amount Not Credited<br>भुगतान नहीं हुआ</b>
                                            <?php } ?></td>
                                            <?php $abc=marked_status(($item->application_no),2);?>
                                           {{-- {{marked_status((Auth::user()->id),2)}} --}}
                                            <td>
                                            @if(isset($abc) && ($item->form_status == 0) && ($abc->is_closed == 0))
                                            @if(($abc->query_status) == 0)
                                            <strong class="btn btn-primary btn-xs btn-block" >Marked<br>दर्ज की गई</strong>
                                            @else
                                            <strong class="btn btn-primary btn-xs btn-block" >@if($abc->current_status == "RSO") RSO @endif Replied<br>प्रत्युत्तर भेजा गया</strong>
                                            @endif
                                            @elseif(isset($abc) && ($abc->is_closed == 1))
                                            <strong class="btn btn-danger btn-xs disabled">Closed</strong>
                                            @else
                                            <strong class="btn btn-danger btn-xs disabled">Not Marked<br>नहीं दर्ज की गई</strong>
                                            @endif
                                            </td>
                                    
                                    <!-- <td>
                                        <strong class="btn btn-primary btn-xs btn-block btn-block">Pending</strong>
                                    </td> -->
                                    <td class="text-center">
                                        <a href="{{ route('laxmibaidetailForm')}}/{{$item->application_no}}" class="btn btn-primary btn-xs btn-block">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>

                                @endforeach

                                <!-- for position_holder -->
                                @foreach($position_holder as $key=>$item)

                                    <tr>
                                        <td>@if((count($laxman) == 0)  && (count($ranilaxmibai) == 0))  {{ $key+1 }} @elseif((count($laxman) != 0)  && (count($ranilaxmibai) == 0)) {{$key+2}} @elseif((count($laxman) == 0)  && (count($ranilaxmibai) != 0)) {{$key+2}} @else {{ $key+3 }} @endif</td>
                                        <td>Position Holder</td>
                                        <td>{{ $item->application_no }}</td> 
                                        <td>{{ $item->fullname }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->mobile }}</td>
                                        <td>{{ dmy($item->created_at) }}</td>
                                        {{--<td>{{ dmy($item->updated_at) }}</td>--}}
                                        <!-- <td>@if(($item->final_submit)== 1) <strong class="btn btn-success btn-xs btn-block btn-block">Completed</strong> @else  <strong class="btn btn-primary btn-xs btn-block btn-block">Pending</strong> @endif</td> -->
                                        <td><?php if($item->form_status == 1) { ?>
                                            <span class="btn btn-success">Accepted</span>
                                            <?php } elseif($item->form_status == 3) { ?>
                                            <span class="btn btn-warning">Pending</span>
                                            <?php } elseif($item->form_status == 2) { ?>
                                            <span class="btn btn-danger">Declined</span>
                                            <?php } else { ?>
                                            <span class="btn btn-warning">Pending</span>
                                            <?php } ?></td>

                                            <td><?php if($item->form_status == 1) { ?>
                                            <?php if($item->amount_release_status == 1) { ?>
                                            <b>Credited<br>भुगतान हो गया</b>
                                            <?php }else{ ?>
                                            <b>Amount Not Credited<br>भुगतान नहीं हुआ</b>
                                            <?php } ?>
                                            <?php } else { ?>
                                            <b>Amount Not Credited<br>भुगतान नहीं हुआ</b>
                                            <?php } ?></td>
                                            <?php $abc=marked_status(($item->application_no),3);?>
                                            <td>
                                              
                                            @if(isset($abc) && ($item->form_status == 0) && ($abc->is_closed == 0))
                                            @if(($abc->query_status) == 0)
                                            <strong class="btn btn-primary btn-xs btn-block" >Marked<br>दर्ज की गई</strong>
                                            @else
                                           
                                            <strong class="btn btn-primary btn-xs btn-block" >@if($abc->current_status == "RSO") RSO @endif Replied<br>प्रत्युत्तर भेजा गया</strong>
                                            @endif
                                            @elseif(isset($abc) && ($abc->is_closed == 1))
                                            <strong class="btn btn-danger btn-xs disabled">Closed</strong>
                                            @else
                                            <strong class="btn btn-danger btn-xs disabled">Not Marked<br>नहीं दर्ज की गई</strong>
                                            @endif
                                            </td>
                                        
                                        <!-- <td>
                                            <strong class="btn btn-primary btn-xs btn-block btn-block">Pending</strong>
                                        </td> -->
                                        <td class="text-center">
                                            <a href="{{ url('positiondetailForm')}}/{{$item->application_no}}" class="btn btn-primary btn-xs btn-block">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
 
@endsection
