<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <META name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Idea</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background text-foreground">

    <div
        x-data="{ online: navigator.onLine }"
        x-init="
            window.addEventListener('online', () => online = true);
            window.addEventListener('offline', () => online = false);
        "
    >
        <div
            x-cloak
            x-show="!online"
            x-transition.opacity
            class="fixed top-0 left-0 right-0 z-50 bg-red-600 text-white text-center py-2 font-medium"
        >
            {{ __('general.offline') }}
        </div>
    </div>

    <x-layout.nav />

    <main class="max-w-7xl mx-auto px-6 py-10">
        {{ $slot }}
    </main>

</body>
</html>