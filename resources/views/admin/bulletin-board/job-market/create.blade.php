@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content general" id="responsive_headline">
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
            </div>
            <div class="clearfix"></div>
        </div>
        @include("layouts.partials.validation-status")
        <form action="{{route("admin.bulletin-board.job-market.store")}}" class="js-validation-bootstrap" method="POST"
              enctype="multipart/form-data">
            @csrf
            <div class="block">
                <div class="block-header bg-primary rounded-top">
                    <h3 class="text-white font-weight-light font-size-h3 mb-0">{{trans("general.new-job")}}</h3>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="row">
                                <div class="col-xl-5">
                                    <div class="form-group">
                                        <label>{{trans("general.employer")}}</label>
                                        <input class="form-control" type="text" name="employer" value="{{old("employer")}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans("general.category")}}</label>
                                        <input class="form-control" type="text" name="category" value="{{old("category")}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans("general.beginning")}}</label>
                                        <date-picker v-model="date" valueType="format"
                                                     input-class="form-control"
                                                     :input-attr="{name:'beginning',required:'required'}"
                                                     placeholder="{{trans("general.date")}}"
                                                     format="DD.MM.YYYY">
                                            <i slot="icon-calendar"></i>
                                        </date-picker>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>{{trans("general.job-offer")}}</label>
                                        <input class="form-control" type="text" name="offer" value="{{old("offer")}}" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>{{trans("general.city")}}</label>
                                                <input class="form-control" type="text" name="city" value="{{old("city")}}" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>{{trans("general.working-hours")}}</label>
                                                <select name="working_hours" id="" class="form-control">
                                                    <option value="full_time">{{trans("general.full-time")}}</option>
                                                    <option value="part_time">{{trans("general.part-time")}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>{{trans("general.duration")}}</label>
                                                <input class="form-control" type="text" name="duration" value="{{old("duration")}}" required>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>@lang("general.job-posting")</label>
                                                <input class="form-control" type="url" name="link" value="{{old("link")}}" required>
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
                                        <input class="form-control" type="text" name="contact_name" value="{{old("contact_name")}}" required>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>{{trans("general.company-name")}}</label>
                                        <input class="form-control" type="text" name="company_name" value="{{old("company_name")}}" required>
                                    </div>
                                </div>
                                <div class="col-xl-5">
                                    <div class="form-group">
                                        <label>{{trans("general.email")}}</label>
                                        <input class="form-control" type="email" name="email" value="{{old("email")}}" required>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>{{trans("general.phone")}}</label>
                                        <input class="form-control" type="text" name="telephone" value="{{old("telephone")}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="">{{trans("general.tasks")}}</label>
                                    <textarea name="details" class="js-summernote" required>{!! old("details") !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div>
                                <label for="" class="border-b w-100 mb-4"
                                       style="border-bottom-style: dashed !important;">{{trans("general.image-upload")}}</label>
                                <image-uploader  :required="false" :name="'image'"></image-uploader>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full border-t mt-4">
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
    <script src="{{asset("/js/admin/pages/general.app.js")}}"></script>
    @include("plugins.jquery-validate")
    @include("plugins.editor")
@endpush