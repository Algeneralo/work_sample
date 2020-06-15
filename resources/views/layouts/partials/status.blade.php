
@if(session()->has('success'))
    <div class="alert alert-success alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <h3 class="alert-heading font-size-h4 font-w400">@lang("messages.success.title")</h3>
        <p class="mb-0"> {{session('success')}}</p>
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger alert-dismissable" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <h3 class="alert-heading font-size-h4 font-w400">@lang("messages.error.title")</h3>
        <p class="mb-0"> {{session('error')}}</p>
    </div>
@endif
