<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabels">@if(isset(Auth::guard('admin')->user()->id) && Auth::guard('admin')->user()!=null) Send Reminder @else Marked Query Reply @endif </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
<?php
   
        $abc=marked_closed($id);
        
  if( $abc){
    $closed = $abc->is_closed;
  }
    
    else{
        $closed = 0;
    }
    ?>
   @if(!(isset(Auth::guard('admin')->user()->id)) || (isset(Auth::guard('admin')->user()->id) && Auth::guard('admin')->user()->id !=1))
    @if($closed == 0)
    <form action="{{url('directMarkQuery')}}" method="post" enctype="multipart/form-data" class="directMarkQuery" novalidate>
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="col-90">
                    <div class="form-group">
                        <input type="hidden" name="queryIdReply" id="queryIdReply" value="<?= $id; ?>">
                        <input type="hidden" name="queryTypeReply" id="queryTypeReply" value="<?= $type; ?>">
						
                        <label class="placeholder">Details <span class="text-danger">*</span></label>
                        <textarea class="form-control" required name="is_mark_query_reply" id="is_mark_query_reply" cols="95" rows="2"></textarea>
						
                        <label>Documents</label>
                        <div class="input-group">
                            <input type="file" name="query_doc" class="query_doc_image_reply form-control" onchange="getfileext(this.value,10)" id="File10" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
						</div>
                        <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
						
                        <br>
                        <button type="button" class="btn btn-info mt-2" data-bs-dismiss="modal">Back</button>
                        <button type="button" onclick="queryReply()" class="btn btn-success mt-2">Reply</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	@endif
    @endif
    <div class="mt-1 card">
        <div class="card-body">
            <h3 class="bg-light"> Query Replied List </h3>
            <table  id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;" id="query-form-marked-table">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Details</th>
                        <th>Document</th>
                        <th>Date</th>
                        <th>Reply To</th>
					</tr> 
				</thead>
                @foreach($reply as $key=>$item)
                <tbody>
                    <tr>
                        <td><?= $key + 1; ?></td>
                        <td>
                            <textarea class="form-control" readonly><?= $item->reply; ?></textarea>
						</td>
                        <td>
							{{-- @if($item->reply_doc!='')
                            <a href="<?= url('public/queryDoc') . '/' . $item->reply_doc; ?>" target="blank">
                                <img src="<?= url('public/queryDoc') . '/' . $item->reply_doc; ?>" class="img-fluid img-query" />
							</a>
                            @endif --}}
							
							
							@if($item->reply_doc!='')
							@php
							$img = url('public/queryDoc').'/'.$item->reply_doc;
							$img1 = url('public/images/images.svg');
							$doc = explode('.',$item->reply_doc);
							if($doc[1]=='pdf')
							$img1 = url('public/images/pdf.svg');
							@endphp
							<img src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query" />
							@endif
							
							
							
						</td>
                        <td><?= dmy($item->trans_date); ?></td>
                        <td>
							@if($item->current_status=="User")
							{{rsoName($item->reply_to)}}
							@else
							{{userName($item->reply_to,$item->query_id)}}
							@endif	
							
						</td>
					</tr>
				</tbody>
                @endforeach
			</table>
		</div>
	</div>
	<!---- Self  RSO ---->
</div>
