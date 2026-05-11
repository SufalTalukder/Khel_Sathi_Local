@extends( 'layouts/darpan_nav' )
@section( 'content' )




	<div class="pageheader">
				<h4 class="mb-0">Darpan Count</h4>
			</div>







        <div class="card">
        <div class="card-body">
            <form action="{{ url('trial_import') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
             @csrf
             <div class="row mt-1">
                 <div class="col-md-6">
                     <div class="form-group">

                         <label for="name">Import File</label>
                         <input type="file" class="form-control"  name="file" required>

                     </div>
                 </div>

             </div>

             <input class="btn btn-primary btn-sm my-3" type="submit" value="Submit">
            </form>

         </div>





	</div>



@endsection
