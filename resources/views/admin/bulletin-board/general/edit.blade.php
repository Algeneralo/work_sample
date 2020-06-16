@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content general" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        {{trans("general.general")}}
                    </h2>
                    <nav class="breadcrumb mb-0 pb-0 font-size-sm d-flex align-items-end">
                        <span class="breadcrumb-item">{{trans("general.bulletin-board")}}</span>
                        <span class="breadcrumb-item">{{trans("general.general")}}</span>
                    </nav>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        @include("layouts.partials.validation-status")
        @include("layouts.partials.status")
        <form action="{{route("admin.bulletin-board.general.update",$general->id)}}" class="js-validation-bootstrap"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="block">
                <div class="block-header bg-primary rounded-top">
                    <h3 class="text-white font-weight-light font-size-h3 mb-0">{{trans("general.new-general")}}</h3>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-md-2">
                            <label for=""></label>
                            <image-previewer
                                    :name="'image'"
                                    :src="'{{$general->cover}}'"
                                    :class="'img-fluid'"
                            ></image-previewer>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>{{trans("general.announcement-title")}}</label>
                                        <input class="form-control" type="text" name="title" value="{{$general->title}}"
                                               required>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>{{trans("general.date")}}</label>
                                        <date-picker v-model="date" value-type="format" input-class="form-control"
                                                     :input-attr='{name:"date",required:"required","data-change-v-model-value":"{\"date\":\"{{$general->date->format("d.m.Y")}}\"}"}'
                                                     format="DD.MM.YYYY"></date-picker>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-md-5">
                        <div class="col-md-10 form-group">
                            <label for="">{{trans("general.description")}}</label>
                            <textarea name="details" class="js-summernote"
                                      required>{!! $general->details !!}</textarea>
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
        <form id="deleteForm" action="{{route("admin.bulletin-board.general.destroy",$general->id)}}"
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