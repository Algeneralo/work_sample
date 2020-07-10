@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content forum" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        {{$forum->designation}}
                    </h2>
                    <nav class="breadcrumb mb-0 pb-0 font-size-sm d-flex align-items-end">
                        <span class="breadcrumb-item">{{trans("general.forum")}}</span>
                        <span class="breadcrumb-item active">{{$forum->designation}}</span>
                    </nav>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        @include("layouts.partials.validation-status")
        @include("layouts.partials.status")
        <form action="{{route("admin.forum.edit",[$forum->id])}}" class="js-validation-bootstrap"
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
                                            :src="'{{$forum->cover}}'"
                                            :class="'img-fluid'"
                                    ></image-previewer>
                                </div>
                                <div class="col-xl-3">
                                    <div class="form-group">
                                        <label>{{trans("general.designation")}}</label>
                                        <input class="form-control" type="text" name="designation"
                                               value="{{$forum->designation}}" required>
                                    </div>
                                </div>
                                <div class="col-xl-3">
                                    <div class="form-group">
                                        <label>@lang("general.eligibility-for-new-posts")</label>
                                        <select name="posts_type" class="form-control select2">
                                            <option value="{{\App\Models\Forum::POST_TYPES_ADMINS}}"
                                                    @if($forum->posts_type==\App\Models\Forum::POST_TYPES_ADMINS) selected @endif
                                                    >@lang("general.for-admins")</option>
                                            <option value="{{\App\Models\Forum::POST_TYPES_ALL_USERS}}"
                                                    @if($forum->posts_type==\App\Models\Forum::POST_TYPES_ALL_USERS) selected @endif
                                            >@lang("general.for-all-users")</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8 form-group">
                                    <label for="">@lang("general.description")</label>
                                    <textarea name="details" class="js-summernote"
                                              required>{!! $forum->details !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full border-t mt-4">
                            <div class="float-sm-right">
                                <button type="reset"
                                        class="btn btn-outline-primary btn-noborder font-italic">{{trans("general.reset")}}</button>
                                <button type="submit"
                                        class="btn btn-primary px-30">{{trans("general.update")}}</button>
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
    <script src="{{asset("/js/admin/pages/forum.app.js")}}"></script>
    @include("plugins.jquery-validate")
    @include("plugins.editor")
    @include("plugins.select2")
@endpush