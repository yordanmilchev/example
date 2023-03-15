{{-- use: $request->session()->flash('error', 'There is error!'); --}}

var flashesToastrOptions = {
    "timeOut": "7000",
    "positionClass": "toast-top-full-width"
};

@if ($message = Session::get('success'))
    toastr.success('{{ escapeJS($message) }}', '', flashesToastrOptions);
@endif

@if ($message = Session::get('error'))
    toastr.error('{{ escapeJS($message) }}', '', flashesToastrOptions);
@endif

@if ($message = Session::get('info'))
{{--    {{\Illuminate\Support\Facades\Session::flush()}}--}}
    toastr.info('{{ escapeJS($message) }}', '', flashesToastrOptions);
@endif

@if ($message = Session::get('warning'))
    toastr.warning('{{ escapeJS($message) }}', '', flashesToastrOptions);
@endif
