@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content events" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        {{$topic->title}}
                    </h2>
                    <nav class="breadcrumb mb-0 pb-0 font-size-sm d-flex align-items-end">
                        <span class="breadcrumb-item">{{trans("general.subject")}}</span>
                        <span class="breadcrumb-item active">{{$topic->title}}</span>
                    </nav>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        @include("layouts.partials.validation-status")
        @include("layouts.partials.status")
        <form action="{{route("admin.forum.topics.edit",[$topic->forum_id,$topic->id])}}" class="js-validation-bootstrap"
              enctype="multipart/form-data"
              method="POST">
            @csrf
            @method("PUT")
            <div class="row">
                <div class="col-xl-12">
                    <div class="block">
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for=""></label>
                                    <image-previewer
                                            :name="'image'"
                                            :src="'{{$topic->cover}}'"
                                            :class="'img-fluid'"
                                    ></image-previewer>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>{{trans("general.title")}}</label>
                                        <input type="text" name="title" value="{{$topic->title}}" class="form-control"
                                               required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-xl-8 form-group">
                                    <label for="">@lang("general.description")</label>
                                    <textarea name="details" class="js-summernote"
                                              required>{!! $topic->details !!}</textarea>
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
                </div>
            </div>
        </form>
    </div>
    <!-- END Page Content -->
@endsection
@push("scripts")
    <script src="{{asset("/js/admin/pages/event.app.js")}}"></script>
    @include("plugins.jquery-validate")
    @include("plugins.editor")
    @include("plugins.select2")
    <script>
        let maxParticipants = $("[name='max_participants']");
        maxParticipants.on("change", function () {
            console.log("works")
            let number = $(this).val();
            if (number)
                $('[name="participants"]').rules("add", {maxParticipantsCount: number})
            else
                $('[name="participants"]').rules("remove", "maxParticipantsCount")

        })
        maxParticipants.trigger("change")
    </script>
@endpush