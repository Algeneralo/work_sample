@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content alumni" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        {{$alumnus->name}}
                    </h2>
                    <nav class="breadcrumb mb-0 pb-0 font-size-sm d-flex align-items-end">
                        <span class="breadcrumb-item">{{trans("general.alumni")}}</span>
                        <span class="breadcrumb-item active">{{$alumnus->name}}</span>
                    </nav>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        @includeIf("layouts.partials.status")
        @includeIf("layouts.partials.validation-status")
        <form action="{{route("admin.my-network.alumni.update",$alumnus->id)}}" class="js-validation-bootstrap"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="block">
                <div class="block-content">
                    <div class="row">
                        <div class="col-xl-2 d-flex justify-content-center">
                            <image-previewer :image-class="'rounded-circle border border-4x border-primary mr-10'"
                                             :src="'{{$alumnus->avatar}}'"
                                             :width="'100'"
                                             :height="'100'"
                            ></image-previewer>
                        </div>
                        <div class="col-xl-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans("general.first-name")}}</label>
                                        <input type="text" value="{{$alumnus->first_name}}" name="first_name"
                                               class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{trans("general.last-name")}}</label>
                                        <input type="text" value="{{$alumnus->last_name}}" name="last_name"
                                               class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12">{{trans("general.gender")}}</label>
                                <div class="col-12">
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio" id="gender-radio1"
                                               value="f" @if($alumnus->gender=='f') checked @endif name="gender"
                                               required>
                                        <label class="custom-control-label"
                                               for="gender-radio1">{{trans("general.women")}}</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline mb-5">
                                        <input class="custom-control-input" type="radio"
                                               @if($alumnus->gender=='m') checked @endif
                                               id="gender-radio-radio2" value="m" name="gender" required>
                                        <label class="custom-control-label"
                                               for="gender-radio-radio2">{{trans("general.man")}}</label>
                                    </div>
                                </div>
                            </div>
                            <address-component :street="'{{$alumnus->street}}'"
                                               :streetNumber="'{{$alumnus->street_number}}'"
                                               :postcode="'{{$alumnus->postcode }}'"
                                               :city="'{{$alumnus->city}}'"
                                               :required="false"></address-component>
                            <div class="form-group">
                                <label>{{trans("general.email")}}</label>
                                <input class="form-control" value="{{$alumnus->email}}" type="email" name="email"
                                       required>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.password")}}</label>
                                <input class="form-control" data-rule-minlength="6" type="password" name="password"
                                       autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.phone")}}</label>
                                <input type="text" class="form-control"
                                       name="telephone" value="{{$alumnus->telephone}}">
                            </div>
                        </div>
                        <div class="col-xl-3">

                            <div class="form-group">
                                <label>{{trans("general.mobile")}}</label>
                                <input type="text" class="form-control"
                                       name="mobile" value="{{$alumnus->mobile}}">
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.dob")}}</label>
                                <date-picker v-model="dob" value-type="format" input-class="form-control"
                                             :input-attr="{name:'dob','data-change-v-model-value':'{\'dob\':\'{{optional($alumnus->dob)->format('d.m.Y')}}\'}'}"
                                             :disabled-date="disabledDobDates"
                                             format="DD.MM.YYYY"></date-picker>
                            </div>
                            <div class="form-group">
                                <label>{{trans("general.Select alumni year")}}</label>
                                <date-picker v-model="alumniYear" value-type="format" input-class="form-control"
                                             :input-attr="{name:'alumni_year','data-change-v-model-value':'{\'alumniYear\':\'{{$alumnus->alumni_year}}\'}'}"
                                             format="YYYY" @change="checkYear"
                                             :default-value="'1990'"
                                             type="year"></date-picker>
                            </div>
                            <div class="form-group @if($alumnus->alumni_year>\Carbon\Carbon::now()->year) d-none @endif">
                                <label for="">@lang("general.job-title")</label>
                                <input type="text" class="form-control" name="job_title"
                                       value="{{$alumnus->job_title}}">
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <label>{{trans("general.description")}}</label>
                                <textarea name="description" cols="30" rows="4"
                                          class="form-control">{{$alumnus->description}}</textarea>
                            </div>
                            @livewire("admin.experience.index",["type" => "education","experiences" => $educationExperiences])
                            @livewire("admin.experience.index",["type" => "work","experiences" => $workExperiences])
                            @livewire("admin.experience.index",["type" => "voluntary","experiences" => $voluntaryExperiences])
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full border-t">
                    <div class="float-sm-left">
                        <button type="button" onclick="document.getElementById('activateUser').click()"
                                class="btn bg-gray text-white">{{trans("general.users")}} {{trans_choice("general.deactivate",$alumnus->blocked)}}</button>
                        <button type="button"
                                data-delete-form-id="#deleteForm"
                                class="btn btn-outline-secondary btn-noborder px-30 font-italic delete-button">{{trans("general.users")}} {{trans("general.delete")}}</button>
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
        <form action="{{route("admin.my-network.alumni.block",$alumnus->id)}}" method="POST">
            @csrf
            @method("patch")
            <input type="submit" role="button" class="d-none" id="activateUser">
        </form>
        <form id="deleteForm" action="{{route("admin.my-network.alumni.destroy",$alumnus->id)}}"
              method="POST">
            @csrf
            @method("delete")
        </form>
        <div class="block">
            <div class="block-header">
                <h3 class="font-weight-light border-b text-gray-dark w-100 pb-2">
                    {{trans("general.overview-of-attended-events")}}
                </h3>
            </div>
            <div class="block-content pt-0">
                <div class="row">
                    @forelse($alumnus->participatedEvents as $item)
                        <div class="col-xl-6">
                            <div class="rounded border py-10 px-15 mb-2">
                                <span class="d-block text-black pb-2">{{$item->name}}</span>
                                <span class="d-block text-gray">{{$item->date->format("d.m.Y")}}</span>
                            </div>
                        </div>
                        <div class="col-xl-6"></div>
                    @empty
                        <div class="col-xl-6 pb-20">
                            @lang("general.no-data-found")
                        </div>
                        <div class="col-xl-6"></div>
                    @endforelse
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
    @include("layouts.partials.deleteConfirmation")
@endpush