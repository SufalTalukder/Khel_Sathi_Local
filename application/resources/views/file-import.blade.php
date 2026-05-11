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
                        <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                                <div class="custom-file text-left">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label style="width: 100%;">Form Type 
                                <a id="type1" download="Sample of Laxman/Laxmi Bai Award" href="{{ asset('darpan_sample/sample_excel_of_award.xlsx') }}" class="btn btn-success bg-success btn-sm float-end formm text-white"><span class="icon icon-cloud-download"></span> Sample Export</a>
                                <a id="type2" download="Sample of Position Holder" href="{{ asset('darpan_sample/sample_excel_of_position_holder.xlsx') }}" class="btn btn-success bg-success btn-sm float-end formm text-white"><span class="icon icon-cloud-download"></span>  Sample Export</a>
                                <a id="type3" download="Sample of Financial Assistance/Monthly Pension" href="{{ asset('darpan_sample/sample_excel_of_finance.xlsx') }}" class="btn btn-success bg-success btn-sm float-end formm text-white"><span class="icon icon-cloud-download"></span>  Sample Export</a>
                                <a id="type4" download="Sample of Direct Recruitment" href="{{ asset('darpan_sample/sample_excel_of_direct_recruitment.xlsx') }}" class="btn btn-success bg-success btn-sm float-end formm text-white"><span class="icon icon-cloud-download"></span>  Sample Export</a>
                                    
                                </label>
                                <select onchange="form_type(this.value)" class="form-control" name="type" required>
                                    <option value="">Select form for Sample Excel</option>
                                    <option value="1">Laxman/Laxmi Bai Award</option>
                                    <option value="2">Position Holder</option>
                                    <option value="3">Financial Assistance/Monthly Pension </option>
                                    <option value="4">Direct Recruitment</option>
                                </select>
                            </div>
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

