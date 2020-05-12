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
        <form action="" class="js-validation-bootstrap" enctype="multipart/form-data">
            <div class="block">
                <div class="block-content">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="row">

                                <div class="col-md-3 col-xl-3">
                                    <image-previewer :image-class="'rounded'"
                                                     :src="'{{asset("/media/barn.jpg")}}'"
                                                     :width="'160'"
                                                     :height="'160'"
                                    ></image-previewer>
                                </div>
                                <div class="col-md-6 col-xl-5">
                                    <div class="form-group">
                                        <label>{{trans("general.subject")}}</label>
                                        <input type="text" name="subject" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group mt-30">
                                    <label for="">{{trans("general.description")}}</label>
                                    <textarea name="details" class="js-summernote" required>
                                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                                                               sed diam nonumy eirmod tempor invidunt ut MEHR dolore
                                                               magna aliquyam erat, sed diam voluptua. At vero eos et
                                                               accusam et justo duo dolores et ea rebum. Stet clita kasd
                                                               gubergren, no sea takimata sanctus est Lorem ipsum dolor
                                                               sit amet.
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div>
                                <label for="" class="border-b w-100 mb-4"
                                       style="border-bottom-style: dashed !important;">{{trans("general.audio-upload")}}</label>
                                <voice-uploader></voice-uploader>
                            </div>
                            <div class="row mt-20">
                                @for($counter=0;$counter<3;$counter++)
                                    <div class="voices-preview col-4 col-sm-3 col-xl-4">
                                        <div class="voice-wrapper">
                                            <div class="border rounded text-gray voice-box d-flex justify-content-center px-20 py-30"
                                                 style=" color: rgba(90, 90, 88, 0.2) !important;">
                                                <i class="fa fa-microphone font-size-50"></i>
                                                <a type="button" class="" @click.prevent="">x</a>
                                            </div>
                                            <span class="voice-name">dolore magna .mp3</span>
                                        </div>
                                    </div>
                                @endfor
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