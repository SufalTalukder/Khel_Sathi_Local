@extends( 'layouts/admin_layout' )
@section( 'content' )


<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">Post Manager
		<a href="{{route('post_master_add')}}" class="btn btn-primary btn-sm float-end">Add Post</a>
		<a title="Post Manager" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
			<i class="fa fa-file-excel"></i> Export to Excel
		</a>
	</h4>
</div>
<div class="card">
	<div class="card-body">
		<div class="table-responsive">
			<table id="dataTable" class="table table-bordred ellipsis table-hover bg-white datatable">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Department</th>
                        <th>Post Name</th>
                        <th>Basic Pay</th>
						<!-- <th>Start Date</th> -->
						<!-- <th>End Date</th> -->

						<th>No. of Post</th>
						<!--<th>Category wise no. of post
                                                             <tr>
                                                                <td>General</td>
                                                                <td>OBC</td>
                                                                <td>SC</td>
                                                                <td>ST</td>
                                                                <td>EWS</td>
                                                                <td>PWD</td>
                                                            </tr>
                                                        </th>-->
						{{-- <th>MIN AGE</th>
						<th>MAX AGE</th>
						<th>FROM MIN AGE</th>
						<th>Age Relaxation
							<!-- <tr>
                                                                <td>General</td>
                                                                <td>OBC</td>
                                                                <td>SC</td>
                                                                <td>ST</td>
                                                                <td>EWS</td>
                                                                <td>PWD</td>
                                                            </tr> -->
						</th>
						<th>MIN Qualification</th>
						<th>Is experience required ?
							<!-- <td>Min No. of Year</td> -->
						</th>
						<th>Document</th>--}}
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($post_list as $key=>$item)
					<tr>
						<td>{{ $key+1 }}</td>
						<td>{{ $item->advertisment_no }}</td>
                        <td>{{ $item->post_name }}</td>
                        <td>{{ $item->basic_pay }}</td>
						<!-- <td>{{ dmy($item->start_date) }}</td> -->
						<!-- <td>{{ dmy($item->end_date) }}</td> -->

						<td>{{ $item->total_post }}</td>
						{{-- <td>{{ $item->min_age }}</td>
						<td>{{ $item->max_age }}</td>
						<td>{{ dmy($item->min_age_from) }}</td>
						<td>@if($item->is_age_relaxation == 1)YES @else NO @endif</td>
						<td>{{ $item->min_qualification }}</td>
						<td>@if($item->is_experience_required == 1)YES @else NO @endif</td> --}}
						{{-- <td>
							@if($item->adevertisment_doc !='') @php $img = url('storage/adevertisment_doc').'/'.$item->adevertisment_doc; $img1 = url('public/images/images.svg'); $doc = explode('.',$item->adevertisment_doc); if($doc[1]=='pdf') $img1 = url('public/images/pdf.svg'); @endphp
							<img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" style=" width: 25px; height: auto;" class="img-fluid img-query" /> @endif
						</td> --}}
						<td><a href="{{ route('edit_post',$item->id) }}" class="btn btn-primary btn-xs btn-block">
								<i class="fas fa-edit"></i>
							</a>
							<a class="btn btn-sm btn-danger pointer bt" href="{{ route('deletePostMaster' , $item->id) }}" onclick="return confirm('Are you sure you want to Delete ?')">
								<i class="fa fa-trash-o"></i>
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

@push('custom-scripts')
<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>
	function ExportToExcel(type, fn, dl) {
		var elt = document.getElementById('dataTable');
		var wb = XLSX.utils.table_to_book(elt, {
			sheet: "sheet1"
		});
		return dl ?
			XLSX.write(wb, {
				bookType: type,
				bookSST: true,
				type: 'base64'
			}) :
			XLSX.writeFile(wb, fn || ('Post Manager.' + (type || 'xlsx')));
	}
</script>
@endpush
