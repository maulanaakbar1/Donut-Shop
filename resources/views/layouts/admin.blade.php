<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin') | Nona Donat</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    @stack('styles')
</head>

<body class="min-h-screen bg-[#fffaf5] text-slate-800 antialiased">

    <div class="min-h-screen">

        @include('partials.admin.sidebar')

        <div class="lg:pl-72">

            @include('partials.admin.navbar')

            <main class="min-h-[calc(100vh-80px)] p-5 sm:p-7 lg:p-8">
                @yield('content')
            </main>

        </div>

    </div>

    @stack('scripts')

</body>
</html>