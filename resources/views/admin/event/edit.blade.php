@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content events" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        {{$event->name}}
                    </h2>
                    <nav class="breadcrumb mb-0 pb-0 font-size-sm d-flex align-items-end">
                        <span class="breadcrumb-item">{{trans("general.event")}}</span>
                        <span class="breadcrumb-item active">{{$event->name}}</span>
                    </nav>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        @include("layouts.partials.validation-status")
        @include("layouts.partials.status")
        <form action="{{route("admin.events.update",$event->id)}}" class="js-validation-bootstrap"
              enctype="multipart/form-data"
              method="POST">
            @csrf
            @method("PUT")
            <div class="row">
                <div class="col-xl-8">
                    <div class="block">
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for=""></label>
                                    <image-previewer
                                            :name="'image'"
                                            :src="'{{$event->cover}}'"
                                            :class="'img-fluid'"
                                    ></image-previewer>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>{{trans("general.event-name")}}</label>
                                        <input type="text" name="name" value="{{$event->name}}" class="form-control"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans("general.event-date")}}</label>
                                        <div class="row">
                                            <div class="col-6 pr-0">
                                                <date-picker v-model="date" value-type="format"
                                                             input-class="form-control"
                                                             :input-attr='{name:"date",required:"required","data-change-v-model-value":"{\"date\":\"{{$event->date->format("d.m.Y")}}\"}"}'
                                                             placeholder="{{trans("general.date")}}"
                                                             :disabled-date="disabledDates"
                                                             format="DD.MM.YYYY">
                                                    <i slot="icon-calendar"></i>
                                                </date-picker>
                                            </div>
                                            <div class="col-6 pl-0">
                                                <date-picker v-model="time" value-type="format"
                                                             input-class="form-control"
                                                             :input-attr='{name:"time",required:"required",
                                                                     "data-change-v-model-value":"{\"time\":[\"{{$event->start_time->format("H:i")}}\",\"{{$event->end_time->format("H:i")}}\"]}"}'
                                                             type="time"
                                                             :minute-options="minutes"
                                                             range
                                                             placeholder="{{trans("general.time")}}"
                                                             format="HH:mm">
                                                    <div class="row" slot="header">
                                                        <div class="col-6">Start time</div>
                                                        <div class="col-6 pl-0">end time</div>
                                                    </div>
                                                </date-picker>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>{{trans("general.Number of participants")}}</label>
                                        <input type="number" name="max_participants" class="form-control"
                                               data-rule-min="1"
                                               value="{{$event->max_participants}}"
                                               data-rule-number="true">
                                    </div>
                                    <address-component
                                            :street="'{{$event->street}}'"
                                            :streetNumber="'{{$event->street_number}}'"
                                            :postcode="'{{$event->postcode }}'"
                                            :city="'{{$event->city}}'">
                                    </address-component>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">@lang("general.category")</label>
                                        <select class="form-control select2" name="category_id">
                                            @foreach($categories as $item)
                                                <option @if($event->category_id==$item->id) selected @endif
                                                value="{{$item->id}}
                                                        ">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">@lang("general.organizer")</label>
                                        <select class="form-control select2" name="type">
                                            <option value="{{\App\Models\Event::INTERNAL_EVENTS}}"
                                                    @if($event->type==\App\Models\Event::INTERNAL_EVENTS) selected @endif>
                                                Ruhrtalente
                                            </option>
                                            <option value="{{\App\Models\Event::EXTERNAL_EVENTS}}"
                                                    @if($event->type==\App\Models\Event::EXTERNAL_EVENTS) selected @endif>
                                                @lang("general.external")
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="">@lang("general.event-details")</label>
                                    <textarea name="details" class="js-summernote"
                                              required>{!! $event->details !!}</textarea>
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
                    @livewire("admin.events.participants-list",["isEdit"=>true,"selectedParticipants"=>$event->participants])
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