@extends( 'layouts/coaching_camp_auth' )
@section('content')

    <div class="container-fluid pagecontentbody">
        <div class="tab-content">
            <div class="pagebody removebg-color">
                <div class="col-md-12 pageheader pb-2">
                    <div class="row">
                        <div class="col-md-9">
                            <h4 class="mb-0">Dashboard/डैशबोर्ड</h4>
                        </div>
                        {{-- <div class="col-md-3 d-grid">
                            <a class="btn btn-danger btn-sm  rounded-pill" href="ApplicationForm.html"><i class="fa fa-plus"></i>&nbsp; Application Form/आवेदन फार्म</a>
                        </div> --}}
                    </div>
                </div>

                <div class="card">

                    <div class="card-body">
                        <table class="table table-bordred table-hover bg-white">
                            <thead>
                                <tr class="ellipsis">
                                    <th class="ellipsis">S.No./क्र.सं.</th>
                                    <th class="ellipsis">Application No./आवेदन संख्या</th>
                                    <th class="ellipsis">Name / नाम</th>
                                    <th class="ellipsis">Date of Birth / जन्मतिथि</th>
                                    <th class="ellipsis">Sports Name / खेल का नाम</th>
                                    <th class="text-center" style="width:10%;">मोबाइल नंबर/Mobile Number</th>
                                    <th class="text-center" style="width:10%;">Status/स्टेटस</th>

                                


                                    <th class="text-center" style="width:10%;">Action/कार्रवाई</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>{{ ($applicationview->application_no) }}</td>
                                    <td>{{ Auth::guard('CoachingCamp')->user()->name }}</td>
  <td>{{ Auth::guard('CoachingCamp')->user()->dob ? dmy(Auth::guard('CoachingCamp')->user()->dob) : '' }}</td>
                                           
                                @php
                                                                            $sportIds = explode(',', optional($applicationview)->sport ?? '');
                                                                            $sportNames = array_map(function($id) {
                                                                            return sport_name($id);
                                                                            }, $sportIds);
                                                                            
                                                                            @endphp

                                                       <td align="center">{{implode(', ', $sportNames)}}</td>
                               
                                    <td align="center">{{ Auth::guard('CoachingCamp')->user()->mobile }}</td>
                                 
                                    <td class="text-center">
                                        
                                        @if ($applicationview->final_submit == 1 && $applicationview->status === 0)
                                            <span class="badge bg-danger rounded-pill">Application Rejected</span>
                                        @elseif ($applicationview->final_submit == 1 && $applicationview->status == 1)
                                            <span class="badge bg-success rounded-pill">Application Accepted</span> <br>
                                            @if ($applicationview->payment_status_coaching_fee == 1)
                                  
                                                  <span class="badge bg-primary rounded-pill">Success (Registration Fees)</span>
                                            @else
                                                         <a href="{{route('coaching_camp_application_coaching_fee')}}" class="btn btn-primary btn-sm">Pay {{$applicationview->payment_amount_coaching}} INR (Coaching Fees)</a>
                                      
                                            @endif
                                
                                             @elseif ($applicationview->final_submit == 1 && $applicationview->payment_status == null)
                                            <span class="badge bg-warning rounded-pill">Payment Pending (Registration Fees)</span>
                                   
                                        @elseif ($applicationview->final_submit == 1 && $applicationview->payment_status == 1)
                                            <span class="badge bg-success rounded-pill">Registration Payment Done</span>
                                        @else
                                              <span class="badge bg-success rounded-pill">Application Submitted </span>
                                        @endif
                                        
                                      </td> 
                                   
                                   
                                   
                                   
                                    <td align="center" class="text-center"><a @if ($applicationview->final_submit == 1)
                                        href="{{ route('coaching_camp_application_preview') }}"
                                    @else
                                    href="{{ route('coaching_camp_application_form') }}"
                                    @endif  class="btn btn-sm btn-light" >
                                            <i class="far fa-eye"></i>
                                        </a></td>
                                </tr>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="Puprose" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Puprose</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">data</p>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="paymentnote" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payment Note</h5>
                    <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Registration Fees - <span class="text-success"><i class="fa fa-rupee-sign"></i>5500.00</span></h3>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn btn-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                    <button type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal">Proceed To Pay</button>
                </div>
            </div>
        </div>
    </div>
@endsection
<!-- InstanceEndEditable -->
