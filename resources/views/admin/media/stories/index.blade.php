@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        {{trans("general.stories")}}
                    </h2>
                </div>
                <div class="col-sm-4">
                    <a href="{{route("admin.media.stories.create")}}"
                       class="btn btn-primary font-size-md py-md-3 font-weight-normal float-right">
                        <i class="fas fa-plus-circle"></i>
                        {{trans("general.new-story")}}
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-12">
                @livewire("admin.media.story.index")
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
@push("scripts")
    @includeIf('layouts.partials.livewireDeleteConfirmation')
@endpush
