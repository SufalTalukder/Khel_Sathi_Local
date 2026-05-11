@extends( 'layouts\admin_hostel_dashboard' )
@section( 'hostelDashboard' )
	<style>
		.pagebody {
			padding: 0 15px;
			/* min-height: 600px; */
		}


        body {
            font-family: Arial;
            font-size: 10px;
            margin: 0px;
            padding: 0px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .dn {
            display: none;
        }



	</style>
<div class="container-fluid pagecontentbody">

	<div class="tab-content">
		<div class="pagebody removebg-color ">
			<div class="pageheader">
				<h4 class="mb-0">Applicant Details </h4>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
                        <div class="card-body">
						@if($userDetails->payment_status != 2)
						<div class="alert alert-danger" role="alert" style="font-size: small;">
                            <b>Note :</b>	If your Payment has deducted and status is still  <strong> Pending </strong> then click on Update Payment Status button.


                            <a class="btn btn-sm btn-dark float-end" target="_blank" href="https://www.startinup.up.gov.in/demo/PaymentController/payment_update_hostel/{{base64_encode($userDetails->application_no)}}" style="margin-top: -6px;"><i class="fa fa-plus"></i>&nbsp;&nbsp; Update Payment Status</a>
                          </div>
						@endif

							<div class="table-responsive" style="max-height: 350px;">
								<table  id="dataTable" class="table table-bordred table-hover bg-white">
									<thead>
										<tr>
											<th>S.No.</th>
											<th>Application No.</th>
											<th>Applicant Name</th>
											<th>Aadhar Number</th>
											<th>Sports Name</th>

											<th >Query Status</th>
											<th>Application Status</th>
                                            @if ($userDetails->level == 4 || $userDetails->query_status == 1)
                                            <th >Application Fee</th>
                                            @endif
											<th class="text-center">View</th>
                                            @if (isset($userDetails->hostel_allotment_letter))
                                            <th class="text-center">Allotment Letter</th>
                                            <th class="text-center">Allotment Fee</th>
                                            @endif

										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>{{$userDetails->application_no}}</td>
											<td>{{$userDetails->name}}</td>
											<td>{{$userDetails->aadhar}}</td>
											<td>{{sport_name($userDetails->applicationBasicDetasils->sports)}}  </td>


											<td>@if ($userDetails->markquery->count() > 0)
												<strong class="btn btn-danger btn-xs disabled">Query Marked</strong>

											@else
											<strong class="btn btn-primary btn-xs disabled">No Query Marked</strong>
											@endif</td>
											<td align="center">@if ($userDetails->status == 3)<strong class="btn btn-primary btn-xs disabled"> Pending</strong> @elseif ($userDetails->status == 1) <strong class="btn btn-success btn-xs disabled">Provisionally Accepted </strong> @else<strong class="btn btn-danger btn-xs disabled"> Rejected  <br>
                                            </strong> <br><strong>  Reason : </strong>  {{ $userDetails->remark }}@endif </td>

                                            @if ($userDetails->level == 4 || $userDetails->query_status == 1)

                                            @if(($userDetails->payment_status == 1 || $userDetails->payment_status == 2 || $userDetails->payment_status == 3) && ($userDetails->query_status=="" || $userDetails->query_status == 2) )
											<?php if($userDetails->payment_status == 1){ ?>
												<td align="center">
													<a href="javascript:void(0)" onclick="showTrialModal()" class="btn btn-primary btn-xs">Pay</a>
                        						</td>
											<?php } ?>
											<?php if($userDetails->payment_status == 2){ ?>
												<td style="
                                                white-space: nowrap;
                                                overflow: hidden;
                                                text-overflow: ellipsis;
                                            ">
													<a href="javascript:void(0)" class="btn btn-success btn-xs  disabled">Success</a>
											<a target="_blank" href="{{ url("hostel/payment_verify_receipt")}}" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title=""  data-bs-original-title="Download Receipt" aria-label="Download Receipt"><i class="fas fa-download"></i></a>
												</td>
											<?php } ?>
											<?php if($userDetails->payment_status == 3){ ?>
												<td>
													<a href="javascript:void(0)" class="btn btn-danger btn-xs  disabled">Fail</a>
                        						</td>
											<?php } ?>



                                            @else
                                            <td align="center">
                                                <a href="javascript:void(0)" onclick="showTrialModal()" class="btn btn-primary btn-xs">Pay</a>
                                            </td>

                                            @endif
                                            @endif



											<td class="text-center"><a class="btn btn-sm btn-dark" href="{{route('hostel.applicationView')}}"><i class="fa fa-eye"></i></a>
											</td>
                                            @if (isset($userDetails->hostel_allotment_letter))

                                        <td>
                                            <a class="btn btn-sm btn-primary" href="{{ url('public/hostel/allotment_letter') }}/{{ $userDetails->hostel_allotment_letter }}" download
                                            ><i class="fa fa-upload" aria-hidden="true"></i></a>
                                        </td>



                                            <td>
                                                @if ($userDetails->payment_allotment_fee_status == 1)
												<strong class="btn btn-success btn-xs disabled">Success</strong>
                                                <strong class="btn btn-primary btn-xs" onclick="PrintDocc()">  <i class="fa fa-download" aria-hidden="true"></i></strong>
                                                @else
                                            <a href="{{ url('hostel/payment_request_for_allotment') }}" class="btn btn-primary btn-xs ">Proceed To Pay</a>
                                            @endif
											</td>
                                            @endif
										</tr>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>


<!-- Trial Venue Modal -->
<div class="modal fade" id="trialVenueModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="trialVenueModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1a3c6e; color:#fff;">
                <h5 class="modal-title" id="trialVenueModalLabel">
                    <i class="fas fa-info-circle"></i>
                    Trial / चयन परीक्षा की जानकारी
                </h5>
            </div>
            <div class="modal-body">
                @if($trialInfo)
                <div class="alert alert-warning mb-3" role="alert">
                    <strong>Note:</strong> Your trial venue, date and time are fixed based on your permanent district. You cannot change this.
                    <br><strong>नोट:</strong> आपका चयन परीक्षा स्थल, दिनांक एवं समय आपके स्थाई जिले के अनुसार निर्धारित है। इसे बदला नहीं जा सकता।
                </div>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width:35%; background:#f5f5f5;">Trial Venue / चयन स्थल</th>
                            <td>
                                <strong>{{ $trialInfo['venue'] }}</strong><br>
                                <strong>{{ $trialInfo['venue_hi'] }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <th style="background:#f5f5f5;">Trial Date / चयन दिनांक</th>
                            <td>
                                <strong>{{ $trialInfo['date_from'] }} to {{ $trialInfo['date_to'] }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <th style="background:#f5f5f5;">Trial Time / चयन समय</th>
                            <td><strong>{{ $trialInfo['time'] }}</strong></td>
                        </tr>
                    </tbody>
                </table>
                @else
                <div class="alert alert-danger">
                    Trial venue information not available for your district. Please contact the office.
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel / रद्द करें</button>
                @if($trialInfo)
                <a href="{{ route('hostel_payment_request') }}" class="btn btn-primary">
                    Proceed to Pay / भुगतान करें <i class="fas fa-arrow-right"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

     <!-- Modal -->
     <div class="modal" id="exampleModal" >
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Payment Status</h5>
              <button type="button" class="close" onclick="closestatus()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <form action="{{ route('update_payment_status_allotment') }}" method="post"  class="needs-validation"  novalidate enctype="multipart/form-data">
                  @csrf
              <div class="row">


              <div class="col-md-4">
                <div class="form-group mb-3">
Branch
                  <label class="placeholder"> Name </label>
                  <input type="text" class="form-control" name="branch_name" required value="{{$userDetails->branch_name}}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-3">

                  <label class="placeholder">District </label>
                  <select class="form-select" name="payment_district"   required >
                    <option value="">Select District</option>
                    @foreach ($districts as $district)
                    <option value="{{$district->id}}"  @if($userDetails->payment_district == $district->id) selected @endif>{{$district->city}}</option>
                    @endforeach

                </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-3">

                  <label class="placeholder">Paid Amount </label>
                  <input type="number" class="form-control" name="paid_amount" value="{{$userDetails->paid_amount}}" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-3">

                  <label class="placeholder">Payment Date </label>
                  <input type="date" class="form-control" name="payment_date" required value="{{$userDetails->payment_date}}">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group mb-3">
                    <label class="placeholder">Upload Receipt </label>
                    <div class="input-group">
                        <input type="file" class="form-control"name="payment_receipt"{{isset($userDetails->payment_receipt) ? '' : 'required'}}>
                        @isset($userDetails->payment_receipt)   <a href="{{url('public/hostelapplicant/payment_receipt')}}/{{$userDetails->payment_receipt}}" class="btn btn-secondary" id="A3" target="_blank">View</a>																		</div>
                   @endisset

                </div>
              </div>


          </div>


          <div class="col-md-12 mt-4">
        @if ($userDetails->markquery->count() > 0)
            <div class="alert alert-danger" role="alert">
               Note: After updated the payment. Please proceed for Final Submission of the form.

              </div>
              @endif
            <button type="submit" class="btn btn-success mt-2 float-end">Submit</button>
          </div>
          </form>
          <div id="responsestatus">

          </div>


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
				<!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
				<button type="button" class="btn btn-info" data-bs-dismiss="modal">Proceed To Pay</button>
			</div>
		</div>
	</div>
</div>


@php
    $allotment_fee_detail =  rajkosh_payment_clipallotment($userDetails->application_no);


@endphp
<div id="prodiv" class="dn">
    <div id="content" style="position:relative;">
        <table border="0" cellspacing="0" cellpadding="8" width="100%" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th colspan="2">
                        <div style="padding: 0 15px 3px; margin-bottom: 10px; border-bottom: 2px solid #000; position: relative;">
                            <img src="{{ url('admin') }}/images/logo.png"  style="width: 75px; height: auto; position: absolute; top: 0px; left: 20px;">
                            <h1 style="text-align: center; font-size: 20pt; margin: 0px 0px 0px 0px; padding: 0px 0 0; color: #383838; font-weight: bold;">
                                Sports Directorate, Govt. of Uttar Pradesh
                            </h1>
                            <h2 style="text-align: center; margin:0px 0px 0px 0px; font-size:11pt; padding: 0px; color:#383838; font-weight: bold;">
                                Khel Bhawan Hazratganj Lucknow, Uttar Pradesh 226001
                            </h2>
                            <h5 style="text-align: center; margin:10px 0px 0px 0px; font-size:16pt; padding: 0px; color:#383838; font-weight: bold;">
                                Hostel Fee Receipt
                            </h5>
                        </div>
                    </th>
                </tr>
                <tr>



                    <th style="font-size: 10pt; text-align:left">
                        <strong>Application No. : </strong> {{$userDetails->application_no}}
                    </th>
                    <th style="text-align: right; font-size: 10pt;">
                        <strong>Department Code : </strong> EDU
                    </th>

                </tr>
                <tr>

                    <th style="font-size: 10pt; text-align:left">
                        <strong>Name : </strong> {{$userDetails->name}}
                    </th>

                    <th style="font-size: 10pt; text-align:right">
                        <strong>Reference Id  : </strong> @if(isset($allotment_fee_detail) ){{ $allotment_fee_detail->ref_no }}@endif
                    </th>

                </tr>
                <tr>

                    <th style="font-size: 10pt; text-align:left">
                        <strong>Mobile No. : </strong> {{$userDetails->mobile}}
                    </th>

                    <th style="text-align: right; font-size: 10pt;">
                        <strong>Challan No. : @if(isset($allotment_fee_detail) ) {{ $allotment_fee_detail->challan_no }} @endif</strong>
                    </th>

                </tr>
                <tr>

                    <th style="font-size: 10pt; text-align:left">
                        <strong>Email : </strong>  {{$userDetails->email}}
                    </th>
                    <th style="text-align: right; font-size: 10pt;">
                        <strong>Date : </strong> @if(isset($allotment_fee_detail) ){{ dmy($allotment_fee_detail->payment_allotment_fee_date) }}@endif
                    </th>
                </tr>
                <tr>


                    <th style="text-align: left; font-size: 10pt;">
                        <strong>Year : </strong>    {{$userDetails->created_at->format('Y') . '-' . ($userDetails->created_at->year + 1)}}

                    </th>


                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">
                        <div class="table-responsive">
                            <table class="table" border="0" cellspacing="0" cellpadding="3" width="100%" style="border-collapse:collapse; font-size:10pt;">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Hostel Name</th>
                                        <th>Sports Name</th>
                                        <th>Fee (Rs.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td align="center">1</td>
                                        <td>{{ hostelName($userDetails->hostel_alloted_id)}}</td>
                                        <td>{{sport_name($userDetails->applicationBasicDetasils->sports)}}</td>
                                        <td>2500.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="right"><b>Total</b></td>
                                        <td><b>2500.00</b></td>
                                    </tr>
                                </tbody>
                                <tfoot class="dn">
                                    <tr>
                                        <td colspan="17" style="border:0; height:30px;">&nbsp;</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<footer>
	<div class="row">
		<div class="col-md-8">
				<ul class="foot-list">
				<li>Copyright &copy; Department of Sports</li>
			</ul>
		</div>
		<!-- <div class="col-md-4">
				<ul class="foot-list float-end">
				<li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a>
				</li>
			</ul>
		</div> -->
	</div>
</footer>
</div>
@endsection


<script>
      function showTrialModal() {
          var modal = new bootstrap.Modal(document.getElementById('trialVenueModal'));
          modal.show();
      }

      function checkStatus(){




$('#applicationNo').val('');
$("#responsestatus").empty();
 $('#exampleModal').show();

}

function closestatus(){
    $('#exampleModal').hide();
}


$("#reloadd").submit(function (e) {


    e.preventDefault();
    $("#responsestatus").empty();

    if ($("#reloadd")[0].checkValidity() === false) {
            e.stopPropagation();
    } else {


            $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (res) {

                            if (res.error == false) {

                                if(res.msg == 1){
                                    $("#responsestatus").append('<div class="alert alert-success" role="alert">Your Application is Accepted</div>');

                                }else if(res.msg == 2){
                                    $("#responsestatus").append('<div class="alert alert-danger" role="alert">Your Application is Rejected</div>');

                                 }else{
                                    $("#responsestatus").append('<div class="alert alert-warning" role="alert">Your Application is In-process</div>');
                                }




                            } else {
                                $("#responsestatus").append(' <div class="alert alert-danger" role="alert">No Record Found.</div>');
                            }

                            $('#applicationNo').val('');
                    },
            });
    }
    $("#reloadd").addClass("was-validated");
});




function PrintDocc() {

var toPrint = document.getElementById('prodiv');

var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

popupWin.document.open();

popupWin.document.write('<html><title>Challan</title><head><style>body{font-family:Arial; counter-reset: page;} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:2px 3px; font-size: 10pt;} @page { size: A4 portrait; margin: 10pt 10pt 10pt;}</style></head><body onload="window.print()">')

popupWin.document.write(toPrint.innerHTML);
popupWin.document.write('</body></html>');

popupWin.document.close();
}









</script>
