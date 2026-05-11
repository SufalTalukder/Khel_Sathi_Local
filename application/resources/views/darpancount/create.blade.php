@extends('layouts/darpan_nav')
@section('content')
    <div class="pageheader">
        <h4 class="mb-0">Darpan Count</h4>
    </div>



    <div class="card">

        <div class="card-body">
            <form action="{{ route('darpancountStore') }}" method="post" enctype="multipart/form-data" class="needs-validation"
                novalidate>
                @csrf
                <div class="row mt-1">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Web API Key</label>
                            <input type="text" class="form-control" name="web_api_key" required>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">HMAC Key</label>
                            <input type="text" class="form-control" name="hmac_key" required>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Instance Code</label>
                            <input type="number" class="form-control" name="instance_code" required>

                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Project Code</label>
                            <input type="number" class="form-control" name="project_code" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Frequency ID</label>
                            <input type="number" class="form-control" name="frequency_id" required>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Group ID</label>
                            <input type="number" class="form-control" name="group_id" required>
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Import File</label>
                            <input type="file" class="form-control" name="file" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <a   class="btn btn-sm btn-success  mt-3" onclick="ExportToExcel('xlsx')">
                                <i class="fa fa-file-excel"></i> Sample Excel
                            </a>  </div>
                    </div>
                </div>
                <input class="btn btn-primary mt-3" type="submit" value="Submit">
            </form>

        </div>



    </div>


    <table  id="darpan" style="display: none">
        <thead>
            <tr>

                <th>State Code</th>
                <th>State Name</th>
                <th>Division Code</th>
                <th>Division Name</th>
                <th>District Code</th>
                <th>District Name</th>
                <th>K Value</th>
                <th>L Value</th>

            </tr>
        </thead>
        <tbody>

            <tr>
                <td>
                    9
                </td>
                <td>
                    Uttar Pradesh
                </td>
                <td>
                    3
                </td>
                <td>
                    Agra
                </td>
                <td>
                    118
                </td>
                <td>
                    Agra
                </td>

                <td>
                    0,0,0,0
                </td>
                <td>
                    9,3,118
                </td>

            </tr>
        </tbody>


    </table>
    <script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
    <script>
        function ExportToExcel(type, fn, dl) {
           var elt = document.getElementById('darpan');
           var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
           return dl ?
             XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
             XLSX.writeFile(wb, fn || ('Darpansample.' + (type || 'xlsx')));
        }
    </script>
@endsection


