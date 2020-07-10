@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content medias" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        {{trans("general.stories")}}
                    </h2>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        @include("layouts.partials.status")
        @include("layouts.partials.validation-status")
        <form action="{{route("admin.media.stories.update",$story->id)}}" class="js-validation-bootstrap"
              enctype="multipart/form-data" method="POST">
            @csrf
            @method("PUT")
            <div class="block">
                <div class="block-content">
                    <div class="row">
                        <div class="col-xl-9">
                            <div class="row">
                                <div class="col-md-6 col-xl-4">
                                    <div class="form-group">
                                        <label>{{trans("general.subject")}}</label>
                                        <input type="text" name="title" class="form-control" value="{{$story->title}}"
                                               required>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="form-group">
                                        <label>{{trans("general.linked-friends")}}</label>
                                        <select name="alumnus_id" class="form-control select2">
                                                <option value="{{$story->alumnus->id}}" selected>{{$story->alumnus->name}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group mt-30">
                                    <label for="">{{trans("general.description")}}</label>
                                    <textarea name="details" class="js-summernote"
                                              required>{!! $story->details !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            @if($story->cover_type=="video")
                                <video src="{{$story->cover}}" class="w-100" controls></video>
                            @else
                                <img src="{{$story->cover}}" alt="" class="img-fluid">
                            @endif
                            <div>
                                <label for="" class="border-b w-100 mb-4"
                                       style="border-bottom-style: dashed !important;">{{trans("general.image-upload")}}</label>
                                <image-video-uploader :required="false" :name="'image'"></image-video-uploader>
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
    @include("plugins.select2")
    <script>
        $(document).ready(function () {
            $(".select2").select2({
                maximumSelectionLength: 2,
                ajax: {
                    url: '{{route("admin.my-network.alumni.index")}}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                    cache: true
                }
            });
        });
    </script>
@endpush