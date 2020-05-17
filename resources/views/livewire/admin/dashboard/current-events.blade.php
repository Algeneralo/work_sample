<div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        {{trans("general.current-events")}}
                    </th>
                    <td class="font-italic border-0">
                        {{trans("general.time")}}

                        {{trans("general.from-to")}}
                    </td>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr>
                        <td>
                            <span class="d-block text-primary pb-2">
                                Lorem ipsum dolor sit amet, consetetur
                            </span>
                            <span>
                                <i class="fas fa-map-marker-alt text-primary pr-2"></i>
                                Lorem ipsum dolor sit amet onsetetur
                            </span>
                        </td>
                        <td class="text-gray">10:15 Uhr - 11:15 Uhr</td>
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
