<link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
<link rel="icon" sizes="192x192" type="image/png" href="{{ asset('favicons/favicon.png') }}">

@yield('css_before')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css"
      rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/css/codebase.css') }}">
<link rel="stylesheet" href="https://fengyuanchen.github.io/datepicker/css/datepicker.css">
<link rel="stylesheet" type="text/css" href="https://unpkg.com/lightpick@latest/css/lightpick.css">
<link rel="stylesheet" href="https://fengyuanchen.github.io/datepicker/css/datepicker.css">
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.5.0/css/bootstrap4-toggle.min.css">
@livewireStyles
@yield('css_after')
