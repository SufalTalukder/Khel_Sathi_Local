@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="row">
	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Calendar Management Form</h4>
		</div> 
		<div class="card mb-3">
			<div class="card-body">
				<form @if(isset($CalendarManagementForm->id)) action="{{ route('edit_calendar', $CalendarManagementForm->id) }}"  @else action="{{ route('saveCalendar') }}" @endif    class="needs-validation" method="post" autocomplete="off">
					@csrf
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="name">Division Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control alphanumeric" id="division_name" name="division_name" value="{{ old('division_name') }}" placeholder="Enter Division Name" required="">
								<div class="invalid-feedback">
									Please provide Division Name.
								</div>
								@if ($errors->has('division_name'))
								<span class="error_mess">{{ $errors->first('division_name') }}</span> @endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="name">Status <span class="text-danger">*</span></label>
								<select class="form-select" name="status" value="{{ old('status') }}" required="">
									<option selected="" disabled="" value="">Select Status</option>
									<option value="1">Enable</option>
									<option value="0">Disable</option>
								</select>
							</div>
							@if ($errors->has('status'))
							<span class="error_mess">{{ $errors->first('status') }}</span> @endif
						</div>
						<div class="col-md-2 d-grid">
							<label class="form-label">&nbsp;</label>
							<button class="btn btn-primary form-group" type="submit">Submit/दर्ज करे</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


@endsection
