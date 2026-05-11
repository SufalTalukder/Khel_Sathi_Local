<!DOCTYPE html>
<html>

<head>
	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-NKD3W5D5');
	</script>
	<!-- End Google Tag Manager -->
	<title>Admin - Official Web Portal of Department of Sports, Government of Uttar Pradesh, India</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="{{ url('/public') }}">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="{{ url('admin') }}/css/select2.min.css" rel="stylesheet" media="all" />
	<link rel="stylesheet" type="text/css" href="https://hinkhoj.com/common/css/keyboard.css" />
	<script type="text/javascript" src="{{ asset('assets_admin/js') }}/keyboard.js"></script>
	<style>
		.contentwraper {
			padding-top: 50px;
			padding-bottom: 80px;
		}
		/* Active Menu Indicator */
		.navsidebar a.active {
			background: #dc4c8f15 !important;
			color: #dc4c8f !important;
			border-left: 3px solid #dc4c8f;
			font-weight: 700 !important;
		}
		/* .sub-menu li a.active {
			padding-left: 37px !important;
		} */
	</style>
	<script type="text/javascript" src="{{ url('admin') }}/js/jquery-min.js"></script>
</head>

<body class="dashbg">
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKD3W5D5"
			height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<div class="contentwraper menumarginleft">
		<x-adminnav />
		<div class="container-fluid pagecontentbody">
			<div class="tab-content">
				<div class="pagebody removebg-color">
					@yield('content')
				</div>
			</div>
		</div>
		<footer>
			<!--For Reject Application-->
			<div class="modal fade" id="reject" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Reject Application</h5>
							<!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
						</div>
						<form id="formReject" action="{{route('collegeadminrejected')}}" method="post">
							@csrf
							<div class="modal-body">
								<h3 class="text-center">Are you sure to Reject the Application? Action once taken cannot be reverted.</h3>
								<input type="hidden" name="user_id" value="@if(isset($data) && isset($data->user_id) ) {{$data->user_id}}@endif">
								<div class="form-group">
									<label class="placeholder">Remark</label>
									<textarea required name="comment" rows="1" class="form-control" cols="40"></textarea>
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
			<div class="modal fade" id="accept" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Accept Application</h5>
							<!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
						</div>
						<form id="formAccept" action="{{route('collegeadminaccepted')}}" method="post">
							@csrf
							<div class="modal-body">
								<h3 class="text-center">Are you sure to Accept the Application? Action once taken cannot be reverted.</h3>
								<input type="hidden" name="user_id" value="@if(isset($data) && isset($data->user_id) ) {{$data->user_id}}@endif">
								<div class="form-group">
									<label class="placeholder">Remark</label>
									<textarea name="comment" rows="1" class="form-control" cols="40" required></textarea>
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
			<div class="row">
				<div class="col-md-8">
					<ul class="foot-list">
						<li>Copyright &copy Department of Sports</li>
					</ul>
				</div>
				<div class="col-md-4">
					<!-- <ul class="foot-list float-end">
						<li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a>
						</li>
					</ul> -->
				</div>
			</div>
		</footer>
	</div>


	@yield('modal_content')
	<script>
		var ajaxUrl = "{{ url('') }}";
	</script>

	<script type="text/javascript" src="{{ url('admin') }}/js/bootstrap.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/jquery.nanoscroller.min.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/dataTables.bootstrap5.min.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/datepicker.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/datepicker.en.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/builder.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/beautifyhtml.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/dragble.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/theme-script.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/toast.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/custom.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/sweetalert.min.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/chart.js"></script>
	<script type="text/javascript" src="{{ url('admin') }}/js/select2.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
	<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>


	<script type="text/javascript">

	</script>
	<x-message />
	@stack('custom-scripts')
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
		$(document).ready(function() {
			setTimeout(function() {
				$('#hide_data').hide();
			}, 2500);
		});
	</script>
	<x-modal />

	<script>
		function PrintExce(name) {
			$("#dataTable").table2excel({
				filename: name + ".xls",
				exclude: ".noprint",
			});
		};
	</script>


</body>

</html>
