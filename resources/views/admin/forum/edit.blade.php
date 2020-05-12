@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content alumni" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        Allgemeines zum Studium
                    </h2>
                    <nav class="breadcrumb mb-0 pb-0 font-size-sm d-flex align-items-end">
                        <span class="breadcrumb-item">{{trans("general.forum")}}</span>
                        <span class="breadcrumb-item active">Allgemeines zum Studium</span>
                    </nav>
                </div>

                <div class="col-sm-4">
                    <a href="{{route("admin.forum.subject.create",1)}}"
                       class="btn btn-primary font-size-md py-md-3 font-weight-normal float-right">
                        <i class="fas fa-plus-circle"></i>
                        {{trans("general.new-subject")}}
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        @livewire("admin.forum.edit")
    </div>
    <!-- END Page Content -->
@endsection
@push("scripts")
    <script src="{{asset("/js/admin/pages/alumni.app.js")}}"></script>
    @include("plugins.jquery-validate")
    {{--    @include("plugins.date")--}}
@endpush