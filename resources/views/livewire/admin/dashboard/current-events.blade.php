<div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        {{trans("general.current-events")}}
                    </th>
                    <td class="font-italic border-0">
                        {{--                        {{trans("general.time")}}--}}

                        {{--                        <span class="text-lowercase"> {{trans("general.from-to")}}</span>--}}
                    </td>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr>
                        <td>
                            <a class="d-block text-primary pb-2" href="{{route("admin.events.edit",$event->id)}}">
                                {{$event->name}}
                            </a>
                            <span>
                                <i class="fas fa-map-marker-alt text-primary pr-2"></i>
                                {!! $event->address !!}
                            </span>
                        </td>
                        <td class="text-gray">
                            {{$event->date->format("d.m.Y")}}
                            <br>
                            {{$event->from_to_time}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">{{trans("general.no-data-found")}}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{--    <div class="table-pagination">--}}
    {{--        {{$events->links()}}--}}
    {{--    </div>--}}
</div>
