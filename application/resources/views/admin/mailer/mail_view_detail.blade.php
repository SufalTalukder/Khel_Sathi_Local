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
	    background-color: #ecfafa;
}
</style>


		<div class="pageheader row" id="menu-margin">
		<div class="col-md-10">

			<h4>Mail Seen Detail Report</h4>
				</div>
			<div class="col-md-2">



		</div>
		</div>

        <div class="card">

            <div class="card-body">
                <p><strong>Subject :</Strong> {{ $mail_composer->subject}}</p>

                     {!! $mail_composer->message !!}
                     <div class="row">
                        
                        @if(count($admin_mail_attachment) > 0)

                        @foreach ($admin_mail_attachment as $item)
                      

                   <div class="col-md-1">
                       <a href="{{asset('mail/attachment/'.$item->attachment )}}" download><img src="{{asset('admin/attachment/paperclip.png' )}}" alt="" srcset="">
                        <img src="{{asset('assets_admin/images/paperclip.png' )}}" alt="" srcset="">
                    </a>
                       
                       
                   </div>
                        @endforeach

                        @endif
            </div>
            <br>
                     <p><strong>From :</Strong> {{ admin_name($mail_composer->created_by) }}
                     <br>
                     <strong> Date :</Strong> {{ dmyhi($mail_composer->created_on) }}</p>

                </div>
        </div>
		<div class="card">






			<div class="card-body">


				<div class="table-responsive">
					<table id="dataTable" class="table table-bordred table-hover bg-white datatable">
						<thead>
							<tr>
								<th>S.No.</th>
								<th>Sent To</th>
                                <th>Status</th>
                                <th>Read On</th>
                                <th>View Reply</th>



							</tr>
						</thead>
						<tbody>

							@foreach($composer as $key=>$item)
							<tr class=" @if($item->message_read == 1)bgremove fw-bold @endif">

								<td>{{ $key+1 }}</td>




								<td >{{ admin_name($item->user_id ) }}</td>
                                <td >@if($item->message_read == 2)Read @else Unread @endif</td>


								<td>@if($item->readed_on){{ dmyHi($item->readed_on)}}@else NA @endif</td>
                                <td>@if($item->reply)<a href="{{ route('mail_view',$item->id) }}" class="btn btn-outline-success rounded-pill"><i class="fa fa-eye"></i></a> @else NA @endif</td>

							</tr>
							@endforeach
						</tbody>
					</table>
				</div>



			</div>
		</div>

@endsection
@section('modal_content')
<div class="modal fade" id="player_coachFinalWarning" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">


                <p>Are you sure to do Deactivatation of Broadcast? No Activation will be allowed  once its Deactivated .</p>

                <p>

             <a href="javascript:void(0)" id="final_submit" class="btn btn-outline-success rounded-pill"  >Yes</a>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="view_broadcast" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
			<h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-left" id="view_broadcast_special">



            </div>

        </div>
    </div>
</div>
@endsection

@push( 'custom-scripts' )
	<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>
	function ExportToExcel( type, fn, dl ) {
		var elt = document.getElementById( 'dataTable' );
		var wb = XLSX.utils.table_to_book( elt, {
			sheet: "sheet1"
		} );
		return dl ?
			XLSX.write( wb, {
				bookType: type,
				bookSST: true,
				type: 'base64'
			} ) :
			XLSX.writeFile( wb, fn || ( 'UserList.' + ( type || 'xlsx' ) ) );
	}
function view_broadcast(broadcast_id){
		  $("#exampleModalLongTitle").empty();
				   $("#view_broadcast_special").empty();
		 var actionUrl = ajaxUrl+"/admin/view_broadcast/"+ broadcast_id ;
              $.ajax({
                  type: "GET",
                  url: actionUrl,


                  success: function (res) {
                if (res.error == false) {
                    console.log(res.data)
                  $("#exampleModalLongTitle").append(res.data.subject);
				   $("#view_broadcast_special").append(res.data.message);
				   if(res.data.attachment != ''){
                    $("#view_broadcast_special").append(`<a href="${ajaxUrl}/public/broadcast/attachment/${res.data.attachment}" class="btn btn-outline-success rounded-pill btn-sm" target="_blank" id="inputGroupFileAddon05">DownLoad</a>
					`);

				   }

				    $('#view_broadcast').modal('toggle');
                } else {
                    error(res.msg);
                }
            },
              });

	}

	function warning_broadcast($broadcast_id){
	 $('#final_submit').attr('data-id', $broadcast_id);
	    $('#player_coachFinalWarning').modal('toggle');


	}


	      $('#final_submit').click(function() {

             $dataid  = $('#final_submit').attr('data-id')
              var actionUrl = ajaxUrl+"/admin/broadcast_deactive/"+ $dataid ;

              $.ajax({
                  type: "GET",
                  url: actionUrl,


                  success: function (res) {
                if (res.error == false) {

                    success(res.msg);

                     window.location.href = res.url;
                } else {
                    error(res.msg);
                }
            },
              });

      });




 function changeMailStatus(id) {

var actionUrl = ajaxUrl+"/admin/changeMailStatus/"+ id ;

$.ajax({
   type: "GET",
   url: actionUrl,


   success: function (res) {
 if (res.error == false) {

     $(`#trbg${id}`).removeClass();

 } else {
     error(res.msg);
 }
},
});
}

</script>
@endpush
