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
            width: 75%;
        }

        .subjects .nav-link .subject-card .icon {
            width: 25%;
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
    <div class="row position-relative">
        <div class="loading" wire:loading wire:target="insertComment"></div>
        <div class="col-12">
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
                <div class="block-content px-0 position-relative">
                    <ul role="tablist" class="nav nav-tabs subjects border-0">
                        <div class="loading" wire:loading wire:target="search"></div>
                        @forelse($topics as $item)
                            <li class="nav-item">
                                <a class="nav-link @if(check_last_active_topic_tab($loop->first,$item->id)) active @endif"
                                   id="home-tab" data-toggle="tab"
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
                                            <div class="icon" wire:ignore>
                                                <div class="text-primary delete-button" data-id="{{$item->id}}"
                                                     wire:key="{{rand() * $item->id }}">
                                                    <i class="fa fa-trash-o font-size-xl"></i>
                                                </div>
                                                <div>
                                                    <span data-toggle="collapse" href="#insertCommentCollapse"
                                                          role="button" aria-expanded="false"
                                                          aria-controls="insertCommentCollapse">
                                                        <img src="{{asset("/media/icons/insert-comment.png")}}"
                                                             class="d-inline-block float-right mr-20 pr-1"
                                                             style="width: 34%;padding-right: 3px;">
                                                    </span>
                                                </div>
                                                <div class="text-primary mr-100 py-5">
                                                    <div>
                                                        <i wire:key="heart{{rand() * $item->id }}"
                                                           wire:click="toggleLike({{$item->id}})"
                                                           class="fa @if($item->isLikedBy(auth()->guard("alumni")->id())) fa-heart active @else fa-heart-o @endif  heart-button"
                                                           aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <div class="row mx-0 px-20 py-30">
                                @lang("general.no-topics")
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
                <div class="block-content p-0 position-relative">
                    <div class="tab-content">
                        {{--out taps(topics) --}}
                        <div class="loading" wire:loading wire:target="blockAlumnus,deleteComment"></div>
                        @forelse($topics as $item)
                            <div class="tab-pane @if(check_last_active_topic_tab($loop->first,$item->id)) active @endif comments"
                                 id="topic{{$item->id}}"
                                 role="tabpanel"
                                 aria-labelledby="home-tab">
                               <div wire:key="comments{{rand() * $item->id}}">
                                   <div class="collapse  p-20" id="insertCommentCollapse">
                                       <div class="border border-primary rounded px-20 pt-30 pb-10">
                                           <span class="text-primary font-w500 font-size-h5 w-100">
                                               {{$item->title}}
                                           </span>
                                           <span class="w-100 d-block text-gray-light border-b-dashed my-10"></span>
                                           <textarea class="form-control" wire:model.lazy="comment"
                                                    ></textarea>
                                           <button class="btn btn-primary float-right mt-10"
                                                   wire:click="insertComment({{$item->id}})">@lang("general.send")</button>
                                           <div class="clearfix"></div>
                                       </div>
                                   </div>
                               </div>

                                @forelse($item->comments as $comment)
                                    <div class="row mx-0 px-20 py-30 @if($loop->index%2) bg-body @endif">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10">
                                            <div class="float-left">
                                                {{$comment ->created_at->diffForHumans()}}
                                            </div>
                                            <div class="float-right">
                                                <div class="text-primary">
                                                    <div>
                                                        <i wire:key="heart2{{rand() * $comment->id }}"
                                                           wire:click="toggleCommentLike({{$comment->id}})"
                                                           class="fa @if($comment->isLikedBy(auth()->guard("alumni")->id())) fa-heart active @else fa-heart-o @endif  heart-button"
                                                           aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                                <div class="d-inline-block">
                                                    @if(auth()->id()!=$comment['alumnus']['id'])
                                                        <a href="#"
                                                           wire:click.prevent="blockAlumnus({{$comment['alumnus']['id']}},{{$item->id}})"
                                                           wire:key="{{rand() *( $comment->id+rand())}}"
                                                           class="btn btn-noborder btn-outline-dark font-italic text-black">
                                                            {{trans("general.users")}} {{trans_choice("general.deactivate",$comment['alumnus']['blocked'])}}
                                                        </a>
                                                    @endif
                                                </div>
                                                <a href="#" data-id="{{$comment->id}}" data-custom-event="deleteComment"
                                                   wire:key="{{rand() * $comment->id}}"
                                                   class="btn bg-gray text-white delete-button">
                                                    {{trans("general.delete-post")}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="row mx-0 px-20 py-30">
                                        @lang("general.no-messages")
                                    </div>
                                @endforelse
                            </div>
                        @empty
                            <div class="row mx-0 px-20 py-30">
                                @lang("general.no-messages")
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mo-js/0.288.2/mo.min.js"></script>
    <script>
        $(document).ready(function () {

            $(document).on("click", ".heart-button", function () {
                let timeline = createTimeLine($(this)[0])
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    $(this).removeClass('fa-heart');
                    $(this).addClass('fa-heart-o');
                } else {
                    timeline.play();
                    $(this).addClass('active');
                    $(this).addClass('fa-heart');
                    $(this).removeClass('fa-heart-o');
                }
            });

            function createTimeLine(el) {
                var scaleCurve = mojs.easing.path('M0,100 L25,99.9999983 C26.2328835,75.0708847 19.7847843,0 100,0');
                timeline = new mojs.Timeline(),
                    tween1 = new mojs.Burst({
                        parent: el,
                        radius: {0: 100},
                        angle: {0: 45},
                        y: -10,
                        count: 10,
                        radius: 100,
                        children: {
                            shape: 'circle',
                            radius: 30,
                            fill: ['red', 'white'],
                            strokeWidth: 15,
                            duration: 500,
                        }
                    });

                tween2 = new mojs.Tween({
                    duration: 900,
                    onUpdate: function (progress) {
                        var scaleProgress = scaleCurve(progress);
                        el.style.WebkitTransform = el.style.transform = 'scale3d(' + scaleProgress + ',' + scaleProgress + ',1)';
                    }
                });
                tween3 = new mojs.Burst({
                    parent: el,
                    radius: {0: 100},
                    angle: {0: -45},
                    y: -10,
                    count: 10,
                    radius: 125,
                    children: {
                        shape: 'circle',
                        radius: 30,
                        fill: ['black', 'red'],
                        strokeWidth: 15,
                        duration: 400,
                    }
                });
                timeline.add(tween1, tween2, tween3);

                return timeline;
            }
        });
    </script>
@endpush