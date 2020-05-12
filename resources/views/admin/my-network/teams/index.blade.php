@extends('layouts.backend')
@section("css_after")
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css"
          rel="stylesheet">
    <style>
        .width-48 {
            width: 48%;
        }
    </style>
@endsection
@section('content')
    <!-- Page Content -->
    <div class="content" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        {{trans("general.team")}}
                    </h2>
                </div>
                <div class="col-sm-4">
                    <a href="#"
                       class="btn btn-primary font-size-md py-md-3 font-weight-normal float-right">
                        <i class="fas fa-plus-circle"></i>
                        {{trans("general.new-team")}}
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            @for($counter=0;$counter<5;$counter++)
                <div class="col-xl-4">
                    <div class="block">
                        <div class="block-content">
                            <div class="row d-flex align-items-center mb-20">
                                <div class="col-sm-5 d-flex justify-content-center">
                                    <img src="{{asset("/media/user.jpg")}}" width="80" height="80"
                                         class="rounded-circle border border-4x border-primary mr-10">
                                </div>
                                <div class="col-sm-7 px-sm-0 mt-10">
                                    <a href="tel:0123-54269" class="btn bg-gray text-white width-48">
                                        <img src="{{asset("/media/icons/phone-call.svg")}}" width="14" alt="">
                                        {{trans("general.phone")}}
                                    </a>
                                    <a href="mailto:k.redman@gmxmail.de" class="btn btn-primary width-48">
                                        <i class="far fa-envelope"></i>
                                        {{trans("general.email")}}
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans("general.first-name")}}</label>
                                        <input type="text" name="first_name" class="form-control" value="Franziska"
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans("general.last-name")}}</label>
                                        <input type="text" name="last_name" class="form-control" value="Schmidt"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12">{{trans("general.gender")}}</label>
                                <div class="col-12">
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" id="gender-radio{{$counter}}"
                                               value="f" checked="" name="gender{{$counter}}" required>
                                        <label class="custom-control-label"
                                               for="gender-radio{{$counter}}">{{trans("general.women")}}</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio"
                                               id="gender-radio-radio2-{{$counter}}" value="m" name="gender{{$counter}}"
                                               required>
                                        <label class="custom-control-label"
                                               for="gender-radio-radio2-{{$counter}}">{{trans("general.man")}}</label>
                                    </div>
                                </div>
                            </div>
                            <address-component :street="'Wasserstr.'"
                                               :streetNumber="'12'"
                                               :postcode="'48581'"
                                               :city="'Essen'"></address-component>
                            <div class="form-group">
                                <label>{{trans("general.email")}}</label>
                                <input class="form-control" type="email" value="k.redman@gmxmail.de" name="email"
                                       required>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.phone")}}</label>
                                <input type="text" class="form-control"
                                       name="phone" value="0123 54269" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.mobile")}}</label>
                                <input type="text" class="form-control"
                                       name="mobile" value="0176 7554269" required>
                            </div>
                            <button class="float-left btn bg-gray text-white my-20 text-capitalize">
                                <i class="fas fa-cog text-white"></i>
                                {{trans("general.edit")}}
                            </button>

                            <button class="float-right btn btn-primary my-20">
                                <img src="{{asset("/media/icons/comment.svg")}}" alt="">
                                {{trans("general.message")}}
                            </button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <!-- END Page Content -->
@endsection
@push("scripts")
    <script src="{{asset("/js/admin/pages/team.app.js")}}"></script>
    @includeIf('layouts.partials.deleteConfirmation')
@endpush
