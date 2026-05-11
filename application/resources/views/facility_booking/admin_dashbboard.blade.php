@extends('layouts/admin_layout')
@section('content')
    <div class="pageheader" id="menu-margin">
        <h4 class="mb-0">
            @if (last(request()->segments()) == 1)
                Swimming Pool (Mini)
            @elseif (last(request()->segments()) == 2)
                Guest Room
            @elseif (last(request()->segments()) == 3)
                Swimming Pool (Adult)
            @elseif (last(request()->segments()) == 4)
                Gymnasium
            @elseif (last(request()->segments()) == 5)
                Stadium
            @endif Booking List
            <a title="Application Details ExportToExcel" class="btn btn-sm btn-success float-end"
                onclick="ExportToExcel('xlsx')">
                <i class="fa fa-file-excel"></i> Export to Excel
            </a>

            <a href="{{ route('admin_facility_booking_application_pdf', last(request()->segments())) }}"
                class="btn btn-sm btn-primary float-end" target="_blank" rel="noopener noreferrer"> Export PDF</a>
        </h4>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive table-bordred">
                <table id="dataTableaa121" class="table table_new table-bordred table-hover bg-white">
                    <thead>
                        <tr>

                            <th>S.No.</th>
                            <th>Booking No.</th>
                            <th>Booking Type</th>
                            <th>Name</th>
                            <th>Email ID</th>
                            <th class="text-center">Mobile No.</th>
                            <th class="text-center">Status of Application</th>
                            <th class="text-center">Payment Status</th>
                            <th class="text-center">Action</th>


                        </tr>
                    </thead>
                    {{-- <tbody>
                        @if (!empty($application))
                            @foreach ($application as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        {{ $item->application_no }}
                                    </td>
                                    <td>
                                        @if ($item->service == 1)
                                            Swimming Pool (Mini)
                                        @elseif ($item->service == 2)
                                            Guest Room
                                        @elseif ($item->service == 3)
                                            Swimming Pool (Adult)
                                        @elseif ($item->service == 4)
                                            Gymnasium
                                        @elseif ($item->service == 5)
                                            Stadium
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td class="text-center">{{ $item->mobile }}</td>


                                    <td class="text-center">

                                        @if ($item->status == 1 && $item->final_submit == 1)
                                            <span class="badge bg-success ">Accepted</span>
                                            <br>{{ dmy($item->accept_reject_date) }}
                                        @elseif ($item->status == 2 && $item->final_submit == 1)
                                            <span class="badge bg-danger ">Rejected
                                            </span> <br>{{ dmy($item->accept_reject_date) }}
                                        @elseif($item->final_submit == 1 && $item->query_status == 2)
                                            <button type="button" class="btn btn-outline-primary btn-sm">
                                                Re-Submitted</button>
                                            {{ dmy($item->final_submit_date) }}
                                        @elseif($item->final_submit == 1 && $item->query_status == 1)
                                            <button type="button" class="btn btn-outline-warning btn-sm"> Query
                                                Marked</button>
                                            {{ dmy($item->marked_on) }}
                                        @elseif ($item->status == 1 && $item->final_submit == 1)
                                        @else
                                            <span class="badge bg-primary ">Pending</span>
                                            <br>{{ dmy($item->final_submit_date) }}
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if ($item->status == 1 && $item->payment_status == 1)
                                            <span class="badge bg-success ">Success</span> <br>
                                            {{ rajkosh_payment_booking($item->application_no)->Depchallan }}
                                            <br>
                                            {{ dmy($item->payment_date) }} <br>
                                            <strong> {{ $item->amount_to_be_paid }} INR. </strong>
                                        @elseif ($item->status == 1 && $item->payment_status != 1)
                                            @if ($item->fee_exemption_status == 1)
                                                <span class="badge bg-warning">Fee Exemption</span>
                                            @else
                                                <span class="badge bg-primary ">Pending</span><br>
                                                <strong> {{ $item->amount_to_be_paid }} INR. </strong>
                                            @endif
                                        @else
                                            NA
                                        @endif
                                    </td>


                                    <td class="text-center">

                                        <a class="btn btn-outline-success btn-sm"
                                            href="{{ route('admin_facility_booking_preview', $item->id_application) }}"><i
                                                class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
    <button type="button" class="pptwbtn" style="display:none">&nbsp;</button>
    <button type="button" class="pptwbtnadd" style="display:none">&nbsp;</button>
@endsection

@push('custom-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
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
            var elt = document.getElementById('dataTableaa121');
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
    </script>

    <script>
        var id = "<?= $type ?>";

        $(document).ready(function() {
            var table = $('#dataTableaa121').DataTable({ // ✅ FIXED HERE
                scrollX: true,
                layout: {
                    bottomEnd: {
                        paging: {
                            type: 'simple_numbers'
                        }
                    }
                },
                fixedHeader: true,
                responsive: true,
                columnDefs: [{
                        searchable: false,
                        orderable: false,
                        targets: [1, 2]
                    },
                    {
                        className: 'text-center cursor-pointer',
                        targets: [1, 2]
                    }
                ],
                retrieve: true,
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>',
                    lengthMenu: ' _MENU_ Entries Per Page',
                    paginate: {
                        previous: 'Previous',
                        next: 'Next'
                    },
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "<?= url('admin/facility_booking/facilityBookingAjax') ?>" + '/' + id,
                    type: "POST",
                    beforeSend: function() {
                        $.unblockUI();
                    },
                    data: function(data) {
                        data.search = $('.form-control-sm').val();
                    }
                },
                order: [
                    [0, 'desc']
                ],
                lengthMenu: [
                    [8, 10, 25, 50, 100],
                    [8, 10, 25, 50, 100],
                ],
                searching: true,
                aoColumns: [{
                        data: 'id_application',
                        name: 'id_application'
                    },
                    {
                        data: 'application_no',
                        name: 'application_no'
                    },
                    {
                        data: 'service',
                        name: 'service',
                        render: function(data, type, row) {
                            switch (row.service) {
                                case 1:
                                    return 'Swimming Pool (Mini)';
                                case 2:
                                    return 'Guest Room';
                                case 3:
                                    return 'Swimming Pool (Adult)';
                                case 4:
                                    return 'Gymnasium';
                                case 5:
                                    return 'Stadium';
                                default:
                                    return '';
                            }
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            if (row.status == 1 && row.final_submit == 1) {
                                return `<button class="btn btn-xs btn-outline-success">Accepted</button><br><span>${moment(row.accept_reject_date).format("D-MM-YYYY")}</span>`;
                            } else if (row.status == 2 && row.final_submit == 1) {
                                return `<button class="btn btn-xs btn-outline-danger">Rejected</button><br><span>${moment(row.accept_reject_date).format("D-MM-YYYY")}</span>`;
                            } else if (row.status == 1 && row.query_status == 2) {
                                return `<button class="btn btn-xs btn-outline-primary">Re-Submitted</button><br><span>${moment(row.final_submit_date).format("D-MM-YYYY")}</span>`;
                            } else if (row.status == 1 && row.query_status == 1) {
                                return `<button class="btn btn-xs btn-outline-warning">Query Marked</button><br><span>${moment(row.marked_on).format("D-MM-YYYY")}</span>`;
                            } else {
                                return `<button class="btn btn-xs btn-outline-primary">Pending</button><br><span>${moment(row.final_submit_date).format("D-MM-YYYY")}</span>`;
                            }
                        }
                    },
                    {
                        data: null,
                        name: 'payment_status',
                        render: function(data, type, row) {
                            // row contains the entire row data from AJAX response

                            if (row.status == 1 && row.payment_status == 1) {
                                // rajkosh_payment_booking($item->application_no)->Depchallan
                                // You need to include `Depchallan` in your ajax response as well for this to work
                                let depchallan = row.depchallan ||
                                ''; // make sure the server sends this

                                return `<span class="badge bg-success">Success</span><br>
                    ${depchallan}<br>
                    ${moment(row.payment_date).format('D-MM-YYYY')}<br>
                    <strong>${row.amount_to_be_paid} INR.</strong>`;
                            } else if (row.status == 1 && row.payment_status != 1) {
                                if (row.fee_exemption_status == 1) {
                                    return `<span class="badge bg-warning">Fee Exemption</span>`;
                                } else {
                                    return `<span class="badge bg-primary">Pending</span><br>
                        <strong>${row.amount_to_be_paid} INR.</strong>`;
                                }
                            } else {
                                return 'NA';
                            }
                        }
                    },


                    {
                        data: 'id_application',
                        name: 'id_application',
                        render: function(data, type, row) {
                            return `<div class="d-flex align-items-center"><span class="text-nowrap"><a href="${ajaxUrl}/admin/facility_booking/preview/${row.id_application}" target="_blank" class="btn btn-xs btn-outline-primary">View</a></span></div>`;
                        }
                    }
                ]
            });

            // Re-indexing rows on pagination and length change
            let info = 0,
                pageChange = 8;

            table.on('page', function() {
                let info1 = table.page.info();
                info = info1.page * pageChange;
            });

            table.on('length.dt', function(e, settings, len) {
                pageChange = len;
            });

            table.on('order.dt search.dt draw.dt', function() {
                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = info + 1 + i;
                });
            });

            $(".pptwbtnadd").on('click', function() {
                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = info + 1 + i;
                }).draw();
            });
        });
    </script>
@endpush
