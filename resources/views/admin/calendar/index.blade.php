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
                            <select id="employeesFilter" class="form-control" style="width: 100%">
                                <option value="all" selected>{{trans("general.all-events")}}</option>
                                @foreach($events as $item)
                                    <option value="{{$item->id}}" data-color="{{$item->color}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="block-content px-0" data-toggle="slimscroll" data-height="90vh">
                        @foreach($events as $item)
                            <div class="row mr-10 mt-15">
                                <div class="col-4 d-flex pr-1">
                                    <img src="{{$item->cover}}" alt="" class="img-fluid rounded-left"
                                         style="object-fit: cover">
                                </div>
                                <div class="col-8 text-white rounded-right" style="background-color: {{$item->color}}">
                                    <div>
                                        <span class="float-left font-size-xs w-50">{{$item->date}}</span>
                                        <span class="float-right font-size-xs w-50">{{$item->from_to_time}}</span>
                                        <div class="clearfix"></div>
                                    </div>
                                    {{$item->name}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script id="event-template" type="text/x-kendo-template">
        <div title="#: title #" style="text-align: left;padding-left: .4rem;">
            #: title #
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
    @include("plugins.slimscroll")
    @include("plugins.select2")
    <script>
        $(document).ready(function () {
            //setup custom select2 option template
            function setEmployeeColor(event) {
                if (event.id === "all") {
                    return event.text;
                }
                console.log()
                let color = $(event.element).attr("data-color");
                var $eventTemplate = $('<span style="background-color:' + color + ';width: 10px;height: 10px;display: inline-block; "></span> <span>' + event.text + '</span>');
                return $eventTemplate;
            }
            //init select2 with custom option template
            $("#employeesFilter").select2({
                templateResult: setEmployeeColor,
                templateSelection: setEmployeeColor
            });
        })

    </script>
@endsection
