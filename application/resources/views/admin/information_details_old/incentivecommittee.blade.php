@extends( 'layouts/admin_layout' )
@section( 'content' )
<style>
   .nowraptd {
      white-space: nowrap;
   }

   .dn {
      display: none;
   }
</style>

<div class="row">
   <div class="col-12">
      <div class="pageheader" id="menu-margin">
         <h4 class="mb-0">
            प्रोत्साहन समिति प्रपत्र
            <a title="Print" class="btn btn btn-outline-success float-end" data-print="modal" onclick="PrintDoc()"><i class="icons icon-printer"></i> प्रिंट</a>
         </h4>
      </div>
   </div>
   <div class="col-12">
      <div class="card">
         <div class="card-body">
            <form action="{{url('admin/information/create_incentive')}}" class="needs-validation" novalidate method="post" autocomplete="off">
               @csrf
               <fieldset>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="placeholder">महीना <span class="text-danger">*</span></label>
                           <select name="month_name" id="month_name" class="form-control form-select" required>
                              <option disabled selected value="">-Select Month-</option>
                              <option value="1">January</option>
                              <option value="2">February</option>
                              <option value="3">March</option>
                              <option value="4">April</option>
                              <option value="5">May</option>
                              <option value="6">June</option>
                              <option value="7">July</option>
                              <option value="8">August</option>
                              <option value="9">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label class="placeholder">वर्ष <span class="text-danger">*</span></label>
                           <select name="year_name" id="year_name" class="form-control form-select" required>
                              <option disabled selected value="">-वर्ष चुनें-</option>
                              <option value="1">2023</option>
                              <option value="2">2024</option>
                           </select>
                        </div>
                        @error('year_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                     </div>
                     <?php if (!empty($district_id)) { ?>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label class="placeholder">प्रकार <span class="text-danger">*</span></label>
                              <div class="form-control">
                                 <div class=" form-check-inline">
                                    <input required class="form-check-input" type="radio" name="identified_the_department" id="department_yes" value="1">
                                    <label class="form-check-label mb-0" for="inlineCheckbox1">ज़िला</label>
                                 </div>
                                 <div class=" form-check-inline">
                                    <input required class="form-check-input" type="radio" name="identified_the_department" id="department_no" value="2">
                                    <label class="form-check-label mb-0" for="inlineCheckbox2">तहसील</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4" id="district_name_selected" style="display: none;">
                           <div class="form-group mb-3">
                              <label class="placeholder">जिले का नाम <span class="text-danger">*</span></label>
                              <select name="district_name" id="district_name" class="form-control form-select" required>
                                 @foreach($districts as $key=>$district)
                                 <option {{$district->id == 23 ? 'selected' : ''}} value="{{ $district->id }}" data-badge="">{{$district->city}}</option>
                                 @endforeach
                              </select>
                           </div>
                           @error('district_name')
                           <div class="text-danger">{{ $message }}</div>
                           @enderror
                        </div>
                        <div class="col-md-4" id="tehsil_name_selected" style="display: none;">
                           <div class="form-group mb-3">
                              <label class="placeholder">तहसील का नाम <span class="text-danger">*</span></label>
                              <select name="tehsil_name" id="tehsil_name" class="form-control form-select" required>
                                 <option selected="" disabled="" value="">तहसील का चयन करें</option>
                                 @foreach($tehsils as $key=>$tehsil)
                                 <option {{$tehsil->id == 561 ? 'selected' : ''}} value="{{ $tehsil->id }}" data-badge="">{{$tehsil->Tehsil_Name}}</option>
                                 @endforeach
                              </select>
                           </div>
                           @error('tehsil_name')
                           <div class="text-danger">{{ $message }}</div>
                           @enderror
                        </div>
                     <?php } ?>
                     <div class="col-md-4">
                        <div class="form-group mb-3">
                           <label class="placeholder">समिति गठन की तिथि <span class="text-danger">*</span></label>
                           <input type="date" max="<?php echo date("Y-m-d"); ?>" name="date_of_committee_formation" id="date_of_committee_formation" class="form-control" data-language="en" required>
                        </div>
                        @error('date_of_committee_formation')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-4">
                        <div class="form-group mb-3">
                           <label class="placeholder">समिति के पंजीकरण एवं नवीनीकरण की तिथि <span class="text-danger">*</span></label>
                           <input type="date" name="date_of_registration_renewal_committee" id="date_of_registration_renewal_committee" class="form-control" data-language="en" required>
                        </div>
                        @error('date_of_registration_renewal_committee')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                     </div>
                  </div>
               </fieldset>
               <fieldset>
                  <legend>बैंक खाता का पूर्ण विवरण</legend>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group mb-3">
                           <label class="placeholder">बैंक का नाम <span class="text-danger">*</span></label>
                           <input type="text" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" name="bank_name" id="bank_name" class="form-control" required>
                        </div>
                        @error('bank_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-4">
                        <div class="form-group mb-3">
                           <label class="placeholder">शाखा <span class="text-danger">*</span></label>
                           <input type="text" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" name="branch_name" id="branch_name" class="form-control" required>
                        </div>
                        @error('branch_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-4">
                        <div class="form-group mb-3">
                           <label class="placeholder">खाता संख्या <span class="text-danger">*</span></label>
                           <input type="number" name="ac_number" min="999999999" max="100000000000000000" id="ac_number" class="form-control" required>
                        </div>
                        @error('ac_number')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-4">
                        <div class="form-group mb-3">
                           <label class="placeholder">खाताधारक का नाम<span class="text-danger">*</span></label>
                           <input type="text" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" name="account_holder_name" id="account_holder_name" class="form-control" required>
                        </div>
                        @error('account_holder')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                     </div>
                     <div class="col-md-4">
                        <div class="form-group mb-3">
                           <label class="placeholder">आईएफएससी कोड <span class="text-danger">*</span></label>
                           <input type="text" name="ifsc_code" maxlength="14" id="ifsc_code" pattern="^[A-Za-z]{4}0[A-Z0-9a-z]{6}$" class="form-control" required>
                        </div>
                        @error('ifsc_code')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                     </div>
                  </div>
                  <div class="bhoechie-footer">
                     <div class="row justify-content-center">
                        <div class="col-md-2 d-grid">
                           <button id="reset" type="reset" class="btn btn-outline-danger rounded-pill">रीसेट</button>
                        </div>
                        <div class="col-md-2 d-grid">
                           <button type="submit" class="btn  btn-outline-info rounded-pill">सुनिश्चित करे</button>
                        </div>
                     </div>
                  </div>
                  <input type="hidden" name="division_id" id="division_id" value="{{!empty($division_id) ? $division_id : 'null' }}">
               </fieldset>
            </form>
            <div class="row">
               <div class="col-md-12">
                  <div class="table-responsive" id="prodiv">
                     <table style="width: 100%;" class="dn">
                        <tr>
                           <td align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                              <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                                 <!-- <img src="{{ url('onlineAdmission') }}/images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
                                 <!-- <img src="images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
                                 <div style="font-size: 18px; font-weight: bold;">
                                    खेल साथी पोर्टल
                                 </div>
                                 <div style="font-size: 14px; font-weight: bold;">
                                    उत्तर प्रदेश सरकार
                                 </div>
                                 <div style="font-size: 18px; font-weight: bold;">
                                    प्रोत्साहन समिति प्रपत्र
                                 </div>
                              </div>
                           </td>
                        </tr>
                     </table>
                     <table class="table table-bordered table-hover bg-white datatable mb-3" id="dataTable">
                        <thead>
                           <tr>
                              <th rowspan="2">क्र.सं.</th>
                              <?php if ($admin_id == 10) { ?>
                                 <th rowspan="2">जनपद का नाम</th>
                                 <th colspan="1" class="text-center">समिति के गठन / बैठक का दिनाँक</th>
                                 <th colspan="1" class="text-center"><strong>समिति के रजिस्ट्रेशन/नवीनीकरण की संख्या/दिनाँक</strong></th>
                                 <th colspan="1" class="text-center"><strong>बैंक खाता का पूर्ण विवरण</strong></th>
                              <?php } ?>
                              <?php if ($admin_id == 9) { ?>
                                 <th rowspan="2">जनपद का नाम</th>
                                 <th rowspan="2">तहसील का नाम</th>
                                 <th colspan="2" class="text-center">समिति के गठन / बैठक का दिनाँक</th>
                                 <th colspan="2" class="text-center">समिति के रजिस्ट्रेशन / नवीनीकरण की संख्या / दिनाँक</th>
                                 <th colspan="2" class="text-center">बैंक खाता का पूर्ण विवरण</th>
                              <?php } ?>
                           </tr>
                           <?php if ($admin_id == 10) { ?>
                              <tr>
                                 <th>मंडल स्तर</th>
                                 <th>मंडल स्तर</th>
                                 <th>मंडल स्तर</th>
                              </tr>
                           <?php } ?>
                           <?php if ($admin_id == 9) { ?>
                              <tr>
                                 <th>जनपद स्तर</th>
                                 <th>तहसील स्तर</th>
                                 <th>जनपद स्तर</th>
                                 <th>तहसील स्तर</th>
                                 <th>जनपद स्तर</th>
                                 <th>तहसील स्तर</th>
                              <?php } ?>
                              </tr>
                        </thead>
                        <tbody>
                           <?php
                           //print_r($incentiveCommittee); die;
                           // if(isset($incentiveCommittee[0]->division_id == null)){
                           // }
                           ?>
                           @foreach($incentiveCommittee as $key=>$item)
                           <tr>
                              <td>{{ $key+1 }}</td>
                              <?php if ($item->status == 0) { ?>
                                 <td>{{!empty(divisionName($item->division_id)) ? divisionName($item->division_id) : '-' }}</td>
                                 <td class="nowraptd">{{ !empty(date('d-m-Y', strtotime($item->date_of_committee_formation ))) ? date('d-m-Y', strtotime($item->date_of_committee_formation )): '-'}}</td>
                                 <td class="nowraptd">{{ date('d-m-Y', strtotime($item->date_of_registration_renewal_committee)) }}</td>
                                 <td><b>Bank Name: </b>{{isset($item->bank_name) ? $item->bank_name : '-' }}<br><b>Branch: </b>{{isset($item->branch_name) ? $item->branch_name : '-' }}<br><b>A/C Holder: </b>{{isset($item->account_holder_name) ? $item->account_holder_name : '-' }}</td>
                              <?php } ?>
                              <?php //1 District
                              if ($item->status == 1) { ?>
                                 <td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }} </td>
                                 <td>-</td>
                                 <td class="nowraptd">{{ !empty(date('d-m-Y', strtotime($item->date_of_committee_formation ))) ? date('d-m-Y', strtotime($item->date_of_committee_formation )): '-'}}</td>
                                 <td>-</td>
                                 <td class="nowraptd">{{ date('d-m-Y', strtotime($item->date_of_registration_renewal_committee)) }}</td>
                                 <td>-</td>
                                 <td><b>Bank Name: </b>{{isset($item->bank_name) ? $item->bank_name : '-' }}<br><b>Branch: </b>{{isset($item->branch_name) ? $item->branch_name : '-' }}<br><b>A/C Holder: </b>{{isset($item->account_holder_name) ? $item->account_holder_name : '-' }}</td>
                                 <td>-</td>
                              <?php } ?>
                              <?php
                              //2 tehsil name
                              if ($item->status == 2) { ?>
                                 <td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }}</td>
                                 <td>{{!empty(tehsiltName($item->tehsil_id)) ? tehsiltName($item->tehsil_id) : '-' }}</td>
                                 <td>-</td>
                                 <td class="nowraptd">{{ date('d-m-Y', strtotime($item->date_of_committee_formation ))}}</td>
                                 <td>{{isset($item->division_id) ? $item->division_id : '-' }}</td>
                                 <td class="nowraptd">{{ date('d-m-Y', strtotime($item->date_of_registration_renewal_committee)) }}</td>
                                 <td>-</td>
                                 <td><b>Bank Name: </b>{{isset($item->bank_name) ? $item->bank_name : '-' }}<br><b>Branch: </b>{{isset($item->branch_name) ? $item->branch_name : '-' }}<br><b>A/C Holder: </b>{{isset($item->account_holder_name) ? $item->account_holder_name : '-' }}</td>
                              <?php } ?>
                              <!-- <td>{{ $item->ac_number}}</td>
                                 <td>{{ $item->ifsc_code}}</td> -->
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
@push( 'custom-scripts' )
<script>
   function PrintDoc() {
      $('#dataTable').DataTable().destroy();
      var toPrint = document.getElementById('prodiv');

      var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

      popupWin.document.open();

      popupWin.document.write('<html><title>::Preview::</title><head><style>body{font-family:Arial} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:3px 5px; font-size: 12px;} .table > thead > tr > th{background-color: #eee;}</style></head><body onload="window.print()">')

      popupWin.document.write(toPrint.innerHTML);

      popupWin.document.write('</body></html>');

      popupWin.document.close();

      $('#dataTable').DataTable();

   }
</script>
<script type="text/javascript">
   $(function() {
      var table = $('.yajra-datatable').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{ route('projectlist') }}",
         columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
         }, {
            data: 'fullname',
            name: 'fullname'
         }, {
            data: 'project_id',
            name: 'project_id'
         }, {
            data: 'project_name',
            name: 'project_name'
         }, {
            data: 'application_date',
            name: 'application_date'
         }, {
            data: 'current_status',
            name: 'current_status',
            orderable: false,
            searchable: false
         }, {
            data: 'view',
            name: 'view',
            orderable: false,
            searchable: false
         }, ]
      });
   });
</script>
<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>
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
         XLSX.writeFile(wb, fn || ('Incentive Committee List.' + (type || 'xlsx')));
   }
</script>
<script type="text/javascript">
   $('input[name="identified_the_department"]').click(function() {
      var identified_the_department = $(this).val();
      if (identified_the_department == 1) {
         $('#district_name_selected').show();
         $('#tehsil_name_selected').hide();
         $("#district_name").prop('required', true);
         $("#tehsil_name").prop('required', false);
      } else if (identified_the_department == 2) {
         $('#tehsil_name_selected').show();
         $('#district_name_selected').hide();
         $("#district_name").prop('required', false);
         $("#tehsil_name").prop('required', true);
         //$("#um_land_remarks").prop('required', false);
      }
   });
</script>
<script type="text/javascript">
   $(document).ready(function() {
      $('#reset').click(function() {
         $('#district_name_selected').hide();

      });
   });


   //     $(document).ready(function() {
   //     var table = $('#dataTable').DataTable( {
   //         lengthChange: false,
   //         buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
   //     } );

   //     table.buttons().container()
   //         .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
   // } );

   // $(document).ready(function() {
   //     $('#dataTable').DataTable( {
   //         dom: 'Bfrtip',
   //         buttons: [
   //             'print'
   //         ]
   //     } );
   // } );
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script type="text/javascript">
       //=============================
       function printContent(el) {
           alert('1');
           var restorepage = document.body.innerHTML;
           var printcontent = document.getElementById(el).innerHTML;
           document.body.innerHTML = printcontent;
           window.print();
           document.body.innerHTML = restorepage;
       }
   </script> -->
@endpush
