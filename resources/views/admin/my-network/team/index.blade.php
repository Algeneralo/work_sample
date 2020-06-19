@extends('layouts.backend')
@section("css_after")
    <style>
        .width-48 {
            width: 48%;
        }

        .form-control:disabled, .form-control[readonly],
        .custom-control-input:disabled ~ .custom-control-label::before {
            background-color: unset;
            opacity: 1;
        }

        .custom-control-input:disabled ~ .custom-control-label {
            color: unset !important;
        }
    </style>
@endsection
@section('content')
    <!-- Page Content -->
    <div class="content alumni" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        {{trans("general.team")}}
                    </h2>
                </div>
                <div class="col-sm-4">
                    <a href="{{route("admin.my-network.teams.create")}}"
                       class="btn btn-primary font-size-md py-md-3 font-weight-normal float-right">
                        <i class="fas fa-plus-circle"></i>
                        {{trans("general.new-team")}}
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        @include("layouts.partials.status")
        <div class="row">
            @foreach($teams as $item)
                <div class="col-xl-4">
                    <div class="block">
                        <div class="block-content">
                            <div class="row d-flex align-items-center mb-20">
                                <div class="col-sm-5 d-flex justify-content-center">
                                    <img src="{{$item->avatar}}" width="80" height="80"
                                         class="rounded-circle border border-4x border-primary mr-10">
                                </div>
                                <div class="col-sm-7 px-sm-0 mt-10">
                                    <a href="tel:{{$item->telephone}}" class="btn bg-gray text-white px-0 width-48">
                                        <img src="{{asset("/media/icons/phone-call.svg")}}" width="14" alt="">
                                        {{trans("general.phone")}}
                                    </a>
                                    <a href="mailto:{{$item->email}}" class="btn btn-primary px-0 width-48">
                                        <i class="far fa-envelope"></i>
                                        {{trans("general.email")}}
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans("general.first-name")}}</label>
                                        <input type="text" name="first_name" class="form-control"
                                               value="{{$item->first_name}}"
                                               readonly required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans("general.last-name")}}</label>
                                        <input type="text" name="last_name" class="form-control"
                                               value="{{$item->last_name}}"
                                               readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12">{{trans("general.gender")}}</label>
                                <div class="col-12">
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio"
                                               id="gender-radio{{$loop->index}}" disabled
                                               @if($item->gender=='f') checked @endif
                                               value="f" name="gender{{$loop->index}}" required>
                                        <label class="custom-control-label"
                                               for="gender-radio{{$loop->index}}">{{trans("general.women")}}</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" disabled
                                               id="gender-radio-radio2-{{$loop->index}}" value="m"
                                               @if($item->gender=='m') checked @endif
                                               name="gender{{$loop->index}}"
                                               required>
                                        <label class="custom-control-label"
                                               for="gender-radio-radio2-{{$loop->index}}">{{trans("general.man")}}</label>
                                    </div>
                                </div>
                            </div>
                            <address-component :read-only="true" :street="'{{$item->street}}'"
                                               :streetNumber="'{{$item->street_number}}'"
                                               :postcode="'{{$item->postcode}}'"
                                               :city="'{{$item->city}}'"></address-component>
                            <div class="form-group">
                                <label>{{trans("general.email")}}</label>
                                <input class="form-control" type="email" value="{{$item->email}}" name="email"
                                       readonly required>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.phone")}}</label>
                                <input type="text" class="form-control"
                                       name="phone" value="{{$item->telephone}}" readonly required>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.mobile")}}</label>
                                <input type="text" class="form-control"
                                       name="mobile" value="{{$item->mobile}}" readonly required>
                            </div>
                            <a class="float-left btn bg-gray text-white my-20 text-capitalize"
                               href="{{route("admin.my-network.teams.edit",$item->id)}}">
                                <i class="fas fa-cog text-white"></i>
                                {{trans("general.edit")}}
                            </a>

                            @if($item->id!=auth()->id())
                                <a href="{{route("admin.messages.index",["userID"=>$item->id])}}"
                                   class="float-right btn btn-primary my-20">
                                    <img src="{{asset("/media/icons/comment.svg")}}" alt="">
                                    {{trans("general.message")}}
                                </a>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- END Page Content -->
@endsection
@push("scripts")
    <script src="{{asset("/js/admin/pages/alumni.app.js")}}"></script>
    @includeIf('layouts.partials.livewireDeleteConfirmation')
@endpush
