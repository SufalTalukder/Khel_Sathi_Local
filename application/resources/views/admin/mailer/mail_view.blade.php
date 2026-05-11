@extends( 'layouts/admin_layout' )
@section( 'content' )
<style>
    .displayReply{
        display: none;
    }
</style>


<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">Mail View </h4>
</div>
<div class="card mb-3">

	<div class="card-body">
    <p><strong>Subject :</Strong> {{ $mail_composer->subject}}</p>

         {!! $mail_composer->message !!}
         <div class="row">

         @if(count($admin_mail_attachment) > 0)

         @foreach ($admin_mail_attachment as $item)


    <div class="col-md-1">
        <a href="{{asset('mail/attachment/'.$item->attachment )}}" download><img src="{{asset('assets_admin/images/paperclip.png' )}}" alt="" srcset=""></a>
        <div>

        </div>
    </div>
         @endforeach

         @endif
</div>
<br>
         <p><strong>From :</Strong> {{ admin_name($mail_composer->created_by) }}
         <br>
         <strong> Date :</Strong> {{ dmyhi($mail_composer->created_on) }}</p>

	</div>


    @if ($composer->reply)
    <div class="card-body m-2" style="background-color: rgb(238, 238, 238)">
        <p><strong>Reply :</strong>
    {!! $composer->reply !!}



    <div class="row">

        @if(count($reply_attachment) > 0)

        @foreach ($reply_attachment as $item)


   <div class="col-md-1">
       <a href="{{asset('mail/attachment/'.$item->attachment )}}" download><img src="{{asset('assets_admin/images/paperclip.png' )}}" alt="" srcset=""></a>
       <div>

       </div>
   </div>
        @endforeach

        @endif
    <p><strong> Date :</Strong> {{ dmyhi($composer->reply_on) }}</p>

    </div>
    @else

    <div class="m-3"><a href="javascript:void(0)"  class="btn btn-primary "  onclick="displayReply()"><i class="fa fa-reply" aria-hidden="true"></i> Reply</a>

    @endif
</div>
   </div>

<div class="card mb-3 displayReply" id="replyBox">

	<div class="card-body">
		<form action="{{ route('mail_reply')}}" class="needs-validation" id="add_name3" method="post" autocomplete="off" novalidate enctype="multipart/form-data">
		@csrf

<div class="row">

	<div class="col-md-12 TEMPLATE_CONMTENT" >
        <input type="hidden" name="id" value="{{$composer->id}}">
		<div class="form-group">
			<label for="TEMPLATE_CONMTENT" class="placeholder"> Reply </label>
			<textarea cols="8" name="reply" rows="5"  class="form-control ckeditor  mt-2" id="IdOfCKEditorTextArea" required>@if (isset($composer->subject)) {!! $composer->subject !!} @endif</textarea>
		</div>
	</div>

    	<div class="col-md-5">
						<div class="form-group mt-2">
							<label for="IMPORT FILE" class="placeholder"> ATTACHMENT</label>
							<input id="file" type="file" class="form-control  mt-2 " multiple="multiple" name="attachment[]">
						</div>
					</div>

                </div>

			<div class="col-md-5">
				<button class="btn btn-primary"  id="sub_button" type="submit"> Submit </button>
			</div>
		</form>
	</div>
</div>



@endsection

@push( 'custom-scripts' )
<script type="text/javascript" src="{{ url('ckeditor/ckeditor.js') }}"></script>
<script>
    function displayReply(){
$('#replyBox').toggleClass("displayReply")
    }




$("#add_name3").submit(function (e) {
e.preventDefault();
if ($("#add_name3")[0].checkValidity() === false) {
    e.stopPropagation();
} else {

    for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }

    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function (res) {
            if (res.error == false) {
                success(res.msg);

                window.location.href = res.url;


            } else {
                error(res.msg);
            }
        },
    });
}
$("#add_name3").addClass("was-validated");
});

</script>

@endpush
