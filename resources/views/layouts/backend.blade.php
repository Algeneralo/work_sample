<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{env('APP_Name')}}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    @include('layouts.partials.header-styles')
</head>
<body>
<div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-modern main-content-boxed">


@includeIf("layouts.partials.sidebar")
<!-- END Sidebar -->

    <!-- Header -->
@includeIf("layouts.partials.header")
<!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        @yield('content')
    </main>

</div>
<!-- END Page Container -->
</body>
@include('layouts.partials.header-scripts')

</html>
