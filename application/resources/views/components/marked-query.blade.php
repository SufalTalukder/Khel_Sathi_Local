<div class="modal fade" id="query_form_marked" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Raise Query</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('direct_mark_query')}}" method="post" enctype="multipart/form-data" class="query_form_marked" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-90">
                            <div class="form-group">
                                <input type="hidden" name="formID" value="{{$id}}">
                                <input type="hidden" name="formType" value="{{$type}}">
                                <label class="placeholder">Subject </label>
                                <input name="query_subject" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" value="{{old('bank_name') }}" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="placeholder">Query Remark <span class="text-danger">*</span></label>
                                <textarea class="form-control" required name="is_mark_query" id="is_mark_query" cols="95" rows="2"></textarea>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Back</button>
                    <button type="submit" class="btn btn-success">Raise Query</button>
                </div>
            </form>
        </div>
    </div>
</div>
