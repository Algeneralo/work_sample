<div>
    <div class="block participants">
        <div class="block-content">
            <label class="border-b border-b-dashed pb-10 w-100 text-black">
                @if(!$isEdit)
                    {{trans("general.add-participants")}}
                @else
                    {{trans("general.count-participants",["count"=>count($selectedParticipants)])}}
                @endif

            </label>
            <div class="form-group">
                <div class="inner-addon right-addon">
                    <i class="fa fa-search text-gray"></i>
                    <input wire:model="search" type="text" class="form-control"
                           onfocus="addOpenClass()" onfocusout="removeOpenClass()" formnovalidate/>
                    <div id="dropdown" class="select2-dropdown {{$open?'open':''}}">
                        <div class="select2-results">
                            <ul class="select2-results__options">
                                @forelse($participants as $item)
                                    <li class="select2-results__option px-10" wire:key="{{ $loop->index }}"
                                        wire:click="select({{$item["id"]}})">
                                        <div class="select2-results__option-wrapper">
                                            <img src="{{asset("/media/user.jpg")}}" width="40" height="40"
                                                 class="rounded-circle mr-10">
                                            {{$item->name}}
                                        </div>
                                    </li>
                                @empty
                                    <li class="select2-results__option px-10">
                                        <div class="select2-results__option-wrapper">
                                            {{trans("general.no-result")}}
                                        </div>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group">
                @forelse($selectedParticipants as $item)
                    <div class="bg-participant px-10 py-5 rounded mt-3">
                        <img src="{{asset("/media/user.jpg")}}" width="40" height="40"
                             class="rounded-circle mr-10">
                        {{$item["name"]}}
                        <span class="text-right float-right mt-10"
                              wire:click="unSelect({{$item["id"]}})">
                            <i class="fa fa-times"></i>
                        </span>
                    </div>
                @empty
                    {{trans("general.no-participant-selected")}}
                @endforelse
                <input type="hidden" name="participants"
                       value="{{count($selectedParticipants)>0?json_encode(array_keys($selectedParticipants)):''}}"
                       required>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function addOpenClass() {
            document.getElementById('dropdown').classList.add('open')
        }

        function removeOpenClass(e) {
            setTimeout(function () {
                document.getElementById('dropdown').classList.remove('open')
            }, 200);
        }
    </script>
@endpush