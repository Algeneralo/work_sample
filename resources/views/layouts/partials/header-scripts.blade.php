@include('layouts.partials.lang-script')
@yield("js_before")

<!-- Laravel Scaffolding JS -->
<script src="{{ asset('js/laravel.app.js') }}"></script>
<!-- Codebase Core JS -->
<script src="{{ asset('js/codebase.app.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{asset("/js/plugins/bootstrap-notify/bootstrap-notify.min.js")}}"></script>
<script type="text/javascript" src="https://unpkg.com/lightpick@latest/lightpick.js"></script>
{{--<script --}}
@livewireScripts
<script src="{{ asset('js/scripts.js') }}"></script>
@yield('js_after')
@stack("scripts")
<script>window.Laravel = @json(['csrfToken' => csrf_token()])</script>
