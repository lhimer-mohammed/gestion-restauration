@if ($errors->all())
@foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
@endforeach
@endif
{{-- @if (session()->has('success'))

<div class="alert alert-success alert-dismissible fade show">
    <strong>{{session()->get("success")}}</strong>
    <button class="close" data-dismiss="alert" type="button">
        <span>&times;</span>
    </button>
</div>

@endif
@if (session()->has('warning'))

<div class="alert alert-warning alert-dismissible fade show">
    <strong>{{session()->get("warning")}}</strong>
    <button class="close" data-dismiss="alert" type="button">
        <span>&times;</span>
    </button>
</div>

@endif
@if (session()->has('info'))

<div class="alert alert-info alert-dismissible fade show">
    <strong>{{session()->get("info")}}</strong>
    <button class="close" data-dismiss="alert" type="button">
        <span>&times;</span>
    </button>
</div>

@endif --}}
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get("success") }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (session()->has('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{ session()->get("warning") }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session()->has('info'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>{{ session()->get("info") }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

