@extends('layouts.backend')
@section('content')
    <!-- Page Content -->
    <div class="content events" id="responsive_headline">
        <div class="content-heading">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class="font-size-38 text-primary font-weight-normal">
                        Grubenfahrt & Trainingsbergwerk
                    </h2>
                    <nav class="breadcrumb mb-0 pb-0 font-size-sm d-flex align-items-end">
                        <span class="breadcrumb-item">{{trans("general.event")}}</span>
                        <span class="breadcrumb-item active">Grubenfahrt & Trainingsbergwerk</span>
                    </nav>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <form action="" class="js-validation-bootstrap" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-8">
                    <div class="block">
                        <div class="block-content">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for=""></label>
                                    <image-previewer
                                            :src="'{{asset("/media/church.png")}}'"
                                            :class="'img-fluid'"
                                    ></image-previewer>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>{{trans("general.event-name")}}</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans("general.event-date")}}</label>

                                        <div class="row">
                                            <div class="col-6 pr-0">
                                                <date-picker v-model="date" valueType="format"
                                                             input-class="form-control"
                                                             :input-attr="{name:'date',required:'required'}"
                                                             placeholder="{{trans("general.date")}}"
                                                             :default-value="new Date(2018, 11, 24, 10, 33, 30, 0)"
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
                                        <input type="number" name="" class="form-control" data-rule-min="1"
                                               data-rule-number="true" required>
                                    </div>
                                    <address-component></address-component>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 form-group">
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
                    @livewire("admin.events.participants-list",["isEdit"=>true,"selectedParticipants"=>\App\User::get()->take(5)])
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
@endpush