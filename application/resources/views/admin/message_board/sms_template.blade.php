@extends( 'layouts/admin_layout' )
@section( 'content' )


					<div class="pageheader" id="menu-margin">
						<h4 class="mb-0">@if(isset($sms_templates)) Edit @else Create @endif SMS Template</h4>
					</div>
					<div class="card mb-3">

						<div class="card-body">
							<form action="{{ route('saveSmsTemplate') }}" id="save_Template" class="needs-validation" method="post" autocomplete="off" novalidate>
								<div class="row">
									@if(isset($sms_templates)) 
									<input type="hidden" name="id" value="{{ $sms_templates->id }}">
									@endif
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label for="template_id">1) Templates Id <span class="text-danger">*</span></label>
												<input type="text" class="form-control  mt-2" id="template_id" name="template_id" @if(isset($sms_templates)) readonly value="{{ $sms_templates->template_id }}" @else  value="{{ old('template_id') }}" @endif placeholder="Enter Templates Id" required="" minlength="6" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
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
												<input type="text" class="form-control  mt-2" id="template_name" name="template_name" @if(isset($sms_templates)) value="{{ $sms_templates->template_name }}" @else  value="{{ old('template_name') }}" @endif placeholder="Enter Templates Name" required="">
												<div class="invalid-feedback">
													Please provide Templates Name.
												</div>
												@if ($errors->has('template_name'))
												<span class="error_mess">{{ $errors->first('template_name') }}</span> @endif
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label for="email_body">3) Content <span class="text-danger">*</span></label>
												<!-- ckeditor -->
												<textarea cols="8" name="content" required rows="5" class="form-control ckeditor">@if(isset($sms_templates)) {{ $sms_templates->content }} @else {{old('content')}} @endif</textarea>
												<div class="invalid-feedback">
													Please provide  Content.
												</div>
												@if ($errors->has('email_body'))
												<span class="error_mess">{{ $errors->first('email_body') }}</span> @endif
											</div>
										</div>
										
									</div>
									
									<div class="col-md-2 d-grid">
										<button class="btn btn-primary" type="submit">@if(isset($sms_templates)) Update @else Submit @endif</button>
									</div>
									<div class="col-md-2 d-grid">
										<button type="reset" class="btn btn-danger">Reset</button>
									</div>
								</div>
							</form>
						</div>
					</div>
	
	<script type="text/javascript" src="{{ url('ckeditor/ckeditor.js') }}"></script>
@endsection
