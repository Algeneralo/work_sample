@extends('layouts.backend')
@section("css_after")
    <style>
        .bg-participant {
            background-color: #F4F7FC !important;
        }
    </style>
@endsection
@section('content')
    <!-- Page Content -->
    <div class="content messages" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        {{trans("general.messages")}}
                    </h2>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        @livewire("admin.message.index")
    </div>
    <!-- END Page Content -->
@endsection
@push("scripts")
    @includeIf('layouts.partials.livewireDeleteConfirmation')
    @include('plugins.select2')
@endpush
