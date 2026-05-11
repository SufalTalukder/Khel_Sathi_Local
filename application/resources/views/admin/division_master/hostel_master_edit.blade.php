@extends( 'layouts/admin_layout' )
@section( 'content' )


<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">Hostel Master Edit
		<a href="{{ route('listHostelMaster') }}" class="btn btn-primary btn-sm float-end">
			<i class="fa fa-arrow-left"></i>
			&nbsp;&nbsp;Back
		</a>
	</h4>
</div>

<div class="card mb-3">

	<div class="card-body">
		<form action="{{ asset('assets_admin/update-hotel-master/'.encrypt($divisions->id)) }}" class="needs-validation" method="post" autocomplete="off" id="formHostelMasterUpade" novalidate>
			@csrf
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">Hostel Name<span class="text-danger">*</span></label>
						<input class="form-control" type="text" name="hostel_name" value="{{$divisions->hostel_name}}" required="">
					</div>
					@if ($errors->has('hostel_name'))
					<span class="error_mess">{{ $errors->first('hostel_name') }}</span> @endif
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">Division Name<span class="text-danger">*</span></label>
						<select class="form-select" id="division_name" name="division_name" value="{{ old('status') }}" required="">
							<option selected="" disabled="" value="">Select Division</option>
							@foreach($divisionss as $key=>$division)
							<option value="{{ $division->id }}" {{ $division->id == $divisions->division_name ? 'selected' : '' }} data-badge="">{{$division->division_name}}</option>
							@endforeach
						</select>
					</div>
					@if ($errors->has('division_name'))
					<span class="error_mess">{{ $errors->first('division_name') }}</span> @endif
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">Districts Name<span class="text-danger">*</span></label>
						<input type="hidden" id="district_id" value="{{($divisions->districts)}}">
						<select id="city-dd" class="form-select" name="districts" required="">
						</select>
					</div>
					@if ($errors->has('districts'))
					<span class="error_mess">{{ $errors->first('districts') }}</span> @endif
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">Total Number Of Seats</label>
						<input type="number" id="total_seats" autocomplete="off" name="total_seats" class="form-control" required="" value="{{$divisions->total_seats}}" />
					</div>
					@if ($errors->has('total_seats'))
					<span class="error_mess">{{ $errors->first('total_seats') }}</span> @endif
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="name"> Boys<span class="text-danger">*</span></label>
						<input class="form-control" type="number" name="boys" value="{{$divisions->boys}}" id="boys" required="">
					</div>
					@if ($errors->has('boys'))
					<span class="error_mess">{{ $errors->first('boys') }}</span> @endif
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="name"> Girls<span class="text-danger">*</span></label>
						<input class="form-control" type="number" value="{{$divisions->girls}}" name="girls" id="girls" required="">
					</div>
					@if ($errors->has('girls'))
					<span class="error_mess">{{ $errors->first('girls') }}</span> @endif
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">Already Used Seat<span class="text-danger">*</span></label>
						<input class="form-control" type="number" value="{{$divisions->seat_used}}" name="seat_used" id="seat_used" required="">
					</div>
					@if ($errors->has('seat_used'))
					<span class="error_mess">{{ $errors->first('seat_used') }}</span> @endif
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="boys_seat_used">Used Boys Seats<span class="text-danger">*</span></label>
						<input class="form-control" type="number" name="boys_seat_used" id="boys_seat_used" required="" value="{{$divisions->boys_alloted }}">
						@if ($errors->has('boys_seat_used'))
						<span class="error_mess">{{ $errors->first('boys_seat_used') }}</span>
						@endif
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="girls_seat_used">Used Girls Seats<span class="text-danger">*</span></label>
						<input class="form-control" type="number" name="girls_seat_used" id="girls_seat_used" required="" value="{{$divisions->girls_alloted }}">
						@if ($errors->has('girls_seat_used'))
						<span class="error_mess">{{ $errors->first('girls_seat_used') }}</span>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group mt-2 row">
						<h5 for="name" class="mb-3">Sports <span class="text-danger">*</span></h5>
						@foreach($sports as $key=>$sport)
						<label class="col-3" for="{{$sport->id }}">
							<input type="checkbox" name="sports[]" id="{{$sport->id }}" value="{{$sport->id }}" <?php if (in_array($sport->id, $spo)) echo 'checked'; ?>>
							{{$sport->name}}
						</label>
						@endforeach
					</div>
					@if ($errors->has('sports'))
					<span class="error_mess">{{ $errors->first('sports') }}</span> @endif
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-2 d-grid">
					<label class="form-label">&nbsp;</label>
					<button class="btn btn-primary form-group" type="submit">Submit</button>
				</div>
			</div>
		</form>
	</div>
</div>

@endsection
@push('custom-scripts')

<script type="text/javascript">
	// check the boys and girl value are equeal
	$("#formHostelMasterUpade").submit(function(e) {
		e.preventDefault();
		console.log($("#formHostelMasterUpade")[0].checkValidity())
		if ($("#formHostelMasterUpade")[0].checkValidity() === false) {
			e.stopPropagation();
		} else {

			var boys = parseInt($('#boys').val());
			var girls = parseInt($('#girls').val());
			var seat_used = parseInt($('#seat_used').val());
			//boys and girls used
			var boy = parseInt($('#girls_seat_used').val());
			var girl = parseInt($('#boys_seat_used').val());
			var Alreadyuseboysandgirlseat = boy + girl;

			var total_seats = parseInt($('#total_seats').val());
			var cat_post_total = boys + girls ;

			if (Alreadyuseboysandgirlseat === seat_used) {
				if (cat_post_total === total_seats) {
					$.ajax({
						type: "POST",
						url: $(this).attr("action"),
						data: new FormData(this),
						dataType: "json",
						contentType: false,
						cache: false,
						processData: false,
						success: function(res) {
							if (res.error == false) {
								// window.location.reload();
								success(res.msg);
								window.location.href = 'admin/list-hostel-master';
							} else {
								error(res.msg);
							}
						},
					});
				} else {
					error("Total Number Of Seats Boys Girls And Used Seat Colum value Sum Not Same.");
				}
			} else {
				error("Total Used Of Seats Boys Girls Colum value Sum Not Same.");
			}
		}
		$("#formHostelMasterUpade").addClass("was-validated");
	});

	//get district data by division name
	$(document).ready(function() {

		var idState = $('#division_name').val();
		//alert(idState);
		let h_city = $("#district_id").val();
		$("#city-dd").html('');
		$.ajax({
			url: "admin/fetch-cities",
			type: "POST",
			data: {
				division_id: idState,
				_token: '{{csrf_token()}}'
			},
			dataType: 'json',
			success: function(res) {
				$('#city-dd').html('<option value="">Select Districts</option>');
				$.each(res.cities, function(key, value) {

					$("#city-dd").append(`<option value="${value.district_id}" ${value.district_id==h_city ? 'selected':''}>${value.city}</option>`);
				});
			}
		});

		$('#division_name').on('change', function() {
			var idState = this.value;
			//alert(idState);
			$("#city-dd").html('');
			$.ajax({
				url: "admin/fetch-cities",
				type: "POST",
				data: {
					division_id: idState,
					_token: '{{csrf_token()}}'
				},
				dataType: 'json',
				success: function(res) {
					$('#city-dd').html('<option value="">Select Districts</option>');
					$.each(res.cities, function(key, value) {
						$("#city-dd").append('<option value="' + value
							.district_id + '">' + value.city + '</option>');
					});
				}
			});
		});
	});
</script>
@endpush
