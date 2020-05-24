@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content dashboard" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-md-9">
                    <h2 class="font-size-38 text-primary font-w400">
                        Dashboard
                    </h2>
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="{{route("admin.my-network.alumni.index")}}">
                    <div class="block-content block-content-full  d-flex align-items-center clearfix">
                        <div class="float-left">
                            <span class="text-gray font-size-md">Alle Alumni</span>
                            <div class="font-size-h2 font-w600 text-left">
                                <span data-toggle="countTo" data-speed="1000" data-from="0" data-to="{{$alumniCount}}">
                                    0
                                </span>
                            </div>
                        </div>
                        <div class="circle rounded-circle student ml-auto d-flex justify-content-center align-items-center">
                            <img src="{{asset('/media/icons/student.svg')}}" alt="student">
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="{{route("admin.events.index")}}">
                    <div class="block-content block-content-full  d-flex align-items-center clearfix">
                        <div class="float-left">
                            <span class="text-gray font-size-md">Alle Veranstaltungen</span>
                            <div class="font-size-h2 font-w600 text-left">
                                <span data-toggle="countTo" data-speed="1000" data-from="0" data-to="{{$eventsCount}}">
                                    0
                                </span>
                            </div>
                        </div>
                        <div class="circle rounded-circle workshop ml-auto d-flex justify-content-center align-items-center">
                            <img src="{{asset('/media/icons/workshop.svg')}}" alt="student">
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="{{route("admin.messages.index")}}">
                    <div class="block-content block-content-full  d-flex align-items-center clearfix">
                        <div class="float-left">
                            <span class="text-gray font-size-md">Alle Nachrichten</span>
                            <div class="font-size-h2 font-w600 text-left">
                                <span data-toggle="countTo" data-speed="1000" data-from="0" data-to="120">
                                    0
                                </span>
                            </div>
                        </div>
                        <div class="circle rounded-circle email ml-auto d-flex justify-content-center align-items-center">
                            <img src="{{asset('/media/icons/email.svg')}}" alt="student">
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="{{route("admin.media.gallery.index")}}">
                    <div class="block-content block-content-full  d-flex align-items-center clearfix">
                        <div class="float-left">
                            <span class="text-gray font-size-md">Media</span>
                            <div class="font-size-h2 font-w600 text-left">
                                <span data-toggle="countTo" data-speed="1000" data-from="0" data-to="{{$mediaCount}}">
                                    0
                                </span>
                            </div>
                        </div>
                        <div class="circle rounded-circle agenda ml-auto d-flex justify-content-center align-items-center">
                            <img src="{{asset('/media/icons/electronics.svg')}}" alt="student">
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-5">
                <div class="block">
                    <div class="block-content">
                        @livewire("admin.dashboard.current-events")
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
@section("js_after")
    <script src="{{asset("/js/core/jquery.countTo.min.js")}}"></script>
@endsection
