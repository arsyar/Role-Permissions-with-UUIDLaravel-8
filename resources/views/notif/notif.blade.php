@if($message = Session::get('success'))
<div class="alert alert-icon-left alert-arrow-left alert-success alert-dismissible mb-2" role="alert">
    <span class="alert-icon"><i class="fa fa-check-circle"></i></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{ $message }}</strong>
</div>
@endif
@if($message = Session::get('error'))
<div class="alert alert-icon-left alert-arrow-left alert-danger alert-dismissible mb-2" role="alert">
    <span class="alert-icon"><i class="fa fa-warning"></i></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>{{ $message }}</strong>
</div>
@endif