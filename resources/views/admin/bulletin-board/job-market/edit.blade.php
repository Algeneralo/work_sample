@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content general" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        Deutsche Bahn AG
                    </h2>
                    <nav class="breadcrumb mb-0 pb-0 font-size-sm d-flex align-items-end">
                        <span class="breadcrumb-item">{{trans("general.bulletin-board")}}</span>
                        <span class="breadcrumb-item">{{trans("general.job-market")}}</span>
                        <span class="breadcrumb-item active">{{$jobMarket->offer}}</span>
                    </nav>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        @include("layouts.partials.validation-status")
        @include("layouts.partials.status")
        <form action="{{route("admin.bulletin-board.job-market.update",$jobMarket->id)}}"
              class="js-validation-bootstrap" method="POST"
              enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="block">
                <div class="block-header bg-primary rounded-top">
                    <h3 class="text-white font-weight-light font-size-h3 mb-0">{{trans("general.new-job")}}</h3>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-xl-2">
                            <label for=""></label>
                            <image-previewer
                                    :name="'image'"
                                    :src="'{{$jobMarket->cover}}'"
                                    :class="'img-fluid'"
                            ></image-previewer>
                        </div>
                        <div class="col-xl-8">
                            <div class="row">
                                <div class="col-xl-5">
                                    <div class="form-group">
                                        <label>{{trans("general.employer")}}</label>
                                        <input class="form-control" type="text" name="employer"
                                               value="{{$jobMarket->employer}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans("general.category")}}</label>
                                        <input class="form-control" type="text" name="category"
                                               value="{{$jobMarket->category}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans("general.beginning")}}</label>
                                        <date-picker v-model="date" value-type="format"
                                                     input-class="form-control"
                                                     :input-attr='{name:"beginning",required:"required","data-change-v-model-value":"{\"date\":\"{{$jobMarket->beginning->format("d.m.Y")}}\"}"}'
                                                     placeholder="{{trans("general.date")}}"
                                                     format="DD.MM.YYYY">
                                            <i slot="icon-calendar"></i>
                                        </date-picker>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>{{trans("general.job-offer")}}</label>
                                        <input class="form-control" type="text" name="offer"
                                               value="{{$jobMarket->offer}}" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>{{trans("general.city")}}</label>
                                                <input class="form-control" type="text" name="city"
                                                       value="{{$jobMarket->city}}" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>{{trans("general.working-hours")}}</label>
                                                <select name="working_hours" id="" class="form-control">
                                                    <option @if($jobMarket->working_hours=="full_time") selected
                                                            @endif value="full_time">{{trans("general.full-time")}}</option>
                                                    <option @if($jobMarket->working_hours=="part_time") selected
                                                            @endif value="part_time">{{trans("general.part-time")}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>{{trans("general.duration")}}</label>
                                                <input class="form-control" type="text" name="duration"
                                                       value="{{$jobMarket->duration}}" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>@lang("general.job-posting")</label>
                                                <input class="form-control" type="url" name="link"
                                                       value="{{$jobMarket->link}}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="" class="col-12 font-weight-bold">@lang("general.contact-info")</label>
                                <div class="col-xl-5">
                                    <div class="form-group">
                                        <label>{{trans("general.contact-person")}}</label>
                                        <input class="form-control" type="text" name="contact_name" value="{{$jobMarket->contact->name}}" required>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>{{trans("general.company-name")}}</label>
                                        <input class="form-control" type="text" name="company_name" value="{{$jobMarket->contact->company_name}}" required>
                                    </div>
                                </div>
                                <div class="col-xl-5">
                                    <div class="form-group">
                                        <label>{{trans("general.email")}}</label>
                                        <input class="form-control" type="email" name="email" value="{{$jobMarket->contact->email}}" required>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>{{trans("general.phone")}}</label>
                                        <input class="form-control" type="text" name="telephone" value="{{$jobMarket->contact->telephone}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-10 form-group">
                            <label for="">{{trans("general.tasks")}}</label>
                            <textarea name="details" class="js-summernote"
                                      required>{!! $jobMarket->details !!}</textarea>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full border-t mt-4">
                    <div class="float-sm-left">
                        <button type="button"
                                data-delete-form-id="#deleteForm"
                                class="btn bg-gray text-white btn-noborder px-30 font-italic delete-button">{{trans("general.remove-ad")}}</button>
                    </div>
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
        <form id="deleteForm" action="{{route("admin.bulletin-board.job-market.destroy",$jobMarket->id)}}"
              method="POST">
            @csrf
            @method("delete")
        </form>
    </div>
    <!-- END Page Content -->
@endsection
@push("scripts")
    <script src="{{asset("/js/admin/pages/general.app.js")}}"></script>
    @include("plugins.jquery-validate")
    @include("plugins.editor")
    @include("layouts.partials.deleteConfirmation")
@endpush