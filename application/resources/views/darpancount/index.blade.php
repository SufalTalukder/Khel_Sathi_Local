@extends( 'layouts/darpan_nav' )
@section( 'content' )




	<div class="pageheader">
				<h4 class="mb-0">Darpan Count</h4>
			</div>







        <div class="card">
        <div class="card-body">
            <form action="{{ route('darpancountStoreFinal') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
             @csrf
             <div class="row mt-1">
                 <div class="col-md-6">
                     <div class="form-group">
                        <input type="hidden" name="datacount" value="{{ $datacount }}">
                         <label for="name">Web API Key</label>
                         <input type="text" class="form-control" readonly value="{{ $data['web_api_key'] }}" name="web_api_key" required>

                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="form-group">
                         <label for="name">HMAC Key</label>
                         <input type="text" class="form-control" readonly value="{{ $data['hmac_key'] }}" name="hmac_key" required>

                     </div>
                 </div>
             </div>
             <div class="row mt-1">
                 <div class="col-md-6">
                     <div class="form-group">
                         <label for="name">Instance Code</label>

                         <input type="number" class="form-control"  readonly value="{{ $data['instance_code'] }}" name="instance_code" required>

                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="form-group">
                         <label for="name">Project Code</label>
                         <input type="number" class="form-control" readonly value="{{ $data['project_code'] }}" name="project_code" required>
                     </div>
                 </div>
             </div>
             <div class="row mt-1">
                 <div class="col-md-6">
                     <div class="form-group">
                         <label for="name">Frequency ID</label>
                         <input type="number" class="form-control" readonly value="{{ $data['frequency_id'] }}" name="frequency_id" required>

                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="form-group">
                         <label for="name">Group ID</label>
                         <input type="number" class="form-control" readonly value="{{ $data['group_id'] }}" name="group_id" required>
                     </div>
                 </div>
             </div>
             <div class="row mt-1">
                 <div class="col-md-6">
                     <div class="form-group">
                         <label for="name">Date</label>
                         <select id="date_field" class="form-control" name="date" required>
                             <option value="">-- Click "Get Date" first --</option>
                         </select>
                         <small id="getdate_msg" class="text-muted"></small>
                     </div>
                 </div>
             </div>
             <button type="button" id="btn_getdate" class="btn btn-info btn-sm mt-3 me-2">Get Date</button>
             <input class="btn btn-primary btn-sm mt-3" type="submit" value="Submit">
             </form>

             <script>
             document.getElementById('btn_getdate').addEventListener('click', function () {
                 var web_api_key   = document.querySelector('[name="web_api_key"]').value;
                 var hmac_key      = document.querySelector('[name="hmac_key"]').value;
                 var instance_code = document.querySelector('[name="instance_code"]').value;
                 var project_code  = document.querySelector('[name="project_code"]').value;

                 var btn = this;
                 btn.disabled = true;
                 btn.textContent = 'Getting Date...';

                 var formData = new FormData();
                 formData.append('_token', document.querySelector('[name="_token"]').value);
                 formData.append('web_api_key', web_api_key);
                 formData.append('hmac_key', hmac_key);
                 formData.append('instance_code', instance_code);
                 formData.append('project_code', project_code);

                 fetch('{{ route("darpancountGetdate") }}', {
                     method: 'POST',
                     body: formData
                 })
                 .then(function(res) { return res.json(); })
                 .then(function(data) {
                     btn.disabled = false;
                     btn.textContent = 'Get Date';
                     var sel = document.getElementById('date_field');
                     sel.innerHTML = '';
                     if (data && Array.isArray(data) && data.length > 0 && data[0].dd) {
                         data.forEach(function(item) {
                             var opt = document.createElement('option');
                             opt.value = item.dd;
                             opt.textContent = item.dd + (item.gid ? '  (gid: ' + item.gid + ')' : '');
                             sel.appendChild(opt);
                         });
                         document.getElementById('getdate_msg').textContent = data.length + ' date(s) retrieved. Please select one.';
                         document.getElementById('getdate_msg').className = 'text-success';
                     } else {
                         var opt = document.createElement('option');
                         opt.value = '';
                         opt.textContent = '-- No dates returned --';
                         sel.appendChild(opt);
                         document.getElementById('getdate_msg').textContent = 'Unexpected response: ' + JSON.stringify(data);
                         document.getElementById('getdate_msg').className = 'text-warning';
                     }
                 })
                 .catch(function(err) {
                     btn.disabled = false;
                     btn.textContent = 'Get Date';
                     document.getElementById('getdate_msg').textContent = 'Error: ' + err;
                     document.getElementById('getdate_msg').className = 'text-danger';
                 });
             });
             </script>

         </div>
        <div class="card">
        <div class="card-body">

            <div class="table-responsive" id="prodiv">

                <table  id="dataTable" class="table table-striped table-hover table-bordered">

                    <thead>
                        <tr>

                            <th>S.No.</th>
                            <th align="center">State Code</th>
                            <th align="center">State Name</th>
                            <th align="center">Division Code</th>
                            <th align="center">Division Name</th>
                            <th align="center">District Code</th>
                            <th align="center">District Name</th>
                            <th align="center">L value</th>
                            <th align="center">K Value</th>

                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($datacount as $key=>$item)
                      <tr>
                        <td align="center">
                             {{ $key + 1 }}
                        </td>
                        <td align="center">
                            {{ $item->state_code }}
                       </td>
                       <td align="center">
                        {{ $item->state_name }}
                       </td>
                       <td align="center">
                        {{ $item->division_code }}
                       </td>
                        <td align="center">
                        {{ $item->division_name }}
                       </td>
                       <td align="center">
                        {{ $item->district_code }}
                       </td>
                        <td align="center">
                        {{ $item->district_name }}
                       </td>
                       <td align="center">
                        {{ $item->l_value }}
                       </td>
                        <td align="center">
                        {{ $item->k_value }}
                       </td>



                      </tr>
                      @endforeach



                    </tbody>
                </table>



            </div>
        </div>



	</div>



@endsection
