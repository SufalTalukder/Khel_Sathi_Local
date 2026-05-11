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
</style>


		<div class="pageheader row" id="menu-margin">
		<div class="col-md-10">

			<h4>Broadcasts </h4>
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


								<th>Subject</th>
							
								<th>Broadcast By</th>
								<th>Broadcast On</th>
								<th>Action</th>


							</tr>
						</thead>
						<tbody>


							@foreach($broadcast_list as $key=>$item)
							<tr>

								<td>{{ $key+1 }}</td>


								<td>{{ $item->subject }}</td>
                                
                              <td >  {{admin_name($item->created_by)}}</td>

								<td>{{ dmyHi($item->created_on)}}</td>
								<td>
									<button class="btn btn-outline-success rounded-pill" onclick="view_broadcast({{$item->mail_id}})" ><i class="fa fa-eye"></i></button>
					         	</td>


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
            <div class="modal-body text-left" >
                <div id="view_broadcast_special"></div>
                <div class="row" id="attachmentList">

                </div>




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
                   $("#attachmentList").empty();
		 var actionUrl = ajaxUrl+"/admin/view_broadcast/"+ broadcast_id ;
              $.ajax({
                  type: "GET",
                  url: actionUrl,


                  success: function (res) {
                if (res.error == false) {

                  $("#exampleModalLongTitle").append(res.data.subject);
				   $("#view_broadcast_special").append(res.data.message);

                   if(res.attachment){

                    res.attachment.forEach(item => {
                        console.log(item)
                        $("#attachmentList").append(`<div class="col-md-1 mx-3">
                             <a href="{{asset('mail/attachment/${item.attachment}')}}" download><img src="{{asset('assets_admin/images/paperclip.png' )}}" alt="" srcset=""></a>
                         <div>`);
                    });

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
</script>
@endpush
