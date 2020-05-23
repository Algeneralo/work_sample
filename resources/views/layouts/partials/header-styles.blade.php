<link rel="shortcut icon" href="{{ asset('media/favicons/favicon.svg') }}">
<link rel="icon" sizes="192x192" type="image/svg" href="{{ asset('media/favicons/favicon.svg') }}">

@yield('css_before')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css"
      rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/css/codebase.css') }}">
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/css/bootstrap4-toggle.min.css">
@livewireStyles
@yield('css_after')
