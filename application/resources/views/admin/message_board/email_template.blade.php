@extends( 'layouts/admin_layout' )
@section( 'content' )
	
			<div class="row">

				<div class="col-md-12">

					<div class="pageheader" id="menu-margin">
						<h4 class="mb-0">@if(isset($email_template)) Edit @else Create @endif Email Template</h4>
					</div>
					<div class="card mb-3">

						<div class="card-body">
							<form action="{{ route('saveEmailTemplate') }}" id="save_Template" class="needs-validation" method="post" autocomplete="off" novalidate>
								<div class="row">
									@if(isset($email_template)) 
									<input type="hidden" name="id" value="{{ $email_template->id }}">
									@endif
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="template_id">1) Templates Id <span class="text-danger">*</span></label>
												<input type="text" class="form-control  mt-2"  id="template_id" name="template_id" @if(isset($email_template)) readonly value="{{ $email_template->template_id }}" @else  value="{{ old('template_id') }}" @endif placeholder="Enter Templates Id" required="" minlength="6" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
												<div class="invalid-feedback">
													Please provide Templates Id.
												</div>
												@if ($errors->has('template_id'))
												<span class="error_mess">{{ $errors->first('template_id') }}</span> @endif
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label for="template_name">2) Templates Name <span class="text-danger">*</span></label>
												<input type="text" class="form-control  mt-2"  id="template_name" name="template_name" @if(isset($email_template)) value="{{ $email_template->template_name }}" @else  value="{{ old('template_name') }}" @endif placeholder="Enter Templates Name" required="">
												<div class="invalid-feedback">
													Please provide Templates Name.
												</div>
												@if ($errors->has('template_name'))
												<span class="error_mess">{{ $errors->first('template_name') }}</span> @endif
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label for="email_subject">3) Email Subject <span class="text-danger">*</span></label>
												<input type="text" class="form-control  mt-2" id="email_subject" name="email_subject" @if(isset($email_template)) value="{{ $email_template->subject }}" @else  value="{{ old('email_subject') }}" @endif placeholder="Enter  Email Subject" required="">
												<div class="invalid-feedback">
													Please provide  Email Subject.
												</div>
												@if ($errors->has('email_subject'))
												<span class="error_mess">{{ $errors->first('email_subject') }}</span> @endif
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label for="email_body">4) Email Body <span class="text-danger">*</span></label>
												<!-- ckeditor -->
												<!-- <textarea class=" form-control mt-2" id="email_body" name="email_body" required>@if(isset($email_template)) {{ $email_template->body }} @else {{old('email_subject')}} @endif</textarea> -->
												<textarea cols="8" name="email_body" required rows="5" class="form-control ckeditor">@if(isset($email_template)) {{ $email_template->body }} @else {{old('email_body')}} @endif</textarea>
												<div class="invalid-feedback">
													Please provide  Email Body.
												</div>
												@if ($errors->has('email_body'))
												<span class="error_mess">{{ $errors->first('email_body') }}</span> @endif
											</div>
										</div>
										
									</div>
									
									<div class="col-md-2 d-grid">
										<button class="btn btn-primary" type="submit">@if(isset($email_template)) Update @else Submit @endif</button>
									</div>
									<div class="col-md-2 d-grid">
										<button type="reset" class="btn btn-danger">Reset</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
	
	<script type="text/javascript" src="{{ url('ckeditor/ckeditor.js') }}"></script>
@endsection
@push( 'custom-scripts' )
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script> 

@endpush
