<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div class="content-header-section">
            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none" data-toggle="layout"
                    data-action="sidebar_toggle">
                <i class="fa fa-navicon"></i>
            </button>
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="content-header-section">
            <!-- User  -->
            <label class="text-gray">M. Mustermann</label>
            <img src="{{asset("/media/user.jpg")}}" width="40" height="40"
                 class="rounded-circle border border-2x border-primary mr-10">
            <!-- END User  -->
            <span class="d-inline-block mr-3"
                  style="width: 1px;border-right: 1px solid #00000029;position: absolute;top: 0;bottom: 0">
            </span>
            <!-- Notifications -->
            <div class="btn-group ml-2" role="group">
                <button type="button" class="btn btn-rounded btn-dual-secondary custom-badge"
                        id="page-header-notifications"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset("/media/icons//bell.svg")}}" alt="bell">
                    <span class="badge badge-primary badge-pill">5</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right min-width-300"
                     aria-labelledby="page-header-notifications">
                    <h5 class="h6 text-center py-10 mb-0 border-b text-uppercase">Benachrichtigungen</h5>
                    <ul class="list-unstyled my-20">
                        <li>
                            <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                <div class="ml-5 mr-15">
                                    <i class="fa fa-fw fa-check text-success"></i>
                                </div>
                                <div class="media-body pr-10">
                                    <p class="mb-0">Deutsches Ipsum Dolor sit amet, Wiener Würstchen adipiscing
                                                    elit,
                                                    sed do eiusmod Weihnachten incididunt ut labore et dolore</p>
                                    <div class="text-muted font-size-sm font-italic">Vor 15 min</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-center mb-0" href="javascript:void(0)">
                        <i class="fa fa-flag mr-5"></i>
                        {{trans("general.view-all")}}
                    </a>
                </div>
            </div>
            <!-- END Notifications -->

        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Search -->
    <div id="page-header-search" class="overlay-header">
        <div class="content-header content-header-fullrow">
            <form action="/dashboard" method="POST">
                @csrf
                <div class="input-group">
                    <div class="input-group-prepend">
                        <!-- Close Search Section -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-secondary" data-toggle="layout"
                                data-action="header_search_off">
                            <i class="fa fa-times"></i>
                        </button>
                        <!-- END Close Search Section -->
                    </div>
                    <input type="text" class="form-control" placeholder="Search or hit ESC.."
                           id="page-header-search-input" name="page-header-search-input">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Header Search -->

    <!-- Header Loader -->
    <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-primary">
        <div class="content-header content-header-fullrow text-center">
            <div class="content-header-item">
                <i class="fa fa-sun-o fa-spin text-white"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>