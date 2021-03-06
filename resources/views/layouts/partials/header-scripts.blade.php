@include('layouts.partials.lang-script')
@include('layouts.partials.js-route-helper')
@yield("js_before")
@livewireScripts

<!-- Laravel Scaffolding JS -->
<script src="{{ asset('js/laravel.app.js') }}"></script>
<!-- Codebase Core JS -->
<script src="{{ asset('js/codebase.app.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{asset("/js/plugins/bootstrap-notify/bootstrap-notify.min.js")}}"></script>
{{--<script --}}
<script src="{{ asset('js/scripts.js') }}"></script>
@yield('js_after')
@stack("scripts")
<script>window.Laravel = @json(['csrfToken' => csrf_token()])</script>
