<div>
    <div class="block">
        <div class="block-header border-b pb-2 pt-2 d-block d-md-flex">
            <div class="block-title d-md-flex" wire:ignore>
                <div class="select-wrapper bg-select-white">
                    <select class="select2 perPage" wire:model="perPage">
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <span class="vertical-separator"></span>
                <div class="select-wrapper bg-select-white">
                    <select class="select2 lastMonth" wire:model="lastMonth">
                        <option value="3" selected>{{trans("general.last-months",["month"=>3])}}</option>
                        <option value="6">{{trans("general.last-months",["month"=>6])}}</option>
                    </select>
                </div>
                <span class="vertical-separator"></span>
                <div class="select-wrapper bg-select-white">
                    <select class="select2 category" wire:model="category">
                        <option value="all" selected>{{trans("general.category")}}</option>
                        <option value="1">Workshops</option>
                        <option value="1">Seminare</option>
                        <option value="1">Exkursionen</option>
                        <option value="1">Veranstaltungstipps</option>
                    </select>
                </div>
            </div>
            <div class="block-option">
                <div class="input-group bg-white rounded text-primary mt-4 mt-md-auto">
                    <div class="input-group-append">
                        <div onclick="document.getElementById('search').focus()"
                             class="d-flex pt-10 pr-5 link-effect" role="button">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <input id="search" type="text" class="search form-control border-0 border-l pt-0"
                           wire:model="search"
                           placeholder="Hier Suchtext eingeben...">
                </div>
            </div>
        </div>
        <div class="block-content p-0">
            <div class="table-responsive">
                <table class="table table-hover mt-1">
                    <thead class="bg-gray-lighter">
                        <tr>
                            <th>
                                <a wire:click.prevent="sortBy('id')" role="button" href="#">
                                    {{trans("general.number")}}
                                    @include('layouts.partials._sort-icon', ['field' => 'id'])
                                </a>
                            </th>
                            <th>
                                <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                                    {{trans("general.date")}}
                                    @include('layouts.partials._sort-icon', ['field' => 'created_at'])
                                </a>
                            </th>
                            <th>
                                <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                                    {{trans("general.time")}}
                                    {{trans("general.from-to")}}
                                    @include('layouts.partials._sort-icon', ['field' => 'from-to'])
                                </a>
                            </th>
                            <th>
                                <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                                    {{trans("general.designation")}}
                                    @include('layouts.partials._sort-icon', ['field' => 'from-to'])
                                </a>
                            </th>
                            <th>
                                <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                                    {{trans("general.category")}}
                                    @include('layouts.partials._sort-icon', ['field' => 'category'])
                                </a>
                            </th>
                            <th>
                                {{trans("general.action")}}
                            </th>
                        </tr>
                    </thead>
                    @forelse($events as $item)
                        <tbody>
                            <tr>
                                <td class="text-primary">{{$loop->iteration}}</td>
                                <td>05.04.2020</td>
                                <td>09:30 Uhr - 10:30 Uhr</td>
                                <td>Grubenfahrt & Trainingsbergwerk</td>
                                <td>Veranstaltungen</td>
                                <td>
                                    <a href="{{route("admin.events.edit",$item->id)}}">
                                        <i class="fas fa-cog text-primary"></i>
                                        <span class="font-italic">{{trans("general.edit")}}</span>
                                    </a>
                                    <a href="#" class="delete-button" data-id="1">
                                        <i class="fa fa-trash text-primary"></i>
                                        <span class="font-italic">{{trans("general.delete")}}</span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">{{trans("general.no-data-found")}}</td>
                        </tr>
                    @endforelse
                </table>
            </div>
            <div class="table-pagination">
                {{$events->links()}}
            </div>
        </div>
    </div>
</div>
@push("scripts")
    @include('plugins.select2')
    @include('plugins.select2-livewire-filters')
@endpush