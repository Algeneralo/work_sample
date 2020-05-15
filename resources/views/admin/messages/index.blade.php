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
        <div class="row">
            <div class="col-xl-8">
                <div class="block block-rounded">
                    <!-- Chat Header -->
                    <div class="block-header bg-primary">
                        <div class="block-title text-white font-size-lg">
                            <img src="{{asset("/media/user.jpg")}}" alt=""
                                 width="40" height="40"
                                 class="rounded-circle border border-4x border-white mr-10">
                            Kate Morrison
                        </div>
                    </div>
                    <!-- END Chat Header -->

                    <!-- Messages (demonstration messages are added with JS code at the bottom of this page) -->
                    <div class="block-content block-content-full text-wrap-break-word overflow-y-auto"
                         style="height: 49vh;">
                        <div class="font-size-sm font-italic text-muted date">
                            16.04.2020
                        </div>
                        <div class="p-10 mb-10 fadeIn message receiver">
                            <div class="image">
                                <img src="{{asset("/media/user.jpg")}}" alt=""
                                     width="60" height="60"
                                     class="rounded-circle border border-4x border-primary mr-10">
                            </div>
                            <div class="details">
                                <div class="text bg-body rounded">
                                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
                                    tempor
                                    invidunt ut MEHR dolore magna aliquyam erat, sed diam voluptua.
                                </div>
                                <div class="time">
                                    11:15
                                </div>
                            </div>
                        </div>
                        <div class="font-size-sm font-italic text-muted text-center mt-20 mb-10">Today</div>
                        <div class="rounded p-10 mb-10 fadeIn message sender">
                            <div class="text">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor
                                invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
                                accusam
                                et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est
                                Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
                                voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
                                eirmod
                                tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum
                                dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                                labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet,
                                consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore
                                magna aliquyam erat, sed diam voluptua.
                            </div>
                            <div class="time">
                                11:15
                            </div>
                        </div>
                    </div>

                    <!-- Chat Input -->
                    <div class="block-content block-content-full block-content-sm bg-body-light">
                        <div class="logo-kopie d-none d-md-inline-flex">
                            <img src="{{asset("/media/icons/logo-kopie.png")}}" alt="">
                        </div>
                        <div class="inner-addon right-addon input">
                            <img src="{{asset("/media/icons/send.svg")}}" alt="">
                            <input class="form-control" type="text"
                                   placeholder="{{trans("general.write-new-message")}}">

                        </div>
                    </div>
                    <!-- END Chat Input -->
                </div>
            </div>
            <div class="col-xl-4">
                <div class="block">
                    <div class="block-content">
                        <div class="form-group">
                            <select name="" id="" class="select2" style="width: 100%">
                                <option value="">Alle Alumni anzeigen</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="inner-addon right-addon">
                                <i class="fa fa-search text-gray"></i>
                                <input type="text" class="form-control" placeholder="{{trans("general.search-text")}}"/>
                            </div>
                        </div>
                        Alle Alumni auswählen
                        @for($counter=0;$counter<5;$counter++)
                            <div class="bg-participant px-10 py-5 rounded mt-3">
                                <img src="{{asset("/media/user.jpg")}}" width="40" height="40"
                                     class="rounded-circle mr-10">
                                Kate Morrison
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
@push("scripts")
    @includeIf('layouts.partials.livewireDeleteConfirmation')
    @include('plugins.select2')
@endpush
