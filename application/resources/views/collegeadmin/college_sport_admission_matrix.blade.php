@extends( 'layouts/admin_layout' )
@section( 'content' )
			<div class="pageheader" id="menu-margin">
				<h4 class="mb-0">
	College Sports Admission Matrix

					
					</h4>


			</div>






            <div class="card mb-3">
	<div class="card-body">
		<form action="{{ route('college_sport_admission_matrix') }}" class="needs-validation" novalidate method="post" autocomplete="off" id="matric_detail" >
			@csrf
			<div class="row">


            <div class="col-md-2 mt-1">
					<div class="form-group">
						<label for="name">Class *</label>
						<select class="form-control" id="class" name="class"  required="">
                        <option  value="">Select Class</option>
							<option  value="6th">6th</option>
                            <option  value="7th">7th</option>
                            <option  value="8th">8th</option>
                            <option  value="9th">9th</option>
                   
						
						</select>
					</div>
				
				</div>
            <div class="col-md-2 mt-1">
					<div class="form-group">
						<label for="name">Sport *</label>
						<select class="form-control" id="sport" name="sport"  onchange="sporttype(this.value)" required="">
							<option  value="">Select Sport</option>
							@foreach($sports as $key=>$item)
							<option value="{{ $item->id }}" data-badge="">{{$item->name}}</option>
							@endforeach
						</select>
					</div>
				
				</div>





                <div class="col-md-2 mt-1">
					<div class="form-group">
						<label for="subsport">Sub Sport </label>
						<div id="list1" class="dropdown-check-list">
							<select name="subsport" id="dropdownid" class="form-select">
							</select>
						</div>
					</div>
				</div>







			
				<div class="col-md-2 mt-1">
					<div class="form-group">
						<label for="name">College *</label>
						<select class="form-control" id="college" name="college" value="{{ old('college') }}" required="">
							<option value="">Select College</option>
							@foreach($college as $key=>$item)
							<option value="{{ $item->id }}">{{$item->college_name}}</option>
							@endforeach
						</select>
					</div>
				
				</div>
			
                <div class="col-md-2 mt-1">
					<div class="form-group">
						<label for="name">Gender *</label>
						<select class="form-control" id="gender" name="gender" required="">
							<option value="">Select Gender</option>
                            <option value="1">Male</option>
                            
                            <option value="2">Female</option>
                            

						</select>
					</div>
				
				</div>

                <div class="col-md-2 mt-1">
					<div class="form-group">
						<label for="name">Seats *</label>
                        <input type="number" name="seats" min="1" class="form-control" required> 
					</div>


                    </div>







				<div class="col-md-2 d-grid">
					<label class="form-label">&nbsp;</label>
					<button class="btn btn-primary form-group" type="submit">Submit/दर्ज करे</button>
				</div>
			</div>
		</form>
	</div>
</div>















			<div class="card">
				<div class="card-body">

					<div class="table-responsive table-bordred">
						<table  id="dataTable" class="table table_new datatable table-bordred table-hover bg-white">
							<thead>
								<tr>
									<th>S.No.</th>
                                    <th>Class</th>
						          <th>Sport</th>
									<th>Sub-sport</th>
                                    <th>College</th>
                                    <th>Gender</th>
                                    <th>Seats</th>
								</tr>
							</thead>
							<tbody>
                            @foreach ($online_admission_college_matrix as $key=>$item)
                            
                         
                            <tr>
                                <td>
                                    {{ $key + 1}}
                                </td>
                                <td>
                                  {{ $item->class }}
                                </td>
                                <td>
                                  {{ $item->name }}
                                </td>
                                <td>
                                @if($item->sub_type)
                                {{ $item->sub_type }}
                              @else

                                NA
                              @endif
                          
                                </td>
                                <td>
                                {{ $item->college_name }}
                                </td>
                                <td>
                                    @if($item->gender == 1)
                              Male

                              @else

                             Female
                              @endif
                           </td>





                           <td>
                              {{ $item->seats }}
                           </td>
									
								</tr>

                                @endforeach
                               
                             </tbody>
								
							
						</table>
					</div>
				</div>
			</div>
	

@endsection

@push('custom-scripts')
<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>




function sporttype(sport) {
		var subsports_id = $("#sport").attr('data-subsport');
		$.ajax({
			type: "POST",
			url: "{{url('collegeadmin/get_subsport')}}",
			data: {
				sport
			},
			success: function(response) {


                if (response.sub_type.length > 0) {
                $('select[name="subsport"]').prop('required', true);
                } else {
                $('select[name="subsport"]').prop('required', false);
                }


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









    $("#matric_detail").submit(function(e) {
    e.preventDefault();

    if ($("#matric_detail")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
       
     



  
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {
                    if (res.error == false) {
       
                        success(res.msg);
                        window.location.href = res.url;
                    } else {
                        error(res.msg);
                    }
                },
            });
      
    }
    $("#matric_detail").addClass("was-validated");
});






    function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('dataTable');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Collegewise Count Report.' + (type || 'xlsx')));
    }
</script>
@endpush
