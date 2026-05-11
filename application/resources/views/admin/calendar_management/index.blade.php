@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="row">
<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Add Calendar  <a class="btn btn-primary btn-sm float-end" href="{{url('/admin/calendar_list/')}}" style="width: auto;">
			<i class="fas fa-list"></i> Calendar List 
			</a></h4>
		</div>
		<div class="card mb-3">
			<div class="card-body">
			
				<?php //dd($CalendarManagementEdit); ?>
				<form @if(isset($CalendarManagementEdit->id)) action="{{ route('calendar_management_update', $CalendarManagementEdit->id) }}"  @else action="{{ route('saveCalendar') }}" @endif  class="needs-validation" novalidate enctype="multipart/form-data" method="post" autocomplete="off">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="name">Header <span class="text-danger">*</span></label>
								<input type="text" class="form-control alphanumeric" id="header_name" @if(isset($CalendarManagementEdit->header_name)) value="{{$CalendarManagementEdit->header_name}}" @endif name="header_name"  required="">
								<div class="invalid-feedback">
									Please provide header name.
								</div>
								@if ($errors->has('header_name'))
								<span class="error_mess">{{ $errors->first('header_name') }}</span> @endif
							</div>
						</div>
					
						<div class="col-md-12">
							<div class="form-group">
								<label for="name">Subject <span class="text-danger">*</span></label>
								<input type="text" class="form-control alphanumeric" id="subject_name" @if(isset($CalendarManagementEdit->subject_name)) value="{{$CalendarManagementEdit->subject_name}}" @endif name="subject_name"   required="">
								<div class="invalid-feedback">
									Please provide subject name.
								</div>
								@if ($errors->has('subject_name'))
								<span class="error_mess">{{ $errors->first('subject_name') }}</span> @endif
							</div>
						</div>
					
						<div class="col-md-12">
							<div class="form-group">
								<label for="name">Add Media <span class="text-danger">*</span></label>
								<select id="media_data" name="type" class="form-control select" required>
                                        <option disabled selected value="">-Select-</option>
										<option value="1"  @if(isset($CalendarManagementEdit->type) && $CalendarManagementEdit->type == "1") selected @endif >Upload File </option>
                                        <option value="2"  @if(isset($CalendarManagementEdit->type) && $CalendarManagementEdit->type == "2") selected @endif >Add Url </option>
                                                                             
                                </select>	
								
								<div class="invalid-feedback">
									Please select media type.
								</div>
								@if ($errors->has('type'))
								<span class="error_mess">{{ $errors->first('type') }}</span> @endif
							</div>
						</div>
                   
						<div class="col-md-12">

						<?php
						if(isset($CalendarManagementEdit->type) && $CalendarManagementEdit->type==1){ ?>
						<div class="row">
						<div class="col-md-4">
                                <div class="form-group">
                                    <label for="Enter Category">Upload Attachment <span class="text-danger">*</span></label>
                                    <input type="file" id="upload_attachment" name="media_data_upload" class="form-control" />
                                    <span class="note">(File Format: JPEG/JPG/PDF)</span>
									
                                </div>
						</div>
								<div class="col-md-4">
								@if ($CalendarManagementEdit->media_data)
								<a target="_blank" href="{{ asset('public/calendar_management/media_data/'.$CalendarManagementEdit->media_data) }}" class="btn btn-primary btn-xs"><span class="fa fa-download"></span></a>
									@else
									NA
									@endif
									<input type="hidden" id="media_data" name="media_data_hidden" value="{{$CalendarManagementEdit->media_data}}" />
                            </div>
						</div>
						<?php }else{ ?>

						<div class="col-md-12" id="upload_attachment_data">
                                <div class="form-group">
                                    <label for="Enter Category">Upload Attachment <span class="text-danger">*</span></label>
                                    <input type="file" id="upload_attachment" name="media_data_upload" class="form-control" />
                                    <span class="note">(File Format: JPEG/JPG/PDF)</span>
									<div class="invalid-feedback">
									Please upload attachment.
								</div>
								@if ($errors->has('upload_attachment'))
								<span class="error_mess">{{ $errors->first('upload_attachment') }}</span>@endif
                                </div>
                            </div>
							<?php } ?>
						</div>
					
						
                    <?php
						if(isset($CalendarManagementEdit->type) && $CalendarManagementEdit->type==2){ ?>
						<div class="col-md-12">
							<div class="form-group">
								<label for="Enter Category">Link <span class="text-danger">*</span></label>
								<input type="url" id="url_link"  @if(isset($CalendarManagementEdit->media_data)) value="{{$CalendarManagementEdit->media_data}}" @endif name="media_data_url" class="form-control" />
								<div class="invalid-feedback">
								Please Provide Link.
							</div>
							@if ($errors->has('media_data'))
							<span class="error_mess">{{ $errors->first('media_data') }}</span>@endif
							</div>
						</div>
						<?php }else{ ?> 

						<div class="col-md-12" id="url_data">
                                <div class="form-group">
                                    <label for="Enter Category">Link <span class="text-danger">*</span></label>
                                    <input type="url" id="url_link" name="media_data_url" class="form-control" />
                                    <div class="invalid-feedback">
									Please Provide Link.
								</div>
								@if ($errors->has('media_data'))
								<span class="error_mess">{{ $errors->first('media_data') }}</span>@endif
                                </div>
                            </div>
							<?php } ?>
				


					
						<div class="col-md-12">
							<div class="form-group">
								<div class="mb-3">
									<label>Remarks (if any)</label>
									<textarea class="form-control"  rows="3" id="remarks" name="remarks">@if(isset($CalendarManagementEdit->remarks)) {{$CalendarManagementEdit->remarks}} @endif</textarea>
								<div class="invalid-feedback">
									Please provide remarks name.
								</div>
								@if ($errors->has('remarks'))
								<span class="error_mess">{{ $errors->first('remarks') }}</span> @endif								
								</div>
							</div>
						</div>
						
						<div class="col-md-2 d-grid">
							<label class="form-label">&nbsp;</label>
							<button class="btn btn-primary form-group" type="submit">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


@endsection
@push( 'custom-scripts' )
<script type="text/javascript">
//upload
   $(function() {
    $('#upload_attachment_data').hide(); 
	$('#url_data').hide();
    $('#media_data').change(function(){
        if($('#media_data').val() == '1') {
            $('#upload_attachment_data').show();
			$("#upload_attachment").prop('required', true);
			$('#url_link').prop('required', false);
			$('#url_data').hide();
        } else if($('#media_data').val() == '2'){
			$('#upload_attachment_data').hide();
			$("#upload_attachment").prop('required', false);
			$('#url_data').show();
			$('#url_link').prop('required', true);

		}else {
            $('#upload_attachment_data').hide(); 
			$('#url_data').hide();
			$('#url_link').prop('required', false);
			$("#upload_attachment").prop('required', false);
        } 
    });
});

// function getfileextdoc(value, id) {


// var fileExtension = ["pdf"];
// var file_size = value.files[0].size;

// var filevalue = value.value;
// if (
//     $.inArray(filevalue.split(".").pop().toLowerCase(), fileExtension) == -1
// ) {
//     $("#File" + id).val("");
//     $("#sign").attr("src", "");
//     error("Please Upload File in pdf Format.");
// } else if (file_size > 200000) {
//     $("#File" + id).val("");
//     $("#sign").attr("src", "");
//     error("File Size should not exceed 200kb.");
// } 

// }

$(document).ready(function() {
              $('#upload_attachment').bind('change', function() {
                      const file_size = this.files[0].size;
                      const file = Math.round(1 * 1024 * 1024);
                        //alert(file);
                    //   if (file_size > 2097152) {
                    //           $('#upload_attachment').val('');
                    //            alert("Uploaded file size should be less than 2 MB.");
                    //    }
                      myfile = $(this).val();
                      var ext = myfile.split('.').pop();
                      if (ext == "pdf" || ext == "jpeg" || ext == "jpg") {} else {
                              $('#upload_attachment').val('');
                      }
              });
      });
</script>
@endpush
