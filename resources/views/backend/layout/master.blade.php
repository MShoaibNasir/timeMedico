<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Time Medico</title>
    <link rel="icon" href="{{ asset('frontend/images/logo/timemedico.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="PSPC">
    <meta name="author" content="PSPC">
    <meta name="description" content="Pakistan Institute of Corporate Governance">
    <meta name="keywords" content="Pakistan Institute of Corporate Governance">
    @include('backend.partials.head')
    @stack('specific_css')
</head>
<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        @include('backend.partials.header')
        @include('backend.partials.sidebar')
        <main class="app-main">
            @yield('content')
        </main>
        @include('backend.partials.footer')
    </div>
    @include('backend.partials.scripts')
    @stack('specific_js')
</body>

</html>