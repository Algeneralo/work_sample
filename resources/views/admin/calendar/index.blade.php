@extends("layouts.backend")
@section("css_after")
    <link rel="stylesheet" href="{{asset('/css/calendar.all.css')}}"/>
@endsection
@section("content")
    <div class="content">
        <div class="content-heading">
            <h2 class="font-size-38 text-primary font-w600 d-inline-block">
                Kalender
            </h2>
            <a id="newEvent" href="#"
               class="float-right btn btn-primary px-20 py-10 d-flex align-items-center text-left">
                <i class="fas fa-plus"></i>
                Termin hinzufügen
            </a>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <div class="col-xl-9 order-2 order-xl-1">
                <div class="block rounded main-block">
                    <div id="example" class="k-content">

                        <div id="scheduler"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 filters order-1 order-xl-2">
                <div class="block">
                    <div class="block rounded">
                        <div class="block-content p-0">
                            <select id="employeesFilter" class="form-control select2" style="width: 100%">
                                <option value="all" selected>{{trans("general.all-events")}}</option>

                            </select>
                        </div>
                    </div>
                    @for($counter=0;$counter<3;$counter++)
                        <div class="row mr-15 mt-15">
                            <div class="col-4 d-flex pr-1">
                                <img src="{{asset("/media/barn.jpg")}}" alt="" class="img-fluid rounded-left"
                                     style="object-fit: cover">
                            </div>
                            <div class="col-8 text-white rounded-right" style="background-color: #FFB84A">
                                <div>
                                    <span class="float-left font-size-xs w-50">04.01.2020</span>
                                    <span class="float-right font-size-xs w-50">11:00 Uhr - 12:00 Uhr</span>
                                    <div class="clearfix"></div>
                                </div>
                                Angewandte Freizeitwissenschaft
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <script id="event-template" type="text/x-kendo-template">
        <div title="11:00-12:00 - Angewandte Freizeitwissenschaft">
            11:00-12:00 - Angewandte
            Freizeitwissenschaft
        </div>
    </script>
@endsection
@section("js_after")
    <script src="{{asset("/js/kendo.all.min.js")}}"></script>
    <script src="https://kendo.cdn.telerik.com/2020.1.114/js/kendo.timezones.min.js"></script>
    <script src="{{asset("/js/localization/kendo.messages.de-DE.js")}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-range/4.0.2/moment-range.js"></script>
    <script src="https://rawgithub.com/gf3/moment-range/v0.1.7/lib/moment-range.js"></script>
    <script src="{{asset('/js/localization/kendo.culture.de-DE.min.js')}}"></script>
    <script src="http://cdn.kendostatic.com/2013.2.716/js/cultures/kendo.culture.de-DE.min.js"></script>

    <script src="{{asset("/js/calendar.app.js")}}"></script>
@endsection
