@extends( 'layouts/admin_layout' )
@section( 'content' )
<style>
 .comme {
        white-space: nowrap;
        text-overflow: ellipsis;
        width: 300px;
        overflow: hidden;

}

.comme:hover {
        /* white-space: normal;
        overflow: visible; */

        white-space: normal;
        overflow: visible;
        background-color: #ffefc4;
        position: absolute;
        z-index: 99999;
        padding: 5px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}



.bgremove{
	    background-color: #e3ffff;
}
</style>


		<div class="pageheader row" id="menu-margin">
		<div class="col-md-10">

			<h4>Announcement </h4>
				</div>



                <div class="col-md-2">
                    @if (Auth::guard('admin')->user()->id == 1)
                    <a href="{{ route('add_announcement') }}" class="w-100 mb-0 btn btn-primary btn-sm ">
                        <i class="fas fa-plus"></i> Add Announcement
                    </a>

                       @endif

                </div>
			<div class="col-md-2">



		</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="dataTable" class="table table-bordred table-hover bg-white datatable">
						<thead>
							<tr>
								<th>S.No.</th>
								<th>Announcemnt</th>
								<th> Visible From</th>
                                <th> Visible To</th>
                                <th> Sent By</th>
                                @if (Auth::guard('admin')->user()->id == 1)
                                <th>Sent On</th>   
                                @endif
								
							</tr>
						</thead>
						<tbody>

                           

							@foreach($announcement as $key=>$item)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $item->announcement }}</td>
                                <td>{{ dmy($item->start_date)}}</td>
                                <td>{{ dmy($item->end_date)}}</td>
                                <td >{{ admin_name($item->created_by ) }}</td>
                                @if (Auth::guard('admin')->user()->id == 1)
								<td>{{ dmyHi($item->created_on)}}</td>
                                @endif
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>



			</div>
		</div>

@endsection
