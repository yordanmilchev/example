<div class="modal fade" id="kt_modal_impressionate_control" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Потребител</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <h5>Избор на потребител от чието име ще бъдете логнати</h5>
                <p>
                    <div class="row">
                        <div class="col-9">
                            <div class="col">
                                <input id="user_visible" name="user_visible" value="{{ old('user_visible') }}"
                                       type="text" class="form-control @error('user_visible') is-invalid @enderror" placeholder="Имейл/име" readonly onfocus="this.removeAttribute('readonly');" autocomplete="off">
                                <input id="user_id" name="user_id" value="{{ old('user_id') }}"
                                       type="hidden">
                            </div>
                        </div>
                        <div class="col-3">
                            <button onclick="impressionate()" type="button" class="btn btn-warning js-loader">Влизане с потребителя</button>
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
    window.addEventListener('load', (event) => {
        var usersBloodhound = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '/autocomplete/users?query=%QUERY',
                wildcard: '%QUERY',
            }
        });

        $('#user_visible').typeahead({
            hint: true,
            highlight: true,
            minLength: 2,
        }, {
            name: 'users',
            display: 'email',
            limit: 10,
            source: usersBloodhound,
            templates: {
                empty: [
                    '<div class="empty-message text-center text-danger">',
                    'Няма намерени.',
                    '</div>'
                ].join('\n'),
                suggestion: Handlebars.compile(
                    '<div><strong><?php echo "{{name}} {{lastname}} - {{email}}"; ?></strong></div>'
                )
            }
        })
        .on('typeahead:selected', function (ev, suggestion) {
            $('#user_id').val(suggestion.id);
        })
        .on('keyup', function (e) {
            $('#user_id').val('');
        });
    });

    function impressionate()
    {
        $.get("{{route('admin.impressionate')}}?user_id=" + $('#user_id').val(), function (response, status) {
            if(response==true) {
                location.reload();
            }
            else {
                alert('Възникна грешка при опита за влизане с друг акаунт.');
            }
        });
    }
</script>
