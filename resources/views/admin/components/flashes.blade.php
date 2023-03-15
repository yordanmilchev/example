@if ($message = Session::get('success'))
    <div class="alert alert-outline-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-outline-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{ $message }}</strong>
    </div>
@endif

@if (count($errors) && empty(Session::get('error')))
    <div class="alert alert-outline-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Има грешки!</strong>
    </div>
@endif


@if ($message = Session::get('warning'))
    <div class="alert alert-outline-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = Session::get('info'))
    <div class="alert alert-outline-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{ $message }}</strong>
    </div>
@endif
