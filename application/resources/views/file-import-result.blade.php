@extends('layouts/admin_layout')
@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">
            Darpan Import Data
        </h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-5">
                    <div class="card-body">
                        <form action="{{ route('hostel_update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                                <div class="custom-file text-left">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div> -->
                           
                            <div class="form-group">
                                <label >Import Data</label>
                                <input type="file" name="file"  class="form-control" required />
                            </div>
                            <button class="btn btn-primary">Import data</button>
                        
                        </form>
                    </div>
                    <div class="ms-2 mb-2 text-danger">Note: You have to upload only diffrence data (current month data).</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
<script>
    $(".formm").css("display", "none");
   function form_type(id){
    $(".formm").css("display", "none");
$('#type' + id ).css("display", "block");
    }
</script> 
@endpush

