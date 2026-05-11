@extends('layouts/admin_layout')
@section('content')
    <div class="pageheader" id="menu-margin">
        <h4 class="mb-0">
            List of Applicants who applied for Academy
            <a title="Application Details ExportToExcel" class="btn btn-sm btn-success float-end"
                onclick="ExportToExcel('xlsx')">
                <i class="fa fa-file-excel"></i> Export to Excel
            </a>

            <a href="{{ route('private_coaching_export_pdf') }}" class="btn btn-sm btn-primary float-end" target="_blank"
                rel="noopener noreferrer"> Export PDF</a>
        </h4>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive table-bordred">
                <table id="dataTable" class="table table_new datatable table-bordred table-hover bg-white">
                    <thead>
                        <tr>

                            <th>S.No.</th>
                            <th>Application No.</th>

                            <th>Name</th>
                            <th>Designation</th>
                            <th>Institution Name</th>

                            <th>Email ID</th>
                            <th>Mobile No.</th>
                            <th>Sports Name</th>
                            <th class="text-center">Status of Application</th>
                            {{-- <th class="text-center">Action</th> --}}
                            <th class="text-center">View</th>


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($application as $key => $item)
                            <tr>
                                <td>
                                    {{ $key + 1 }}
                                </td>
                                <td>
                                    {{ $item->application_no }}
                                </td>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->designation }}
                                </td>
                                <td>
                                    {{ $item->institute_name }}
                                </td>
                                <td>
                                    {{ $item->email }}
                                </td>
                                <td>
                                    {{ $item->mobile }}
                                </td>
                                <td>
                                    {{ sport_name($item->sport_id) }}
                                </td>

                                <td class="text-center">
                                    @if ($item->status == 1 && $item->final_submit == 1)
                                        <span class="badge bg-success ">Accepted</span>
                                    @elseif ($item->status == 2 && $item->final_submit == 1)
                                        <span class="badge bg-danger ">Rejected</span>
                                    @elseif ($item->final_submit == 1 && $item->query_status == 2)
                                        <button type="button" class="btn btn-outline-primary btn-sm"> Re-Submitted</button>
                                    @elseif($item->final_submit == 1 && $item->query_status == 1)
                                        <button type="button" class="btn btn-outline-warning btn-sm"> Query Marked</button>
                                    @elseif ($item->status == 1 && $item->final_submit == 1)
                                        <span class="badge bg-success ">Accepted</span>
                                    @elseif ($item->status == 2 && $item->final_submit == 1)
                                        <span class="badge bg-danger ">Rejected</span>
                                    @else
                                        <span class="badge bg-primary ">Pending</span>
                                    @endif
                                </td>
                                {{-- <td>
                                    <div style="display: inline-block;">

                                        <?php if ($item->is_forwarded >= 1 && Auth::guard('admin')->user()->admin_role == 3) { ?>
                                        <strong class="badge bg-success text-white rounded-pill disabled">Forwarded to
                                            SO / RSO</strong>
                                        <?php }elseif($item->is_forwarded == 2) { ?>
                                        <strong class="badge bg-success text-white rounded-pill disabled">Forwarded to
                                            Prize Money Admin </strong>
                                        <?php } else { ?>
                                        <a href="#" class="btn btn-primary btn-xs btn-block show_data_id"
                                            data-id="{{ $item->id }}" data-form_type="1"
                                            data-data="{{ $item->is_forwarded }}"
                                            data-application_no="{{ $item->application_no }}" id="h{{ $item->id }}"
                                            onclick="forward({{ $item->id }})" data-bs-toggle="modal"
                                            data-bs-target="#forwarded1">Forward to @if (Auth::guard('admin')->user()->admin_role == 3)
                                                SO/RSO
                                            @else
                                                Prize Money Admin
                                            @endif
                                        </a>
                                        <?php } ?>
                                    </div>
                                </td> --}}
                                <td class="text-center">

                                    <a class="btn btn-outline-success btn-sm"
                                        href="{{ asset('assets_admin/private_coaching/admin_academy_preview', $item->id_application) }}"><i
                                            class="fa fa-eye"></i></a>
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
<div class="modal" id="forwarded1" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forward to 
                      <span> @if(Auth::guard('admin')->user()->admin_role == 3) SO/RSO @else Prize Money Admin @endif</span></h5>
                    <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                </div>
                <form action="{{ route('admin_private_forward') }}" method="post" id="preregister"  class="needs-validation" novalidate enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" class="financial_forward" name="id" value="" />
                        <input type="hidden" class="application_no" name="application_no" value="" />
                        <input type="hidden" name="form_type" value="3">

                        <label class="placeholder">Remark <span class="text-danger">*</span></label>
                        <textarea class="form-control" required name="remark" id="is_mark_query" cols="95" rows="2"></textarea>

                        <label id="verification_document">Upload Relevant application verification document <span
                                class="text-danger remove_danger">*</span></label></br>
                        <span class="text-danger">(If you have more than one supporting document then make please a single
                            PDF for all then upload.)</span>
                        <div class="input-group">
                            <input type="file" required name="verification_document"
                                class="form-control remove_danger" onchange="getfileext(this.value,10)" id="File10"
                                aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <input type="submit" class="btn btn-info" value="Yes">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" id="exampleModalLabellllll">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Approve Booking</h5>
                </div>



                <form action="" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">




                        <div class="row">
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <input type="hidden" name="id" id="bookid" value="">
                                <select class="form-select form-control" name="status" required>
                                    <option value="">Select</option>
                                    <option value="1">Approved </option>
                                    <option value="2">Declined</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label class="placeholder">
                                    Message
                                </label>
                                <input type="text" class="form-control" value="" name="status_message" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="button" class="btn btn-danger" onclick="closetrial()">No</button>
                        </div>
                </form>


            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
    <script>
        function approved(id) {
            alert(id);
            $("#bookid").val(id);

            $("#exampleModalLabellllll").show();



        }

        function closetrial() {
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
         $("#preregister").submit(function(e) {

            e.preventDefault();
            if ($("#preregister")[0].checkValidity() === false) {
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
                            window.location.reload();
                            // window.location.href = res.url;
                        } else {
                            error(res.msg);
                        }
                    },
                });
            }
            $("#preregister").addClass("was-validated");
        });
    </script>
@endpush
