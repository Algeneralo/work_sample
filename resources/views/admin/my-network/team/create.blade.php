@extends('layouts.backend')
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
            </div>
            <div class="clearfix"></div>
        </div>
        @includeIf("layouts.partials.validation-status")
        <form action="{{route("admin.my-network.teams.store")}}" class="js-validation-bootstrap" method="POST"
              enctype="multipart/form-data">
            @csrf
            <div class="block">
                <div class="block-header bg-primary rounded-top">
                    <h3 class="text-white font-weight-light font-size-h3 mb-0">{{trans("general.new-team")}}</h3>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-md-6 col-xl-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans("general.first-name")}}</label>
                                        <input type="text" name="first_name" class="form-control js-maxlength"
                                               maxlength="40"
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans("general.last-name")}}</label>
                                        <input type="text" name="last_name" class="form-control js-maxlength"
                                               maxlength="40" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12">{{trans("general.gender")}}</label>
                                <div class="col-12">
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" id="gender-radio1"
                                               value="f" checked="" name="gender" required>
                                        <label class="custom-control-label"
                                               for="gender-radio1">{{trans("general.women")}}</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio"
                                               id="gender-radio-radio2" value="m" name="gender" required>
                                        <label class="custom-control-label"
                                               for="gender-radio-radio2">{{trans("general.man")}}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.dob")}}</label>
                                <date-picker v-model="dob" valueType="format" input-class="form-control"
                                             :input-attr="{name:'dob',required:'required'}"
                                             format="DD.MM.YYYY"></date-picker>
                            </div>
                            <address-component></address-component>
                        </div>
                        <div class="col-md-6 col-xl-4">
                            <div class="form-group">
                                <label>{{trans("general.email")}}</label>
                                <input class="form-control js-maxlength" maxlength="100" type="email" name="email"
                                       required>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.password")}}</label>
                                <input class="form-control" type="password" name="password" data-rule-minlength="6"
                                       required>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.phone")}}</label>
                                <input type="text" class="form-control"
                                       name="telephone" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.mobile")}}</label>
                                <input type="text" class="form-control"
                                       name="mobile" required>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div>
                                <label for=""
                                       class="border-b border-b-dashed w-100 mb-4">{{trans("general.image-upload")}}</label>
                                <image-uploader :name="'image'"></image-uploader>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full border-t">
                    <div class="float-sm-right">
                        <button type="reset"
                                class="btn btn-outline-primary btn-noborder font-italic">{{trans("general.reset")}}</button>
                        <button type="submit"
                                class="btn btn-primary px-30">{{trans("general.save")}}</button>
                    </div>
                    <div class="clearfix visible-md"></div>
                </div>
            </div>
        </form>
    </div>
    <!-- END Page Content -->
@endsection
@push("scripts")
    <script src="{{asset("/js/admin/pages/alumni.app.js")}}"></script>
    @include("plugins.jquery-validate")
    @include("plugins.select2")
    @include("plugins.bootstrap-maxLength")
@endpush