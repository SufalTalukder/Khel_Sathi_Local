@extends( 'layouts/admin_layout' )
@section( 'content' )



<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">Add Announcemnt</h4>


</div>
<div class="card mb-3">

	<div class="card-body">
		<form action="{{ route('add_announcement') }}" class="needs-validation" id="add_name3" method="post" autocomplete="off" novalidate enctype="multipart/form-data">
		@csrf

<div class="row">

	<div class="col-md-12 TEMPLATE_CONMTENT" >
		<div class="form-group">
			<label for="TEMPLATE_CONMTENT" class="placeholder"> Announcement </label>
			<textarea cols="8" name="message" rows="5"  class="form-control mt-2"  required>@if (isset($composer->subject ))

            @endif</textarea>
		</div>
	</div>

    	<div class="col-md-6">
						<div class="form-group mt-2">
							<label for="IMPORT FILE" class="placeholder"> Visible From</label>
							<input id="startDate" type="date" min="{{ date('Y-m-d') }}" required onblur="enddate()" class="form-control mt-2"  name="start_date">
						</div>
					</div>
                    <div class="col-md-6">
						<div class="form-group mt-2">
							<label for="IMPORT FILE" class="placeholder"> Visible To</label>
							<input id="endDate" type="date" class="form-control mt-2" min="" required name="end_date">
						</div>
					</div>
				</div>
			<div class="col-md-5 d-flex gap-2">
				<button class="btn btn-primary"  id="sub_button" type="submit"> Submit </button>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript" src="{{ url('ckeditor/ckeditor.js') }}"></script>
@endsection
@push( 'custom-scripts' )
	<script>

$(function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
    });



    function enddate(){
$('#endDate').attr({
"min" :$('#startDate').val(),
});
}


function draftmessage() {

            $.ajax( {
					type: "POST",
                    url: ajaxUrl + "/admin/mailStore",
                data: {
						'subject': $('#adminsubject').val(),
						'message': CKEDITOR.instances.IdOfCKEditorTextArea.getData()
					},
					success: function ( res ) {
                        if (res.error == false) {
                        success(res.msg);

                       setInterval(window.location.href = res.url, 100)  ;

                     } else {
                       error(res.msg);
                     }
					}
				} );
        }
		$( document ).ready( function () {
			$( '.existing_users' ).select2();
			$( '#templates' ).change( function () {
				var template_id = $( this ).val();
				$.ajax( {
					type: "POST",
					url: ajaxUrl + "/admin/get_template_message",
					data: {
						'template_id': template_id,
						'type': 'sms'
					},
					success: function ( data ) {
						$( '.TEMPLATE_CONMTENT' ).show();
						$( '#user_type' ).show();

						CKEDITOR.instances[ 'IdOfCKEditorTextArea' ].setData( data );
					}
				} );
			} );
		} );

		function getUserType( value ) {
			if ( value == 2 ) {
				$( '#new_user_child' ).show();
				$( '#existing_user_child' ).hide();
				$( '#existing_user_child2' ).hide();

				$( "#file" ).prop( 'required', true );
				$( "#role" ).removeAttr( 'required' );
				$( "#existing_users" ).removeAttr( 'required' );
			} else {
				$( '#new_user_child' ).hide();
				$( "#file" ).removeAttr( 'required' );
				$( "#role" ).prop( 'required', true );
				$( "#existing_users" ).prop( 'required', true );
				$( '#existing_user_child' ).show();
				$( '#existing_user_child2' ).show();
				$( ".btn-info,.rounded-pill" ).prop( "disabled", false );
			}
			$( '#sub_button' ).show();
		}

		var i = 1;
		var length;
		var iddd = "";

		var addamount = 700;

		$( document ).on( 'click', '.btn_remove', function () {
			var button_id = $( this ).attr( "id" );
			$( '#new_user_child' + button_id ).remove();
		} );





		function get_user_data( value, id ) {



			let option = '';
			$.ajax( {
				type: "POST",
				url: ajaxUrl + "/admin/get_user",
				data: {
					value
				},
				success: function ( response ) {
					/*response.forEach((item)=>{
					    option +='<option value="${item.mobile}" >${item.username}</option>';
					});
					$("#"+id).empty();
					$("#"+id).append(option); */
					$.each( response, function ( key, item ) {
						option += '<option value="' + item.id + '" >' + item.username + '</option>';
					} );

					///$("#"+id).empty();
					$( "#" + id ).html( option );

				}
			} );


		}
	</script>

@endpush
