@section("css_after")
    <style>
        .nav-item {
            width: 100%;
        }

        .nav-link {
            padding: 0;
            font-weight: 400;
        }

        .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus {
            border-color: transparent;
        }

        .subjects .nav-link .subject-card {
            border-radius: 14px;
        }

        .subjects .nav-link .subject-card .text {
            width: 90%;
        }

        .subjects .nav-link .subject-card .icon {
            width: 10%;
        }

        .subjects .nav-link .subject-card .icon i {
            float: right;
        }

        .subjects .nav-link.active .subject-card {
            border-radius: 14px 0 0 14px !important;
            margin-right: 0 !important;
            transition: all 0.2s ease-in-out;
        }

        .subjects .nav-link.active .active-primary {
            color: #2F97DA !important;
        }

        .subjects .nav-link.active .subject-card .icon i {
            color: #2F97DA !important;
        }

        .subjects .nav-link.active .subject-card .icon .arrow:before {
            content: "\f105";
        }

        ul {
            list-style: none;
        }
    </style>
@endsection
<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="row">
        <div class="col-12">
            @include("layouts.partials.validation-status")
            @include("layouts.partials.status")
        </div>
        <div class="col-xl-4">
            <div class="block">
                <div class="block-content">
                    <div class="inner-addon right-addon">
                        <i class="fa fa-search text-gray"></i>
                        <input wire:model="search" type="text" class="form-control"
                               placeholder="{{trans("general.search-text")}}"/>
                    </div>
                </div>
                <div class="block-content px-0">
                    <ul role="tablist" class="nav nav-tabs subjects border-0">
                        @forelse($topics as $item)
                            <li class="nav-item">
                                <a class="nav-link @if(check_last_active_topic_tab($loop->first,$item->id)) active @endif" id="home-tab" data-toggle="tab"
                                   href="#topic{{$item->id}}"
                                   role="tab">
                                    <div class="bg-body subject-card mt-15 p-10 mx-20">
                                        <div class="row mx-0">
                                            <div class="text active-primary">{{$item->title}}</div>
                                            <div class="icon">
                                                <i class="fas fa-angle-down arrow"></i>
                                            </div>
                                        </div>
                                        <div class="row mx-0 mt-10">
                                            <div class="text">
                                                <span class="text-gray">{{$item->created_at->format("d.m.Y")}}</span>
                                                <span>{{count($item->comments)}} {{trans("general.contributions")}}</span>
                                            </div>
                                            <div class="icon text-primary delete-button" data-id="{{$item->id}}"
                                                 wire:key="{{ $item->id }}">
                                                <i class="fa fa-trash-o font-size-xl"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <div class="row mx-0 px-20 py-30">
                                @lang("general.no-data-found")
                            </div>
                        @endforelse
                    </ul>
                    <div class="table-pagination mt-10">
                        {{$topics->links()}}
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-8">
            <div class="block">
                <div class="block-content p-0">
                    <div class="tab-content">
                        {{--out taps(topics) --}}
                        @forelse($topics as $item)
                            <div class="tab-pane @if(check_last_active_topic_tab($loop->first,$item->id)) active @endif comments"
                                 id="topic{{$item->id}}"
                                 role="tabpanel"
                                 aria-labelledby="home-tab">
                                @forelse($item->comments as $comment)
                                    <div class="row mx-0 px-20 py-30 @if($loop->index%2) bg-body @endif">
                                        <div class="col-md-2 text-md-center">
                                            <img src="{{$comment['alumnus']['avatar']}}" alt="" width="60"
                                                 height="60"
                                                 class="rounded-circle border border-4x border-primary">
                                            <span class="text-primary d-block">{{$comment['alumnus']['name']}}</span>
                                        </div>
                                        <div class="col-md-10">
                                            <span class="d-block text-gray font-size-xs"></span>
                                            <p class="font-size-md">{{$comment->comment}}</p>
                                            <span class="font-italic font-weight-bold">
                                                {{$comment->likersCount()}} Gefällt mir-Angaben
                                            </span>

                                            <div class="float-sm-right">
                                                <a href="#"
                                                   wire:click.prevent="blockAlumnus({{$comment['alumnus']['id']}},{{$item->id}})"
                                                   wire:key="{{$comment->id+rand()}}"
                                                   class="btn btn-noborder btn-outline-dark font-italic text-black">
                                                    {{trans("general.users")}} {{trans_choice("general.deactivate",$comment['alumnus']['blocked'])}}
                                                </a>
                                                <a href="#" data-id="{{$comment->id}}" data-custom-event="deleteComment"
                                                   wire:key="{{$comment->id}}"
                                                   class="btn bg-gray text-white delete-button">
                                                    {{trans("general.delete-post")}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="row mx-0 px-20 py-30">
                                        @lang("general.no-data-found")
                                    </div>
                                @endforelse
                            </div>
                        @empty
                            <div class="row mx-0 px-20 py-30">
                                @lang("general.no-data-found")
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push("scripts")
    @include("layouts.partials.livewireDeleteConfirmation")
@endpush