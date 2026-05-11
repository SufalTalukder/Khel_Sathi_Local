@if($message = session()->get('success'))
<script type="text/javascript">
    success("{{ $message }}");
</script>
@endif
@if($message = session()->get('error'))
<script type="text/javascript">
    error("{{ $message }}");
</script>
@endif
@if($message = session()->get('warning'))
<script type="text/javascript">
    warning("{{ $message }}");
</script>
@endif
@if($message = session()->get('info'))
<script type="text/javascript">
    info("{{ $message }}");
</script>
@endif


@if(session()->has('success_marked'))
<script type="text/javascript">
Swal.fire({
  position: 'top-end',
//   icon: 'success',
  title: "{{session()->get('success_marked')}}",
  showConfirmButton: false,
  timer: 1500
})
</script>
 @endif

<div class="modal fade" id="query_form_reply" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabels" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="prodiv">
        <div class="modal-content" id="query_form_reply_append">
            
        </div>
    </div>
</div>


<div class="modal fade" id="query_form_iamge" aria-labelledby="exampleModalLabels" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="query_form_image_append">
             
        </div>
    </div>
</div>
