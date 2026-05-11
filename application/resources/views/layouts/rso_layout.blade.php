<!doctype html>
<html>

<head>
	    <!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NKD3W5D5');</script>
    <!-- End Google Tag Manager -->

	<title>Hostel Panel - Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="favicon.png" />
	<link href="{{ asset('admin') }}/css/bootstrap.css" rel='stylesheet' />
	<link href="{{ asset('admin') }}/css/font.css" rel='stylesheet' />
	<link href="{{ asset('admin') }}/css/login.css" rel='stylesheet' />
	<link href="{{ asset('admin') }}/css/all.css" rel="stylesheet" />
	<link href="{{ asset('admin') }}/css/dataTables.bootstrap5.min.css" rel='stylesheet' />
	<link href="{{ asset('admin') }}/css/custom_theme.css" rel='stylesheet' />
	<link href="{{ asset('admin') }}/css/draggle.css" rel="stylesheet">
	<link href="{{ asset('admin') }}/css/responsive.css" rel='stylesheet' />
	<link href="{{ asset('admin') }}/css/datepicker.css" rel="stylesheet" media="all" />
	<link href="{{ asset('admin') }}/css/toast.css" rel='stylesheet' />
	<link href="{{ asset('admin') }}/css/default.css" rel='stylesheet' />

	<link href="{{ url('admin') }}/css/select2.min.css" rel="stylesheet" media="all" />
	<script type="text/javascript" src="{{ url('admin') }}/js/jquery-min.js"></script>

	<style>
		.menumarginleft {
			margin-left: 0;
		}

		.menuheader-width {
			left: 0;
		}
	</style>
</head>

<body class="dashbg">
	<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKD3W5D5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<div class="contentwraper">

		<x-rsonav />

		<div class="container pagecontentbody">
			<div class="tab-content">
				<div class="pagebody removebg-color">
					@yield('content')

				</div>
			</div>
		</div>



		<div class="modal fade" id="query_marked_hostel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Raise Query</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{route('mark_query_hostel')}}" method="post" enctype="multipart/form-data" class="" >
						@csrf
						<div class="modal-body">
							<div class="row">
								<div class="col-90">
									<div class="form-group">
										<input type="hidden" name="formID" value="@isset($userDetails){{$userDetails->id}} @endisset">
										<input type="hidden" name="formType" value="7">
										<div class="form-group">
											<label class="placeholder">Subject </label>
											<input name="query_subject" required pattern="^[A-Za-z -]+$" value="{{old('bank_name') }}" type="text" class="form-control">
										</div>
										<div class="form-group">
											<label class="placeholder">Query Remark <span class="text-danger">*</span></label>
									

                                            <input name="is_mark_query" required pattern="^[A-Za-z -]+$" id="is_mark_query" type="text" class="form-control">
									
										</div>
										<div class="form-group">
											<label>Query Related Document</label>
											<div class="input-group">
												<input type="file" name="query_doc" class="form-control" onchange="getfileext(this.value,10)" id="File10" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
											</div>
											<span class="note">(File Format: JPEG/JPG/PDF | Max File Size: 2 MB)</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-info" data-bs-dismiss="modal">Back</button>
							<button type="submit" class="btn btn-success">Raise Query</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!--payment accept model-->
		<div class="modal fade" id="payment_varify_hostel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Payment Varify</h5>
						<!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
					</div>
					<form action="{{route('payment_varify_accept')}}" method="post">
						@csrf
						<div class="modal-body">
							<h3 class="text-center">Are you sure to Verify the Payment? Action once taken cannot be reverted.</h3>
							<input type="hidden" name="user_id" value="@isset($userDetails){{$userDetails->id}} @endisset">

							<div class="form-group">
								<label class="placeholder">Remark <span class="text-danger">*</span></label>
								<input type="text" name="remark" maxlength="255" class="form-control"  required></textarea>
							</div>
							<div class="form-group">
							<select class="form-control form-select" name="payment_status" required>
								<option value="">--Choose Payemt Status--</option>
										<option value="2">Accept</option>
										<option value="3">Reject</option>
						    </select>
							</div>

						</div>
						<div class="modal-footer">
							<!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
							<button type="submit" class="btn btn-info">Yes</button>
							<button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<!--endpayment-->


		<!--For Reject Application-->
		<div class="modal fade" id="rejectHostel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Reject Application</h5>
						<!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
					</div>
					<form action="{{route('hostel_reject')}}" method="post">
						@csrf
						<div class="modal-body">
							<h3 class="text-center">Are you sure to Reject the Application? Action once taken cannot be reverted.</h3>
							<input type="hidden" name="user_id" value="@isset($userDetails){{$userDetails->id}} @endisset">

							<div class="form-group">
								<label class="placeholder">Remark</label>
								<textarea required name="remark" rows="3" class="form-control" cols="40"></textarea>
							</div>
						</div>

						<div class="modal-footer">
							<!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
							<button type="submit" class="btn btn-info">Yes</button>
							<button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<!--For Submit Application-->
		<div class="modal fade" id="acceptHostel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Accept Application</h5>
						<!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
					</div>
					<form action="{{route('hostel_accept')}}" method="post">
						@csrf
						<div class="modal-body">
							<h3 class="text-center">Are you sure to Accept the Application? Action once taken cannot be reverted.</h3>
							<input type="hidden" name="user_id" value="@isset($userDetails){{$userDetails->id}} @endisset">

							<div class="form-group">
								<label class="placeholder">Remark</label>
								<textarea name="remark" rows="3" class="form-control" cols="40" required></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
							<button type="submit" class="btn btn-info">Yes</button>
							<button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		@foreach ($mark_query as $key=>$item)
		<div class="modal fade" id="query_marked_reply{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Reply Query</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="{{route('query_hostel_reply')}}" method="post" enctype="multipart/form-data" class="directMarkQuery needs-validation" novalidate>
						@csrf
						<div class="card">
							<div class="card-body">
								<div class="col-90">
									<div class="form-group">
										<input type="hidden" name="queryIdReply" id="queryIdReply" value="{{$item->id}}">
										<input type="hidden" name="queryReplyTo" value="{{$userDetails->id}}">
										<div class="form-group">

											<label class="placeholder">Details <span class="text-danger">*</span></label>

										</div>
										<div class="form-group">
											<label>Documents</label>
											<div class="input-group">
												<input type="file" name="query_doc" class="query_doc_image_reply form-control" onchange="getfileext(this.value,10{{$item->id}})" id="File10{{$item->id}}" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
											</div>
											<span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
										</div>
										<button type="button" class="btn btn-info mt-2" data-bs-dismiss="modal">Back</button>
										<button type="submit" class="btn btn-success mt-2">Reply</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		@endforeach



		@foreach ($mark_query as $key=>$item)

		<div class="modal fade" id="query_marked_detail{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Query Details</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<table id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
						<thead>
							<tr>
								<th>S.No.</th>
								<th>Details</th>
								<th>Document</th>
								<th>Date</th>
								<th>Reply To</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($item->queryReplies as $key=>$reply)


							<tr>
								<td>
									{{$key + 1}}
								</td>
								<td>
									{{$reply->reply}}
								</td>
								<td>
									<a href="<?= url('public/queryDoc') . '/' . $reply->reply_doc; ?>" target="_blank">
										<div class="btn btn-success">Document</div>
									</a>
								</td>

								<td><?= dmy($reply->trans_date); ?></td>

								<td> @if($reply->reply_type == 1)
									Admin

									@else
									User
									@endif

								</td>

							</tr>
							@endforeach

						</tbody>

					</table>
				</div>
			</div>

		</div>


		@endforeach




		<x-modal />


		<footer>
			<div class="row">
				<div class="col-md-8">
					<ul class="foot-list">
						<li>Copyright &copy; Department of Sport, Government of Uttar Pradesh</li>
					</ul>
				</div>
				<div class="col-md-4">
					<ul class="foot-list float-end">
						<li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a>
						</li>
					</ul>
				</div>
			</div>
		</footer>
	</div>





	<script>
		var ajaxUrl = "{{ url('') }}";
	</script>

	<script type="text/javascript" src="{{ url('admin') }}/js/bootstrap.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/jquery.nanoscroller.min.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/dataTables.bootstrap5.min.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/builder.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/beautifyhtml.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/dragble.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/datepicker.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/datepicker.en.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/select2.min.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/theme-script.js"></script>

	<script src="{{ url('admin') }}/js/canvasjs.min.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/toast.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/custom.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<x-message />
	<script>
		$('#aprvbtn').click(function() {
			swal({
				title: "Successful!",
				text: "Request is Approved Successfully",
				icon: "success",
				button: "OK",
			});
		});
		$('#cnfreject').click(function() {
			swal("Are you sure you want to do this?", {
				buttons: ["No", true],
			});
		});
	</script>
	<script>
		$(".toggle-password").click(function() {
			$(this).toggleClass("fa-eye fa-eye-slash");
			var input = $($(this).attr("toggle"));
			if (input.attr("type") == "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
		$('body,html').click(function(e) {

			// if ($(".sidebar ").hasClass("sidebar-width") ) {
			// alert($("sidebar").length );
			// $(".sidebar").removeClass("sidebar-width");
			// $(".header").removeClass("header-width");
			// }
		});
	</script>

	<script>
		$(document).ready(function() {
			$('.show_data_id').click(function() {
				var idd = $(this).data('id');
				console.log(idd)
				$('.financial_forward').val(idd);
			});
		});
	</script>

	<script>
		$(document).ready(function() {
			$('.show_released_id').click(function() {
				var idd = $(this).data('id');
				$('.financial_released').val(idd);
			});
		});
	</script>

	<script>
		$(document).ready(function() {
			setTimeout(function() {
				$('#hide_data').hide();
			}, 2500);
		});
	</script>

	@stack('custom-scripts')

</body>


</html>
