<div>
    <div class="row">
        <div class="col-xl-8">
            <div class="block block-rounded">
            @if($selectedThread)
                <!-- Chat Header -->
                    <div class="block-header bg-primary">
                        <div class="block-title text-white font-size-lg">
                            <img src="{{$selectedThread->receiver()->avatar}}" alt=""
                                 width="40" height="40"
                                 class="rounded-circle border border-4x border-white mr-10">
                            {{$selectedThread->receiver()->name}}
                        </div>
                    </div>
                    <!-- END Chat Header -->

                    <!-- Messages (demonstration messages are added with JS code at the bottom of this page) -->
                    <div class="block-content block-content-full text-wrap-break-word overflow-y-auto"
                         data-toggle="slimscroll" data-height="49vh" data-color="#42a5f5" data-scrollTo="0px"
                         data-start="bottom">
                        @forelse($grouped as $day=>$groupedMessages)
                            <div class="font-size-sm font-italic text-muted date">
                                {{$day}}
                            </div>
                            @foreach($groupedMessages as $item)
                                {{--todo change this to auth->id()--}}
                                @if($item->user_id!=1)
                                    <div class="p-10 mb-10 fadeIn message receiver">
                                        <div class="image">
                                            <img src="{{$selectedThread->receiver()->avatar}}" alt=""
                                                 width="60" height="60"
                                                 class="rounded-circle border border-4x border-primary mr-10">
                                        </div>
                                        <div class="details">
                                            <div class="text bg-body rounded">{{$item->body}}</div>
                                            <div class="time">{{$item->created_at->format("H:i")}}</div>

                                        </div>
                                    </div>
                                @else
                                    <div class="rounded p-10 mb-10 fadeIn message sender">
                                        <div class="text">{{$item->body}} </div>
                                        <div class="time">{{$item->created_at->format("H:i")}}</div>
                                    </div>
                                @endif
                                <div class="clearfix"></div>
                            @endforeach
                        @empty
                            <div class="d-flex justify-content-center align-items-center h-100">
                                no messages yet
                            </div>
                        @endforelse
                    </div>

                    <!-- Chat Input -->
                    <div class="block-content block-content-full block-content-sm bg-body-light">
                        <div class="logo-kopie d-none d-md-inline-flex">
                            <img src="{{asset("/media/icons/logo-kopie.png")}}" alt="">
                        </div>
                        <div class="inner-addon right-addon input">
                            <img src="{{asset("/media/icons/send.svg")}}" alt="">
                            <input class="form-control @error('message') is-invalid @enderror" type="text"
                                   name="message" wire:model.debounce.800ms="message"
                                   wire:key="{{rand() * $selectedThread->receiver()->id}}"
                                   placeholder="{{trans("general.write-new-message")}}"
                                   wire:keydown.enter="sendMessage({{$selectedThread->receiver()->id}})">
                        </div>
                    </div>
                @else
                    <div class="d-flex justify-content-center align-items-center" style="height: 50vh;">
                        you have to choose alumni first
                    </div>
            @endif

            <!-- END Chat Input -->
            </div>
        </div>


        <div class="col-xl-4">
            <div class="block">
                <div class="block-content">
                    <div class="form-group">
                        <div class="inner-addon right-addon">
                            <i class="fa fa-search text-gray"></i>
                            <input type="text" class="form-control" placeholder="{{trans("general.search-text")}}"
                                   wire:model="search"/>
                        </div>
                    </div>
                    @forelse($alumni as $item)
                        <div class="bg-participant px-10 py-5 rounded mt-3" wire:click="select({{$item->id}})"
                             wire:key="{{$item->id}}">
                            <label class="css-control css-control-primary css-checkbox css-checkbox-rounded w-100">
                                <input type="radio" class="css-control-input" name="alumni">
                                <img src="{{$item->avatar}}" width="40" height="40"
                                     class="rounded-circle mr-10">
                                {{$item->name}}
                                <span class="css-control-indicator float-right rounded-circle mt-1"></span>
                            </label>
                        </div>
                    @empty
                        @lang("general.no-data-found")
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@push("scripts")
    @include("plugins.slimscroll")
    <script>
        window.addEventListener('livewire:load', () => {
            window.livewire.hook('afterDomUpdate', () => {
                document.querySelector('[name="message"]').focus()
            });
        })
    </script>
@endpush