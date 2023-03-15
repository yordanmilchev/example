<!--begin: Cache control modal and scripts -->
<div class="modal fade" id="kt_modal_cache_control" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cache control</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <h5>Clear cache</h5>
                <p>
                    <div class="row">
                        <div class="col-9">
                            <select class="form-control" id="clear_cache_select">
                                <option value=""></option>
                                <option value="clear_all">Optimize / All</option>
                                <option value="clear_cache_driver">Clear cache</option>
                                <option value="clear_views_cache">Clear views cache</option>
                                <option value="clear_route_cache">Clear route cache</option>
                                <option value="clear_config_cache">Clear config cache</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <button onclick="clearCache()" type="button" class="btn btn-warning">Clear</button>
                        </div>
                    </div>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function clearCache()
    {
        var clearCacheOption = $("#clear_cache_select").val();
        if(clearCacheOption=="") {
            alert("Не сте избрали опция за чистене на кеша!");
            return;
        }

        $.get("{{route('admin.cache')}}?cache_clear=" + clearCacheOption, function (response, status) {
            if(response==true) {
                alert('Cleared!');
                location.reload();
            }
            else {
                alert('Error when trying to clear.');
            }
        });
    }
</script>
<!--end: Cache control modal and scripts -->
