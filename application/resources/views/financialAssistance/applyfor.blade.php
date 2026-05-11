@extends( 'layouts/financelayout' )
@section( 'content' )
	<div class="row">
		<!-- <div class="col-md-2">
			<a href="{{ route('fadashboard') }}" class="btn btn-outline-primary backbtn"><span class="icons icon-arrow-left"></span> Dashboard</a>
			<div class="left-sidebar">
				<div>
					<ul>
						<li><a href="{{ route('faprofile') }}"><span class="icons icon-arrow-left"></span>Profile Detail</a>
						</li>
						<li><a href="{{ route('faapplyFor') }}" class="active"><span class="icons icon-arrow-right"></span>I am applying for/मैं आवेदन कर रहा हूं</a>
						</li>
					</ul>
				</div>
			</div>
		</div> -->
		<div class="col-md-12">
			<div class="bhoechie-tab-container">
				<div class="row">
					@if(count($award_type)==0)
					<h4>Already Apply For All</h4> @else
					<form action="{{url('financial-assistance/saveApplyFor')}}" method="post" class="needs-validation mt-4" novalidate>
						@csrf
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="bhoechie-tab-content">
								<div class="form-scroll">
									<div>
										<div class="row">
											<div class="col-md-12">
												<h5 class="subheading">A. I am applying for/मैं आवेदन कर रहा हूं</h5>
											</div>
											@foreach ($award_type as $type)
											<?php $check=form_date_status($type->id);?>
											<div class="col-md-12 mb-3">
												<div class="form-check form-check-inline">
													<input type="radio" name="applyfor" onClick="document.getElementById('reg-submit').disabled=false" required value="{{$type->id}}" @if($check==0 ) disabled @endif class="form-check-input"/>
													<label class="form-check-label" for="inlineCheckbox2">{{$type->text}}</label> @if($check == 0)
													<p class="text-danger">*Form Not Available</p>@endif
												</div>
											</div>
											@endforeach
										</div>
										<div class="bhoechie-footer">
											<div class="row justify-content-center">
												<div class="col-md-3 d-grid">
													<button type="submit" id="reg-submit" disabled class="btn btn-info">Save & Proceed/दर्ज करें व आगे बढ़ें</button>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
					@endif

				</div>
			</div>
		</div>
	</div>



@endsection

@push( 'custom-scripts' )

<script type="text/javascript">
	function showMsg() {
		info( "Please Complete Your Profile" );
	}

	function get_city( value, id ) {
		let city = $( "#district1" ).val();
		let same = $( "#same" ).prop( 'checked' ) == true;
		let h_city = $( "#h_district" ).val();
		let h_city1 = $( "#h_district1" ).val();
		let option = `<option value=''>Select City</option>`;
		console.log( city, same )
		$.ajax( {
			type: "POST",
			url: "{{url('get_city')}}",
			data: {
				value
			},

			success: function ( response ) {
				response.forEach( ( item ) => {
					///setTimeout(() => {
					if ( h_city && id == "district" && $( "#same" ).prop( 'checked' ) == false ) {
						option += `<option value="${item.id}" ${item.id==h_city?'selected':''}>${item.city}</option>`;
					} else if ( h_city1 && id == "district1" && $( "#same" ).prop( 'checked' ) == false ) {
						option += `<option value="${item.id}" ${item.id==h_city1?'selected':''}>${item.city}</option>`;
					} else if ( city && id == "district" ) {
						option += `<option value="${item.id}" ${item.id==city ? 'selected':''}>${item.city}</option>`;
					} else {
						option += `<option value="${item.id}" >${item.city}</option>`;
					}
					///}, 20)
				} );
				$( "#" + id ).empty();
				$( "#" + id ).append( option );
			}
		} );
	}

	$( "#same" ).change( ( e ) => {
		if ( $( "#same" ).is( ":checked" ) ) {
			let address1 = $( "#address1" ).val();
			let state = $( "#state1" ).val();
			let permanent_pincode = $( "#present_pincode" ).val();
			$( "#state" ).val( state );
			$( "#permanent_address" ).text( address1 );
			$( "#permanent_pincode" ).val( permanent_pincode );
			$( '#state' ).trigger( 'change' );
			$( '.dis_check' ).attr( "style", "pointer-events: none;" );



		} else {
			$( "#permanent_address" ).val( '' );
			$( "#state" ).val( '' );
			$( "#district" ).val( '' );
			$( "#permanent_pincode" ).val( '' );
			$( '.dis_check' ).attr( "style", "" );

		}
	} )

	//  window.onload=()=>{
	//     get_city();
	//  }
	//         $(function () {
	//     $('#dob').datepicker({
	//         changeMonth: true,
	//         changeYear: true,
	//         dateFormat: 'dd/mm/yy', maxDate: '18Y',
	//         onClose: function (dateText, inst) {
	//             var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
	//             var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
	//             $(this).datepicker('setDate', new Date(year, month, 1));
	//         }
	//     });
	// });
	$( "#dob" ).datepicker( {
		changeMonth: true,
		changeYear: true,
		yearRange: '1960:3025',
		minDate: '-60Y',
		dateFormat: 'dd/mm/yy',
		maxDate: '-18Y'
	} );
</script>
@endpush
