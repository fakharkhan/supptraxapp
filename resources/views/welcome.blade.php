<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SUPPTRAX – Track and manage the claim supplement process</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.0/dist/tailwind.min.css" />
        @endif
        <style>
            body { font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif; }
        </style>
    </head>
    <body class="min-h-screen bg-black text-white antialiased">
        {{-- Header --}}
        <header class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-6 py-4 bg-black/95 backdrop-blur-sm border-b border-gray-800">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/supptrax-logo-white.svg') }}" alt="SUPPTRAX" class="h-6" />
            </a>
            <nav class="flex items-center gap-4">
                <a href="{{ config('app.client_url', 'https://supptrax.com') }}" class="px-6 py-2.5 rounded-md font-medium bg-amber-500 text-white hover:bg-amber-600 transition-colors">
                    Sign Up
                </a>
                <a href="{{ url('/admin/login') }}" class="px-6 py-2.5 rounded-md font-medium border border-amber-500/50 text-white hover:bg-amber-500/10 hover:border-amber-500 transition-colors">
                    Login
                </a>
            </nav>
        </header>

        {{-- Hero --}}
        <main class="pt-24 pb-20 px-6 max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                Track and manage the claim<br>
                supplement process for all<br>
                <span class="text-amber-500">your roofing projects</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-300 max-w-3xl mx-auto mb-10 leading-relaxed">
                Supptrax provides 24/7, up-to-the-minute visibility on all your roofing supplemental jobs, helping ensure that timely contacts are made, and claims are closed within a defined period. What's more, our analytics allow you to see the average dollar amount as well as the number of settled claims so you can better manage your business today and into the future.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ url('/admin/login') }}" class="px-8 py-3.5 rounded-md font-medium border border-amber-500/50 text-white hover:bg-amber-500/10 hover:border-amber-500 transition-colors">
                    Login
                </a>
                <a href="{{ config('app.client_url', 'https://supptrax.com') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-md font-medium text-white border border-amber-500/50 hover:bg-amber-500/10 hover:border-amber-500 transition-colors">
                    Subscribe
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </main>

        {{-- How it works --}}
        <section class="border-t border-gray-800 py-16 px-6">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-xl font-bold uppercase tracking-wider text-white mb-12">How it works</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="rounded-lg border border-gray-700 bg-gray-900/50 p-6 min-h-[140px]">
                        <div class="w-12 h-12 rounded-lg bg-amber-500/20 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-lg mb-2">Submit claims</h3>
                        <p class="text-gray-400 text-sm">Upload and track your roofing supplement claims in one place.</p>
                    </div>
                    <div class="rounded-lg border border-gray-700 bg-gray-900/50 p-6 min-h-[140px]">
                        <div class="w-12 h-12 rounded-lg bg-amber-500/20 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-lg mb-2">Real-time visibility</h3>
                        <p class="text-gray-400 text-sm">Monitor status and ensure timely follow-ups throughout the process.</p>
                    </div>
                    <div class="rounded-lg border border-gray-700 bg-gray-900/50 p-6 min-h-[140px]">
                        <div class="w-12 h-12 rounded-lg bg-amber-500/20 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-lg mb-2">Analytics & insights</h3>
                        <p class="text-gray-400 text-sm">See average dollar amounts and settled claims to grow your business.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="border-t border-gray-800 py-8 px-6 text-center text-gray-400 text-sm">
            <p>&copy; {{ date('Y') }} SUPPTRAX. All rights reserved.</p>
        </footer>
    </body>
</html>
