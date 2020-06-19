@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content events" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        {{trans("general.event")}}
                    </h2>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        @include("layouts.partials.validation-status")
        <form action="{{route("admin.events.store")}}" class="js-validation-bootstrap" method="POST"
              enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-8">
                    <div class="block">
                        <div class="block-header bg-primary rounded-top">
                            <h3 class="text-white font-weight-light font-size-h3 mb-0">{{trans("general.new-event")}}</h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-6 col-xl-5">
                                    <div class="form-group">
                                        <label>{{trans("general.event-name")}}</label>
                                        <input type="text" name="name" class="form-control" value="{{old("name")}}"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans("general.event-date")}}</label>

                                        <div class="row">
                                            <div class="col-6 pr-0">
                                                <date-picker v-model="date" valueType="format"
                                                             input-class="form-control"
                                                             :input-attr="{name:'date',required:'required'}"
                                                             placeholder="{{trans("general.date")}}"
                                                             :disabled-date="disabledDates"
                                                             format="DD.MM.YYYY">
                                                    <i slot="icon-calendar"></i>
                                                </date-picker>
                                            </div>
                                            <div class="col-6 pl-0">
                                                <date-picker v-model="time" valueType="format"
                                                             input-class="form-control"
                                                             :input-attr="{name:'time',required:'required'}"
                                                             type="time"
                                                             :minute-options="minutes"
                                                             range
                                                             placeholder="{{trans("general.time")}}"
                                                             format="HH:mm">
                                                    <div class="row" slot="header">
                                                        <div class="col-6">{{trans("general.start-time")}}</div>
                                                        <div class="col-6 pl-0">{{trans("general.end-time")}}</div>
                                                    </div>
                                                </date-picker>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">@lang("general.category")</label>
                                        <select class="form-control select2" name="category_id">
                                            @foreach($categories as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-5">
                                    <div class="form-group">
                                        <label>{{trans("general.Number of participants")}}</label>
                                        <input type="number" name="max_participants" class="form-control"
                                               data-rule-min="1"
                                               data-rule-number="true">
                                    </div>
                                    <address-component
                                            :street="'{{old("street")}}'"
                                            :streetNumber="'{{old("street_number")}}'"
                                            :postcode="'{{old("postcode")}}'"
                                            :city="'{{old("city")}}'">
                                    </address-component>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="">@lang("general.event-details")</label>
                                    <textarea name="details" class="js-summernote"
                                              required>{!! old("details") !!}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-5">
                                    <div>
                                        <label for="" class="border-b w-100 mb-4"
                                               style="border-bottom-style: dashed !important;">{{trans("general.image-upload")}}</label>
                                        <image-uploader :name="'image'"></image-uploader>
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
                </div>
                <div class="col-xl-4">
                    @livewire("admin.events.participants-list")
                </div>
            </div>
        </form>
    </div>
    <!-- END Page Content -->
@endsection
@push("scripts")
    <script src="{{asset("/js/admin/pages/event.app.js")}}"></script>
    <script>
        $("[name='max_participants']").on("change", function () {
            let number = $(this).val();
            if (number)
                $('[name="participants"]').rules("add", {maxParticipantsCount: number})
            else
                $('[name="participants"]').rules("remove", "maxParticipantsCount")

        })
    </script>
    @include("plugins.jquery-validate")
    @include("plugins.editor")
    @include("plugins.select2")
@endpush