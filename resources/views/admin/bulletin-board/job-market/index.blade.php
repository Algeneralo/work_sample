@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        {{trans("general.job-market")}}
                    </h2>
                    <nav class="breadcrumb mb-0 pb-0 font-size-sm d-flex align-items-end">
                        <span class="breadcrumb-item">{{trans("general.bulletin-board")}}</span>
                        <span class="breadcrumb-item">{{trans("general.job-market")}}</span>
                    </nav>
                </div>
                <div class="col-sm-4">
                    <a href="{{route("admin.bulletin-board.job-market.create")}}"
                       class="btn btn-primary font-size-md py-md-3 font-weight-normal float-right">
                        <i class="fas fa-plus-circle"></i>
                        {{trans("general.new-job")}}
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-12">
                @livewire("admin.bulletin-board.job-market.index")
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
@push("scripts")
    @includeIf('layouts.partials.deleteConfirmation')
@endpush
