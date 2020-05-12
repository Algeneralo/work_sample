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
                    <ul role="tablist" class="nav nav-tabs subjects">
                        @for($counter=0;$counter<10;$counter++)
                            <li class="nav-item">
                                <a class="nav-link @if($counter==0)active @endif" id="home-tab" data-toggle="tab"
                                   href="#test{{$counter}}"
                                   role="tab">
                                    <div class="bg-body subject-card mt-15 p-10 mx-20">
                                        <div class="row mx-0">
                                            <div class="text active-primary">
                                                10 ECTS "extern" erwerben / anrechnen lassen (Wirtschaft/Accounting)
                                            </div>
                                            <div class="icon">
                                                <i class="fas fa-angle-down arrow"></i>
                                            </div>
                                        </div>
                                        <div class="row mx-0 mt-10">
                                            <div class="text">
                                                <span class="text-gray">25.02.2020</span>
                                                <span>12 {{trans("general.contributions")}}</span>
                                            </div>
                                            <div class="icon text-primary">
                                                <i class="fa fa-trash-o font-size-xl"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endfor
                    </ul>


                </div>

            </div>
        </div>
        <div class="col-xl-8">
            <div class="block">
                <div class="block-content p-0">
                    <div class="tab-content">
                        {{--out taps(topics) --}}
                        @for($counter=0;$counter<rand(1,10);$counter++)
                            <div class="tab-pane @if($counter==0) active @endif" id="test{{$counter}}" role="tabpanel"
                                 aria-labelledby="home-tab">
                                {{--post on this topic--}}
                                @for($innerCounter=0;$innerCounter<rand(1,10);$innerCounter++)
                                    <div class="row mx-0 px-20 py-30 @if($innerCounter%2) bg-body @endif">
                                        <div class="col-md-2 text-md-center">
                                            <img src="{{asset("/media/user.jpg")}}" alt="" width="60"
                                                 height="60"
                                                 class="rounded-circle border border-4x border-primary">
                                            <span class="text-primary">Sarah Nouri</span>
                                        </div>
                                        <div class="col-md-10">
                                            <span class="d-block text-gray font-size-xs">Vor 2 Stunden</span>
                                            <p class="font-size-md">
                                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                                diam nonumy
                                                eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                                                sed diam
                                                voluptua. At vero eos et accusam et justo duo dolores et ea
                                                rebum. Stet
                                                clita kasd gubergren, no sea takimata sanctus est Lorem ipsum
                                                dolor sit
                                                amet.
                                            </p>
                                            <span class="font-italic mr-2">1 Beiträge</span>
                                            <span class="font-italic font-weight-bold">5 Gefällt mir-Angaben
                                            </span>
                                            <div class="w-md-25 d-inline-block">
                                                <input type="text" class="form-control font-size-xs"
                                                       placeholder="{{trans("general.add-comment")}}">
                                            </div>
                                            <a href="#"
                                               class="btn bg-gray text-white">{{trans("general.delete-post")}}</a>
                                            <a href="#"
                                               class="font-italic text-black">{{trans("general.block-user")}}</a>
                                        </div>
                                    </div>
                                    <ul class="@if($innerCounter%2) bg-body @endif">
                                        <li>
                                            <ul class="">
                                                <li>
                                                    <div class="row mx-0 px-20 py-30">
                                                        <div class="col-md-2 text-md-center">
                                                            <img src="{{asset("/media/user.jpg")}}" alt="" width="60"
                                                                 height="60"
                                                                 class="rounded-circle border border-4x border-primary">
                                                            <span class="text-primary">Sarah Nouri</span>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <span class="d-block text-gray font-size-xs">Vor 2 Stunden
                                                            </span>
                                                            <p class="font-size-md">
                                                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                                                                sed
                                                                diam nonumy
                                                                eirmod tempor invidunt ut labore et dolore magna
                                                                aliquyam erat,
                                                                sed diam
                                                                voluptua. At vero eos et accusam et justo duo dolores et
                                                                ea
                                                                rebum. Stet
                                                                clita kasd gubergren, no sea takimata sanctus est Lorem
                                                                ipsum
                                                                dolor sit
                                                                amet.
                                                            </p>
                                                            <div class="w-md-50 d-inline-block">
                                                                <input type="text" class="form-control font-size-xs"
                                                                       placeholder="{{trans("general.add-comment")}}">
                                                            </div>
                                                            <a href="#"
                                                               class="btn bg-gray text-white">{{trans("general.delete-post")}}</a>
                                                            <a href="#"
                                                               class="font-italic text-black">{{trans("general.block-user")}}</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                @endfor
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
