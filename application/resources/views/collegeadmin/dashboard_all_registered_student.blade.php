@extends( 'layouts/admin_layout' )
@section( 'content' )
<style>

.dn {
    display: none;
}

</style>

<div class="card">
	
</div>
<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">
		Application List

	
	</h4>
</div>
<div class="card">
	<div class="card-body">
		<div class="table-responsive" id="prodiv">

<table class="dn" style="
width: 100%;
">

    <tr>
        <th>
            <div
                style="padding: 0 15px 3px; margin-bottom: 10px; margin-top:10px; border-bottom: 2px solid #000; position: relative; line-height: 1;">
                <img src="{{ asset('') }}/assets_admin/images/logo.png"
                    style="width: 75px; height: auto; position: absolute; top: 0px; left: 20px;">
                <h1
                    style="text-align: center; font-size: 20pt; margin: 0px 0px 0px 0px; padding: 0px 0 0; color: #000;">
                    Sports Directorate, Govt. of Uttar Pradesh
                </h1>
                <h2
                    style="text-align: center; margin:3px 0px 10px 0px; font-size:11pt; padding: 0px; color:#000;">
                    Khel Bhawan Hazratganj Lucknow, Uttar Pradesh 226001
                </h2>
                <h5
                    style="text-align: center; margin:0px 0px 0px 0px; font-size:16pt; padding: 0px; color:#000;">
                   Khel Sathi Portal
                </h5>
            </div>

            <h6
            style="text-align: center; margin:0px 0px 0px 0px; font-size:14pt; padding: 0px; color:#000; ">
            Monitoring System
        </h6>
            <h6
                style="text-align: center; margin:0px 0px 15px 0px; font-size:12pt; padding: 0px; color:#000; text-decoration:underline;">
               Applicant List
            </h6>
        </th>
    </tr>
</table>




			<table id="dataTable" class="table table_new datatable table-bordred table-hover bg-white" >
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Registration No.</th>
                 
                        <th>Application No.</th>
						<th>Applicant Name</th>

                        <th> PEN No.</th>
                    
					
                        <th>Email</th>
						<th>Mobile</th>
						<th>Aadhar Number</th>
					
					
			

					
					</tr>
				</thead>
				<tbody>
					@if(!empty($registrations)) @foreach($registrations as $key=>$registration)
					<tr>
						<td>{{ $key+1 }}</td>
						<td>@if($registration->application_no){{ $registration->application_no }}@else NA @endif</td>
                        <td>@if($registration->enroll_no){{ $registration->enroll_no }}@else NA @endif</td>
					
						<td>@if($registration->fullname){{ $registration->fullname }}@else NA @endif</td>
					<td>@if($registration->pen_no){{ $registration->pen_no }}@else NA @endif</td>
               
				
                    <td>@if($registration->email){{ $registration->email }}@else NA @endif</td>
						<td>@if($registration->mobile){{ $registration->mobile }}@else NA @endif</td>
						<td>@if($registration->aadhar_no){{ $registration->aadhar_no }}@else NA @endif</td>
					
					
						
						
					</tr>
					@endforeach @endif
				</tbody>
			</table>
		</div>
	</div>
</div> 


@endsection

@push('custom-scripts')


















<div class="modal" id="exampleModalLabellllll" >
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Trial Division</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>



      

        </div>
    </div>
</div>
<script src=
"https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js">
    </script>
<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>

function changeTrial(id, trial_division){
    $("#exampleModalLabellllll").show();
    $("#user_id").val(id);
    $("#trial_division").val(trial_division);


}



















function closetrial(){
    $("#exampleModalLabellllll").hide();
}

	function ExportToExcel(type, fn, dl) {
		var elt = document.getElementById('dataTable');
		var wb = XLSX.utils.table_to_book(elt, {
			sheet: "sheet1"
		});
		return dl ?
			XLSX.write(wb, {
				bookType: type,
				bookSST: true,
				type: 'base64'
			}) :
			XLSX.writeFile(wb, fn || ('Application Details.' + (type || 'xlsx')));
	}



	function sporttype(sport) {
		var subsports_id = $("#sport").attr('data-subsport');
		$.ajax({
			type: "POST",
			url: "{{url('collegeadmin/get_subsport')}}",
			data: {
				sport
			},
			success: function(response) {

				var d = $('select[name="subsport"]').empty();
				$('select[name="subsport"]').append(
					'<option value="">Select Sub Sport</option>');
				$.each(response.sub_type, function(key, value) {
					$('select[name="subsport"]').append(
						`<option  ${value.id==subsports_id?'selected':''}   value="${value.id}"> ${value.sub_type} </option>`);
				});
			}

		})
	}


    function PrintDocc() {
        // let makepdf = document.getElementById("prodiv");
        // html2pdf().from(makepdf).save();
var toPrint = document.getElementById('prodiv');

var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

popupWin.document.open();

popupWin.document.write('<html><head><style>body{font-family:Arial; counter-reset: page;} .noprint, #dataTable_length, #dataTable_filter {display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:2px 3px; font-size: 10pt;} </style></head><body onload="window.print()">')

popupWin.document.write(toPrint.innerHTML);
popupWin.document.write('<div style="text-align:center; width:98%; font-size:9pt; padding:0px; position:fixed; bottom:0;">This is a Software Generated Report.</div></body></html>');
popupWin.document.close();



// $('.fa-download').text('Uploaded');
//     var toPrint = document.getElementById('prodiv');
//
//     var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');
//
//     popupWin.document.open();
//
//     popupWin.document.write('<html><head><style>body{font-family:Arial}  .intentbtn { display: table; width: 100%; margin-bottom: 10px; margin-top: 5px; background-image: url(../images/corner-1.png); background-position: right top; background-size: contain; min-height: 100px; } a{ text-decoration: none; } .bg-light{background-color: #dee2e6 !important; font-size: 14px !important;} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:4px 5px; font-size: 12px;}</style></head><body onload="window.print()">')
//
//     popupWin.document.write(toPrint.innerHTML);
//
//     popupWin.document.write('<div style="text-align:center; width:98%; font-size:9pt; padding:0px; position:fixed; bottom:0;">This is a Software Generated Report.</div></body></html>');
//
//     popupWin.document.close();
//     $('.fa-download').text('');
}

</script>
@endpush
