<div class="modal fade" id="add-key-modal" tabindex="-1" role="dialog" aria-labelledby="add-note"
     aria-hidden="true">
    <div class="modal-dialog modal-l modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавяне на route_key</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div id="add-key-content" class="modal-body">
                <form id="add-key-form" name="note_form" class="kt-form kt-form--label-right">
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Route_key</label>
                            <div class="col-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="flaticon-web"></i>
                                            </span>
                                    </div>
                                    <textarea name="route_key_content" id="route_key_content" class="form-control">

                                        </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="add-key-btn" class="btn btn-outline-success">Запазване</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Затваряне</button>
            </div>
        </div>
    </div>
</div>
