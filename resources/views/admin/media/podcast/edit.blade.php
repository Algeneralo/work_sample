@extends('layouts.backend')
@section("css_after")
    <style>
        .voice-box a {
            width: 20px;
            height: 20px;
            background-color: #c4c4c4;
            position: absolute;
            right: 14%;
            top: 2%;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            border-color: #707070;
            color: white !important;
        }

        .voice-name {
            word-break: break-all;
        }
    </style>
@endsection
@section('content')
    <!-- Page Content -->
    <div class="content medias" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        {{trans("general.media")}}
                    </h2>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        @include("layouts.partials.status")
        @include("layouts.partials.validation-status")
        <form action="{{route("admin.media.podcast.update",$podcast->id)}}" class="js-validation-bootstrap"
              enctype="multipart/form-data"
              method="POST">
            @csrf
            @method("PUT")
            <div class="block">
                <div class="block-content">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="row">

                                <div class="col-md-3 col-xl-3">
                                    <image-previewer :image-class="'rounded'"
                                                     :src="'{{$podcast->cover}}'"
                                                     :width="'160'"
                                                     :height="'160'"
                                    ></image-previewer>
                                </div>
                                <div class="col-md-6 col-xl-5">
                                    <div class="form-group">
                                        <label>{{trans("general.subject")}}</label>
                                        <input type="text" name="title" class="form-control" value="{{$podcast->title}}"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group mt-30">
                                    <label for="">{{trans("general.description")}}</label>
                                    <textarea name="details" class="js-summernote"
                                              required>{!! $podcast->details !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div>
                                <label for="" class="border-b w-100 mb-4"
                                       style="border-bottom-style: dashed !important;">{{trans("general.audio-upload")}}</label>
                                <voice-uploader :required="'false'"></voice-uploader>
                            </div>
                            <div class="row mt-20">
                                @foreach($podcast->getMedia("podcast") as $item)
                                    <div class="voices-preview col-4 col-sm-3 col-xl-4">
                                        <div class="voice-wrapper">
                                            <div class="border rounded text-gray voice-box d-flex justify-content-center px-20 py-30"
                                                 style=" color: rgba(90, 90, 88, 0.2) !important;">
                                                <i class="fa fa-microphone font-size-50"></i>
                                            </div>
                                            <span class="voice-name">{{$item->file_name}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full border-t mt-20">
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
    <script src="{{asset("/js/admin/pages/media.app.js")}}"></script>
    @include("plugins.jquery-validate")
    @include("plugins.editor")
@endpush