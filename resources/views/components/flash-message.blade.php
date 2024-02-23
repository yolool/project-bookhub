@if (session()->has("type") && session()->has("message"))
<div class="alert alert-{{ session()->get('type') }} alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <p>{{ session()->get('message') }}</p>
</div>
{{Session::forget('type')}}
{{Session::forget('message')}}
@endif