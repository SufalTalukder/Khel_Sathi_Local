<div class="modal fade" id="forwarded" tabindex="-1" aria-labelledby="forwrdedLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('forwordProject') }}" class="needs-validation" id="forward_submit" novalidate method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="forwrdedLabel">Forward</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Select User</label>
                        <select name="forward_to" id="forward_to" class="form-control" required>
                            <option value="">Select User Name</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a user.
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Remark</label>
                        <textarea class="form-control" id="remark" name="remark" required></textarea>
                        <div class="invalid-feedback">
                            Please provide a remark.
                        </div>
                    </div>
                </div>
                <input type="hidden" class="project_summary_id" name="project_summary_id" id="project_summary_id" />
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit/दर्ज करे</button>
                </div>
            </form>
        </div>
    </div>
</div>






<div class="modal fade" id="Feasible" tabindex="-1" aria-labelledby="FeasibleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('department/revertProject') }}" class="needs-validation" id="revert_submit" novalidate method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="FeasibleLabel">Revert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group FeasibilityAction">
                        <label>Feasibility&nbsp;&nbsp;&nbsp;</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" required type="radio" name="feasibility" id="inlineRadio1" value="1">
                            <label class="form-check-label" for="inlineRadio1">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" checked required type="radio" name="feasibility" id="inlineRadio2" value="2">
                            <label class="form-check-label" for="inlineRadio2">No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Remark</label>
                        <textarea class="form-control" id="remark" rows="4" name="remark" required></textarea>
                    </div>
                </div>
                <input type="hidden" class="project_summary_id" name="project_summary_id" id="project_summary_id" />
                <input type="hidden" class="project_rejected" name="project_rejected" id="project_rejected" value="0"/>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit/दर्ज करे</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--
<div class="modal fade" id="order_view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" id="order_details">


            </div>
            <div class="modal-footer justify-content-md-center">
                <div class="col-4 d-grid">
                    <a class="btn btn-info"  id="lock" href="Javascript:void(0)">Lock</a>
                </div>

            </div>
        </div>
    </div>
</div> -->

