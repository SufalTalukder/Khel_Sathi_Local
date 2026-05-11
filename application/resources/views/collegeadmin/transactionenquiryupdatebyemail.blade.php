@extends( 'layouts/admin_layout' )
@section( 'content' )
    <div class="pageheader" id="menu-margin">
	<h4 class="mb-0"> Update Transaction Payment Status

</div>
		<div class="card">

			<div class="card-body">
				<div class="row">
				<form action="{{route('transactionenquirystorebyemail')}}" method="post">
                    @csrf
                    <input type="text" name="clientTxnID" id="">
                     &nbsp;<button type="submit">Submit</button>
                </form>
				</div>
			</div>
		</div>
	

@endsection
