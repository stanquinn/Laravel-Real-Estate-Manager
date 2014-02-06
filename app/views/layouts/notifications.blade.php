@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissable">
  <strong>Success:</strong> {{ $message }}
</div>
{{ Session::forget('success') }}
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissable">
  <strong>Error:</strong> {{ $message }}
</div>
{{ Session::forget('error') }}
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissable">
  <strong>Warning:</strong> {{ $message }}
</div>
{{ Session::forget('warning') }}
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissable">
  <strong>FYI:</strong> {{ $message }}
</div>
{{ Session::forget('info') }}
@endif
