@extends('layouts.backend')
@section("css_after")
    <style>
        .photo a {
            width: 20px;
            height: 20px;
            background-color: white;
            position: absolute;
            right: 11%;
            top: 8%;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 5px;
            border-color: #707070;
        }
    </style>
@endsection
@section('content')
    <!-- Page Content -->
    <div class="content offer" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        {{trans("general.offer")}}
                    </h2>
                    <nav class="breadcrumb mb-0 pb-0 font-size-sm d-flex align-items-end">
                        <span class="breadcrumb-item">{{trans("general.bulletin-board")}}</span>
                        <span class="breadcrumb-item">{{trans("general.offer")}}</span>
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
                <div class="block-content">
                    <div class="row">
                        <div class="col-xl-2 d-flex justify-content-center">
                            <div class="form-group">
                                <image-previewer :image-class="'rounded-circle border border-4x border-primary mr-10'"
                                                 :src="'{{asset("/media/user.jpg")}}'"
                                                 :width="'100'"
                                                 :height="'100'"
                                ></image-previewer>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="form-group col-xl-7 px-0">
                                <label for="">{{trans("general.viewfinder")}}</label>
                                <input type="text" name="viewfinder" class="form-control" value="Christian Koepke"
                                       required>
                            </div>
                            <div class="form-group col-xl-7 px-0">
                                <input type="text" name="viewfinder" class="form-control"
                                       value="Ich suche wg zimmer in Essen" required>
                            </div>
                            <div class="form-group col-xl-11 px-0">
                                <textarea name="description" cols="30" rows="4" class="form-control">Gesamtmiete: 320€ 12 m² min. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat
                                </textarea>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label for="" class="border-b border-b-dashed pb-10 w-100">
                                    {{trans("general.uploaded-images")}}
                                </label>
                                <div class="row mx-xl-0">
                                    @for($counter=0;$counter<4;$counter++)
                                        <div class="col-sm-6 pl-xl-0 mt-15 photo">
                                            <img src="{{asset("/media/barn.jpg")}}" alt="" class="img-fluid rounded">
                                            <a type="button" class="" @click.prevent="deleteImage(1)">x</a>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full border-t">
                    <div class="float-sm-left">
                        <button @click.prevent=""
                                class="btn bg-gray text-white">{{trans("general.remove-ad")}}</button>
                        <button @click.prevent=""
                                class="btn btn-outline-secondary btn-noborder px-30 font-italic">{{trans("general.provider")}} {{trans("general.delete")}}</button>
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
    </div>
    <!-- END Page Content -->
@endsection
@push("scripts")
    <script src="{{asset("/js/admin/pages/offer.app.js")}}"></script>
    @include("plugins.jquery-validate")
@endpush