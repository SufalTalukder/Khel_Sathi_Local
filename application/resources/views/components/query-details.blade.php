
@if( count( $queryData ) > 0 )

<div class="noprint">
	<h4 class="bg-light p-2"> Details of Queries/प्रश्नों का विवरण </h4>
	<div class="table-responsive">
		<table id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;" >
			<thead>
				<tr>
					<th>S.No.<br>क्र.सं.</th>
					<th>Subject<br>विषय</th>
					<th>Query Remark<br>प्रश्न टिप्पणी</th>
					<th>Query Related Document<br>प्रश्न संबंधित दस्तावेज़</th>
					<th>Status<br>स्थति</th>
					<th>Query Raised On<br>प्रश्न उठाया गया</th>
					<th>Query Closed On<br>क्वेरी बंद हो गई</th>

				</tr>
			</thead>
			@foreach($queryData as $key=>$article)
			<tbody>
				<tr>
					<td>{{$key+1}}</td>
					<td class="text-center">{{$article->query_subject}}</td>
					<td class="text-center">{{$article->query_details}}</td>
					<td class="text-center">
						@if($article->query_doc!='') @php $img = url('public/queryDoc').'/'.$article->query_doc; $img1 = url('public/images/images.svg'); $doc = explode('.',$article->query_doc); if($doc[1]=='pdf') $img1 = url('public/images/pdf.svg'); @endphp
						<!-- <i class="far fa-image" style="font-size: x-large;color: #6f125a;"></i> -->
						<img src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query">
						
						@endif
					</td>
					<td class="text-center">




						@if($article->query_status == 1 || $article->is_closed == 1)
						<a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="queryFormReply(1,{{$article->id}})">View</a> @else

						<!-- @if(Auth::guard('admin')->user()!=null)
                <a href="javascript:void(0);" class="btn btn-primary btn-sm" onclick="queryFormReply(1,{{$article->id}})">Send Reminder</a>
                @else
                <a href="javascript:void(0);" class="btn btn-primary btn-sm " onclick="queryFormReply(0,{{$article->id}})">Reply</a>
                @endif -->
						<a href="javascript:void(0);" class="btn btn-primary btn-sm " onclick="queryFormReply(0,{{$article->id}})">
							@if(isset(Auth::guard('admin')->user()->id) && Auth::guard('admin')->user()!=null) Send Reminder @else Reply @endif</a> 
						@endif @if(Auth::guard('admin')->user()!=null) @if($article->is_closed == 1)
						<a href="javascript:void(0);" class="btn btn-danger  btn-sm ml-5">Closed</a> 
						@else @if($article->query_status == 0) <a href="javascript:void(0);" class="btn btn-primary  btn-sm ml-5">Pending</a>@elseif($article->query_status == 1) Replied 
						@else -- @endif	@if(isset(Auth::guard('admin')->user()->id) && (Auth::guard('admin')->user()->id != 1) || $article->form_type == 7)<a href="javascript:void(0);" class="btn btn-danger  btn-sm ml-5" onclick="queryClosed(1,{{$article->id}})">Close Query</a> @endif @endif @endif

					</td>
					<td class="text-center">{{dmy($article->trans_date)}}</td>
					<?php $query_reply=queryReply($article->id); ?>
					<td class="text-center">
						@if($article->closeing_date) {{dmy($article->closeing_date)}} @else -- @endif

					</td>
				</tr>
			</tbody>
			@endforeach
		</table>
	</div>
</div>

@endif
