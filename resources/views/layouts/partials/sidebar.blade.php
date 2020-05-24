<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow px-15 min-height-125 my-30">
            <!-- Mini Mode -->
            <div class="content-header-section sidebar-mini-visible-b">
                <!-- Logo -->
                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                    <span class="text-dual-primary-dark">c</span>
                    <span class="text-primary">b</span>
                </span>
                <!-- END Logo -->
            </div>
            <!-- END Mini Mode -->

            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r"
                        data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times text-black"></i>
                </button>
                <!-- END Close Sidebar -->

                <!-- Logo -->
                <div class="content-header-item">
                    <a>
                        <img class="img-avatar-square" src="{{asset("/media/logo.png")}}">
                        <h5 class="text-primary text-uppercase">Alumniprogramm</h5>
                    </a>
                </div>
                <!-- END Logo -->
            </div>
            <!-- END Normal Mode -->
        </div>
        <!-- END Side Header -->

        <!-- Side User -->
        <div
                class="content-side content-side-full content-side-user px-10 align-parent d-flex justify-content-center align-items-center">
            <!-- Visible only in mini mode -->
            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
            </div>
            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center">
                <a class="img-link" href="javascript:void(0)">
                    <img class="img-avatar" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
                </a>
                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <a class="text-dual-primary-dark font-size-md font-w600 ">{{\Auth::user()->name??'M. Mustermann'}}</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark-blue"
                           onclick="event.preventDefault();"
                                {{--                                                     document.getElementById('logout-form').submit();--}}
                                {{--                           href="{{ route('logout') }}"--}}
                        >
                            <i class="si si-power font-size-xs"></i>
                        </a>
                        <form id="logout-form"
                              {{--                              action="{{ route('logout') }}"--}}
                              method="POST" style="display: none;">
                            @csrf
                        </form>

                    </li>
                </ul>
            </div>
            <!-- END Visible only in normal mode -->
        </div>
        <!-- END Side User -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main font-size-md">
                <li>
                    <a class="{{ request()->is("admin") ? ' active' : '' }}"
                       href="{{route("admin.dashboard")}}">
                        <span class="sidebar-mini-hide font-size-lg">
                            <img src="{{asset("/media/icons/window.svg")}}">
                            {{trans("routes.dashboard")}}
                        </span>
                    </a>
                </li>
                <li class="{{check_if_menu_is_active(trans("routes.my-network"),'','open') }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                        <span class="sidebar-mini-hide font-size-lg">
                            <img src="{{asset("/media/icons/share.svg")}}">
                            {{trans("general.my-network")}}
                        </span>
                    </a>
                    <ul>
                        <li>
                            <a class="{{ check_if_menu_is_active(trans("routes.alumni"),trans("routes.my-network"))}}"
                               href="{{route("admin.my-network.alumni.index")}}">
                                <span class="sidebar-mini-hide font-size-md">
                                    {{trans("general.all")}}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="{{ check_if_menu_is_active(trans("routes.team"),trans("routes.my-network"))}}"
                               href="{{route("admin.my-network.teams.index")}}">
                                <span class="sidebar-mini-hide font-size-md">
                                    {{trans("general.team")}}
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a class="{{ check_if_menu_is_active(trans("routes.event")) }}"
                       href="{{route("admin.events.index")}}">
                        <span class="sidebar-mini-hide font-size-lg">
                            <img src="{{asset("/media/icons/career.svg")}}">
                            {{trans("general.event")}}
                        </span>
                    </a>
                </li>

                <li>
                    <a class="{{ check_if_menu_is_active(trans("routes.forum")) }}"
                       href="{{route("admin.forum.index")}}">
                        <span class="sidebar-mini-hide font-size-lg">
                            <img src="{{asset("/media/icons/team.svg")}}">
                            {{trans("general.forum")}}
                        </span>
                    </a>
                </li>

                <li class="{{check_if_menu_is_active(trans("routes.bulletin-board"),'','open') }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                        <span class="sidebar-mini-hide font-size-lg">
                            <img src="{{asset("/media/icons/card.svg")}}">
                            {{trans("general.bulletin-board")}}
                        </span>
                    </a>
                    <ul>
                        <li>
                            <a class="{{ check_if_menu_is_active(trans('routes.general'),trans("routes.bulletin-board"))}}"
                               href="{{route("admin.bulletin-board.general.index")}}">
                                <span class="sidebar-mini-hide font-size-md">
                                    {{trans("general.general")}}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="{{ check_if_menu_is_active(trans('routes.job-market'),trans("routes.bulletin-board"))}}"
                               href="{{route("admin.bulletin-board.job-market.index")}}">
                                <span class="sidebar-mini-hide font-size-md">
                                    {{trans("general.job-market")}}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="{{ check_if_menu_is_active(trans('routes.offer'),trans("routes.bulletin-board"))}}"
                               href="{{route("admin.bulletin-board.offers.index")}}">
                                <span class="sidebar-mini-hide font-size-md">
                                    {{trans("general.offer")}}
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{check_if_menu_is_active(trans("routes.media"),'','open') }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                        <span class="sidebar-mini-hide font-size-lg">
                            <img src="{{asset("/media/icons/microphone.svg")}}">
                            {{trans("general.media")}}
                        </span>
                    </a>
                    <ul>
                        <li>
                            <a class="{{ check_if_menu_is_active(trans("routes.gallery"),trans("routes.media"))}}"
                               href="{{route("admin.media.gallery.index")}}">
                                <span class="sidebar-mini-hide font-size-md">
                                    {{trans("general.gallery")}}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="{{ check_if_menu_is_active(trans("routes.podcast"),trans("routes.media"))}}"
                               href="{{route("admin.media.podcast.index")}}">
                                <span class="sidebar-mini-hide font-size-md">
                                    {{trans("general.podcast")}}
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="{{ check_if_menu_is_active(trans("routes.messages")) }}"
                       href="{{route("admin.messages.index")}}">
                        <span class="sidebar-mini-hide font-size-lg">
                            <img src="{{asset("/media/icons/letter.svg")}}">
                            {{trans("general.messages")}}
                        </span>
                    </a>
                </li>
                <li>
                    <a class="{{ check_if_menu_is_active(trans("routes.calendar")) }}"
                       href="{{route("admin.calendar.index")}}">
                        <span class="sidebar-mini-hide font-size-lg">
                            <img src="{{asset("/media/icons/calendar.svg")}}">
                            {{trans("general.calendar")}}
                        </span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
