@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content alumni" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        {{$team->name}}
                    </h2>
                    <nav class="breadcrumb mb-0 pb-0 font-size-sm d-flex align-items-end">
                        <span class="breadcrumb-item">{{trans("general.team")}}</span>
                        <span class="breadcrumb-item active">{{$team->name}}</span>
                    </nav>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        @includeIf("layouts.partials.status")
        @includeIf("layouts.partials.validation-status")
        <form action="{{route("admin.my-network.teams.update",$team->id)}}" class="js-validation-bootstrap"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="block">
                <div class="block-content">
                    <div class="row">
                        <div class="col-xl-2 d-flex justify-content-center">
                            <image-previewer :image-class="'rounded-circle border border-4x border-primary mr-10'"
                                             :src="'{{$team->avatar}}'"
                                             :width="'100'"
                                             :height="'100'"
                            ></image-previewer>
                        </div>
                        <div class="col-xl-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans("general.first-name")}}</label>
                                        <input type="text" value="{{$team->first_name}}" name="first_name"
                                               class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans("general.last-name")}}</label>
                                        <input type="text" value="{{$team->last_name}}" name="last_name"
                                               class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12">{{trans("general.gender")}}</label>
                                <div class="col-12">
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" id="gender-radio1"
                                               value="f" @if($team->gender=='f') checked @endif name="gender"
                                               required>
                                        <label class="custom-control-label"
                                               for="gender-radio1">{{trans("general.women")}}</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio"
                                               @if($team->gender=='m') checked @endif
                                               id="gender-radio-radio2" value="m" name="gender" required>
                                        <label class="custom-control-label"
                                               for="gender-radio-radio2">{{trans("general.man")}}</label>
                                    </div>
                                </div>
                            </div>
                            <address-component :street="'{{$team->street}}'"
                                               :streetNumber="'{{$team->street_number}}'"
                                               :postcode="'{{$team->postcode }}'"
                                               :city="'{{$team->city}}'"></address-component>
                            <div class="form-group">
                                <label>{{trans("general.email")}}</label>
                                <input class="form-control" value="{{$team->email}}" type="email" name="email"
                                       required>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.password")}}</label>
                                <input class="form-control" type="password" name="password" data-rule-minlength="6"
                                       autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <label>{{trans("general.phone")}}</label>
                                <input type="text" class="form-control"
                                       name="telephone" value="{{$team->telephone}}" required>
                            </div>
                        </div>
                        <div class="col-xl-5">

                            <div class="form-group">
                                <label>{{trans("general.mobile")}}</label>
                                <input type="text" class="form-control"
                                       name="mobile" value="{{$team->mobile}}" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.dob")}}</label>
                                <date-picker v-model="dob" value-type="format" input-class="form-control"
                                             :input-attr="{name:'dob',required:'required' ,'data-change-v-model-value':'{\'dob\':\'{{$team->dob->format('d.m.Y')}}\'}'}"
                                             format="DD.MM.YYYY"></date-picker>
                            </div>
                            <div class="form-group">
                                <label for="">@lang("general.job-title")</label>
                                <input type="text" class="form-control" name="job_title" value="{{$team->job_title}}">
                            </div>
                            @livewire("admin.experience.index",["type" => "education","experiences" => $educationExperiences])
                            @livewire("admin.experience.index",["type" => "work","experiences" => $workExperiences])
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full border-t">
                    <div class="float-sm-left">
                        <button type="button" onclick="document.getElementById('activateUser').click()"
                                class="btn bg-gray text-white">{{trans("general.users")}} {{trans_choice("general.deactivate",$team->blocked)}}</button>
                        <button type="button"
                                data-delete-form-id="#deleteForm"
                                class="btn btn-outline-secondary btn-noborder px-30 font-italic delete-button">{{trans("general.users")}} {{trans("general.delete")}}</button>
                    </div>
                    <div class="float-sm-right">
                        <button type="reset"
                                class="btn btn-outline-primary btn-noborder font-italic">{{trans("general.reset")}}</button>
                        <button type="submit"
                                class="btn btn-primary px-30">{{trans("general.save-changes")}}</button>
                    </div>
                    <div class="clearfix visible-md"></div>
                </div>
            </div>
        </form>
        <form action="{{route("admin.my-network.teams.block",$team->id)}}" method="POST">
            @csrf
            @method("patch")
            <input type="submit" role="button" class="d-none" id="activateUser">
        </form>
        <form id="deleteForm" action="{{route("admin.my-network.teams.destroy",$team->id)}}"
              method="POST">
            @csrf
            @method("delete")
        </form>
    </div>
    <!-- END Page Content -->
@endsection
@push("scripts")
    <script src="{{asset("/js/admin/pages/alumni.app.js")}}"></script>
    @include("plugins.jquery-validate")
    @include("plugins.select2")
    @include("layouts.partials.deleteConfirmation")
@endpush