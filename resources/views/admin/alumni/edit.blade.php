@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content alumni" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        Irina Iriser Nikolaus
                    </h2>
                    <nav class="breadcrumb mb-0 pb-0 font-size-sm d-flex align-items-end">
                        <span class="breadcrumb-item">{{trans("general.alumni")}}</span>
                        <span class="breadcrumb-item active">Irina Iriser Nikolaus</span>
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
                            <image-previewer :image-class="'rounded-circle border border-4x border-primary mr-10'"
                                             :src="'{{asset("/media/user.jpg")}}'"
                                             :width="'100'"
                                             :height="'100'"
                            ></image-previewer>
                        </div>
                        <div class="col-xl-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans("general.first-name")}}</label>
                                        <input type="text" name="first_name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans("general.last-name")}}</label>
                                        <input type="text" name="last_name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12">{{trans("general.gender")}}</label>
                                <div class="col-12">
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" id="gender-radio1"
                                               value="f" checked="" name="gender" required>
                                        <label class="custom-control-label"
                                               for="gender-radio1">{{trans("general.women")}}</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio"
                                               id="gender-radio-radio2" value="m" name="gender" required>
                                        <label class="custom-control-label"
                                               for="gender-radio-radio2">{{trans("general.man")}}</label>
                                    </div>
                                </div>
                            </div>
                            <address-component></address-component>
                            <div class="form-group">
                                <label>{{trans("general.email")}}</label>
                                <input class="form-control" type="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.phone")}}</label>
                                <input type="text" class="form-control"
                                       name="phone" required>
                            </div>
                        </div>
                        <div class="col-xl-3">

                            <div class="form-group">
                                <label>{{trans("general.mobile")}}</label>
                                <input type="text" class="form-control"
                                       name="mobile" required>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.dob")}}</label>
                                <date-picker v-model="dob" valueType="format" input-class="form-control"
                                             :input-attr="{name:'dob',required:'required'}"
                                             format="DD.MM.YYYY"></date-picker>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.university")}}</label>
                                <select class="select2 w-100" name="university">
                                    <option value="">Ruhr-Universität Bochum</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.degree-program")}}</label>
                                <select class="select2 w-100" name="degree_program">
                                    <option value="Maschinenbau">Maschinenbau</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.Select alumni year")}}</label>
                                <date-picker v-model="alumniYear" valueType="format" input-class="form-control"
                                             :input-attr="{name:'alumni_year',required:'required'}" format="YYYY"
                                             type="year"></date-picker>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label>{{trans("general.description")}}</label>
                                <textarea name="description" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full border-t">
                    <div class="float-sm-left">
                        <button @click.prevent=""
                                class="btn bg-gray text-white">{{trans("general.users")}} {{trans("general.deactivate")}}</button>
                        <button @click.prevent=""
                                class="btn btn-outline-secondary btn-noborder px-30 font-italic">{{trans("general.users")}} {{trans("general.delete")}}</button>
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
        <div class="block">
            <div class="block-header">
                <h3 class="font-weight-light border-b text-gray-dark w-100 pb-2">
                    {{trans("general.overview-of-attended-events")}}
                </h3>
            </div>
            <div class="block-content pt-0">
                <div class="row">
                    @for($counter=0;$counter<10;$counter++)
                        <div class="col-xl-6">
                            <div class="rounded border py-10 px-15 mb-2">
                                <span class="d-block text-black pb-2">Tipps für eigene Gedanken</span>
                                <span class="d-block text-gray">25.02.2020</span>
                            </div>
                        </div>
                        <div class="col-xl-6"></div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
@push("scripts")
    <script src="{{asset("/js/admin/pages/alumni.app.js")}}"></script>
    @include("plugins.jquery-validate")
    @include("plugins.select2")
@endpush