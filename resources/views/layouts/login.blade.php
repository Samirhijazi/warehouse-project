<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Management System</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    @vite('resources/js/app.js')
    @livewireStyles
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans text-slate-500 antialiased h-full">
    {{ $slot }}

    <livewire:components.toast-message />

    @livewireScripts
    @stack('scripts')

</body>
</html>
