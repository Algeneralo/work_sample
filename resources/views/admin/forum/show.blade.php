@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content forum" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        {{$forum->designation}}
                    </h2>
                    <nav class="breadcrumb mb-0 pb-0 font-size-sm d-flex align-items-end">
                        <span class="breadcrumb-item">{{trans("general.forum")}}</span>
                        <span class="breadcrumb-item active">{{$forum->designation}}</span>
                    </nav>
                </div>

                <div class="col-sm-4">
                    <a href="{{route("admin.forum.topics.create",$forum->id)}}"
                       class="btn btn-primary font-size-md py-md-3 font-weight-normal float-right">
                        <i class="fas fa-plus-circle"></i>
                        {{trans("general.new-subject")}}
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        @livewire("admin.forum.topic",["forum"=>$forum])
    </div>

    <!-- END Page Content -->
@endsection
@push("scripts")
    <script src="{{asset("/js/admin/pages/forum.app.js")}}" defer></script>
    @include("plugins.jquery-validate")
@endpush