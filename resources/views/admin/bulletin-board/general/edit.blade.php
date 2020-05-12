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
        <form action="{{route("admin.test")}}" class="js-validation-bootstrap" method="POST"
              enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="block">
                <div class="block-header bg-primary rounded-top">
                    <h3 class="text-white font-weight-light font-size-h3 mb-0">{{trans("general.new-general")}}</h3>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>{{trans("general.announcement-title")}}</label>
                                        <input class="form-control" type="text" name="category" required>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label>{{trans("general.designation")}}</label>
                                        <date-picker v-model="date" valueType="format" input-class="form-control"
                                                     :input-attr="{name:'date',required:'required'}"
                                                     format="DD.MM.YYYY"></date-picker>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
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
                                       style="border-bottom-style: dashed !important;">{{trans("general.image-upload")}}</label>
                                <image-uploader :name="'image'" ></image-uploader>
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