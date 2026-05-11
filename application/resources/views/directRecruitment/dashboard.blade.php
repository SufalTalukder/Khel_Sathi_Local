@extends( 'layouts/drlayout' )
@section( 'content' )

<div class="container-fluid">	
		<div class="pageheader">
			<div class="row">
				<div class="col-md-10">
					<h4 class="mb-0">Dashboard/डैशबोर्ड</h4>
				</div>
				@if(!$articles)
				<div class="col-md-2">
					<a class="btn btn-sm btn-dark w-100" href="{{ route('drsa') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp; Complete Form</a>
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
								<th>Application No.<br>आवेदन संख्या</th>
								<th>Applicant Name<br>आवेदक का नाम</th>
								<th>Email ID<br>ईमेल आईडी</th>
								<th>Mobile No.<br>मोबाइल नंबर</th>
								<th>Date of Application<br>आवेदन की तिथि</th>
								<th>Application Status<br>आवेदन की स्थिति</th>
								<!-- <th>Final Status<br>अंतिम स्थिति</th> -->
								<th>Query Status<br>संशय/आपत्ति</th>
								<th class="text-center">View<br>देखें</th>
							</tr>
						</thead>
						<tbody>
							{{-- @foreach($articles as $key=>$item)--}} @if($articles)
							<tr>
								<td>1</td>
								<td>{{ $articles->application_no }}</td>
								<td>{{ $articles->fullname }}</td>
								<td>{{ $articles->email }}</td>
								<td>{{ $articles->mobile }}</td>
								<td>{{ dmy($articles->created_at) }}</td>
								<!-- <td>@if(($articles->final_submit)== 1) <strong class="btn btn-success btn-xs btn-block btn-block">Completed</strong> @else  <strong class="btn btn-primary btn-xs btn-block btn-block">Pending</strong> @endif</td> -->
								<td>
									<?php if($articles->form_status == 1) { ?>
									<span class="btn btn-success">Accepted</span>
									<?php } elseif($articles->form_status == 3) { ?>
									<span class="btn btn-warning">Pending</span>
									<?php } elseif($articles->form_status == 2) { ?>
									<span class="btn btn-danger">Declined</span>
									<?php } else { ?>
									<span class="btn btn-warning">Pending</span>
									<?php } ?>
								</td>
								<?php $abc=marked_status(( Auth::guard('direct_recruitment')->user()->user_id),6);?>

								<td>
									@if(isset($abc) && ($articles->form_status == 0) && ($abc->is_closed == 0)) @if(($abc->query_status) == 0)
									<strong class="btn btn-primary btn-xs btn-block">Marked<br>दर्ज की गई</strong> @else
									<strong class="btn btn-primary btn-xs btn-block">@if($abc->current_status == "RSO") RSO @endif Replied<br>प्रत्युत्तर भेजा गया</strong> @endif @elseif(isset($abc) && ($abc->is_closed == 1))
									<strong class="btn btn-danger btn-xs disabled">Closed</strong> @else
									<strong class="btn btn-danger btn-xs disabled">Not Marked<br>नहीं दर्ज की गई</strong> @endif
								</td>

								<!-- <td>
                                    <strong class="btn btn-primary btn-xs btn-block btn-block">Pending</strong>
                                </td> -->
								<td class="text-center">
									<a href="{{ route('drformPreview')}}" class="btn btn-primary btn-xs btn-block">
                                        <i class="fas fa-eye"></i>
                                    </a>
								
								</td>
							</tr>
							@endif {{-- @endforeach --}}
						</tbody>
					</table>
				</div>
			</div>
		</div>


@endsection
