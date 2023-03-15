@if(Session::has('success'))
    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
@endif

@if(Session::has('error'))
    <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('error') }}</p>
@endif

@if(Session::has('info'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('info') }}</p>
@endif

<script>
    setTimeout(function() { $('.alert').slideUp(); }, 3500);
</script>
