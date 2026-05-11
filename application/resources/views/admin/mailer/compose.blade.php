@extends( 'layouts/admin_layout' )
@section( 'content' )



<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">Compose</h4>
</div>
<div class="card mb-3">

	<div class="card-body">
		<form action="{{ route('adminmailStore') }}" class="needs-validation" id="add_name3" method="post" autocomplete="off" novalidate enctype="multipart/form-data">
		@csrf

<div class="row">
	<div class="col-md-12" id="new_user_child" >
					<div class="row">

						<div class="col-md-12">
						<div class="form-group ">
                            <input type="hidden" name="iddd" value="@if (isset($composer->id )){{ $composer->id }}@endif">
							<label for="IMPORT FILE" class="placeholder" > SUBJECT </label>
						   <input id="adminsubject"  type="text" class="form-control  mt-1 " name="subject" required @if (isset($composer->subject ))value="{{ $composer->subject }}" @endif>
						</div>
					</div>


				</div>
				</div>


	<div class="col-md-12 TEMPLATE_CONMTENT" >
		<div class="form-group">
			<label for="TEMPLATE_CONMTENT" class="placeholder"> Body </label>
			<textarea cols="8" name="message" rows="5"  class="form-control ckeditor  mt-2" id="IdOfCKEditorTextArea" required>@if (isset($composer->subject ))
                {!! $composer->subject !!}
            @endif</textarea>
		</div>
	</div>

    	<div class="col-md-5">
						<div class="form-group mt-2">
							<label for="IMPORT FILE" class="placeholder"> ATTACHMENT</label>
							<input id="file" type="file" class="form-control  mt-2 " multiple="multiple" name="attachment[]">
						</div>
					</div>




                <div class="col-md-12" id="existing_user_child" >
					<div class="row">
					<div class="col-md-5">
						<div class="form-group">
							<label for="username" class="placeholder">Role <strong class="text-danger">*</strong></label>
							<Select name="role_user[]" id="role" class="form-control mt-1" onchange="get_user_data(this.value,'existing_users')">
								<option value="">-- Select --</option>
								@foreach ($role_management as $type)
								<option value="{{$type->id}}">{{$type->role_name}}</option>
								@endforeach
							</Select>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group">
							<label for="username" class="placeholder">Existing Users<strong class="text-danger">*</strong></label>
							<Select name="existing_users[]" id="existing_users" data-id="00" class="existing_users form-control select" multiple="multiple">

							</Select>
						</div>
					</div>
					<div class="col-md-2">
						<label class="placeholder">&nbsp;</label>
						<button type="button" name="add" id="add4" class="btn btn-primary form-control  mt-2">Add</button>
					</div>
				</div>
				</div>
			<div class="col-md-5 d-flex gap-2">
				<button class="btn btn-primary"  id="sub_button" type="submit"> Send </button> <a href="javascript:void(0)"  class="btn btn-primary "  onclick="draftmessage()">Draft</a>
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
		//var addamount = 0;
		var addamount = 700;

		$( "#add4" ).click( function () {

			i++;
            alert('cxvxc');
			iddd = "existing_users" + i;

			$( '#existing_user_child' ).append( '<div class="row" id="new_user_child' + i + '" ><div class="col-md-5"> <div class="form-group"> <label for="username" class="placeholder"><b>Role</b> <strong class="text-danger">*</strong></label> <Select name="role_user[]" id="role' + i + '"  required class=" form-control" onchange="get_user_data(this.value,iddd)"> <option value="">-- Select --</option> @foreach ($role_management as $type) <option  value="{{$type->id}}" >{{$type->role_name}}</option> @endforeach </Select> </div> </div> <div class="col-md-5"> <div class="form-group"> <label for="username" class="placeholder"><b>Existing Users</b><strong class="text-danger">*</strong></label> <Select name="existing_users[]" required id="existing_users' + i + '" data-id="00" class="existing_users form-control select" multiple="multiple"> </Select> </div> </div><div class="col-md-2"> <label  class="placeholder">&nbsp;</label> <button type="button" name="remove" id="' + i + '" class="btn btn-danger form-control  btn_remove">X</button> </div> </div>' );
			$( '.existing_users' ).select2();
		} );

		$( document ).on( 'click', '.btn_remove', function () {



			var button_id = $( this ).attr( "id" );
			console.log( '#new_user_child' + button_id );

			$( '#new_user_child' + button_id ).remove();
		} );



		$( "#submit" ).on( 'click', function ( event ) {
			var formdata = $( "#add_name3" ).serialize();
			// console.log( formdata );

			event.preventDefault()

			$.ajax( {
				url: "action.php",
				type: "POST",
				data: formdata,
				cache: false,
				success: function ( result ) {
					alert( result );
					$( "#add_name3" )[ 0 ].reset();
				}
			} );

		} );

		function get_user_data( value, id ) {

			console.log( id )

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
