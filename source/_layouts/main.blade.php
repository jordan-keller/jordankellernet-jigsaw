<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="{{ $page->description ?? $page->siteDescription }}">

        <meta property="og:title" content="{{ $page->title ? $page->title . ' | ' : '' }}{{ $page->siteName }}"/>
        <meta property="og:type" content="{{ $page->type ?? 'website' }}" />
        <meta property="og:url" content="{{ $page->getUrl() }}"/>
        <meta property="og:description" content="{{ $page->description ?? $page->siteDescription }}" />

        <title>{{ $page->title ?  $page->title . ' | ' : '' }}{{ $page->siteName }}</title>

        <link rel="home" href="{{ $page->baseUrl }}">
        <link rel="icon" href="/favicon.ico">
        <link href="/blog/feed.atom" type="application/atom+xml" rel="alternate" title="{{ $page->siteName }} Atom Feed">

        @if ($page->production)
            <!-- Insert analytics code here -->
        @endif

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,300i,400,400i,700,700i,800,800i" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/prismjs/themes/prism.css" rel="stylesheet" />

        @viteRefresh()
        <link rel="stylesheet" href="{{ vite('source/_assets/css/main.css') }}">
        <script defer type="module" src="{{ vite('source/_assets/js/main.js') }}"></script>
    </head>

    <body x-data="{
        theme: localStorage.getItem('theme') || 'default',
        setTheme(value) {
            this.theme = value;
            document.documentElement.setAttribute('data-theme', value);
            localStorage.setItem('theme', value);
        }
    }"
    x-init="setTheme(theme)"
    :data-theme="theme" class="flex flex-col justify-between min-h-screen bg-bg text-text leading-normal font-body">
        <header class="flex items-center h-24 py-4" role="banner">
    <div class="container flex items-center max-w-8xl mx-auto px-4 lg:px-8">
        
        <span class="grid grid-cols-1 items-center">
            <a href="/" title="{{ $page->siteName }} home" class="inline-flex items-center">
                {{-- <img class="h-8 md:h-10 mr-3" src="/assets/img/logo.svg" alt="{{ $page->siteName }} logo" /> --}}
                <h1 class="text-lg md:text-2xl text-link font-semibold hover:text-link-hover my-0 antialiased">{{ $page->siteName }}</h1>
            </a>
            <div class="relative antialiased" x-data="{ open: false }">
                <button 
                    @click="open = !open"
                    @click.away="open = false"
                    style="font-family: var(--font-heading); color: var(--link); font-size: 20px; font-weight: 600;"
                    class="py-0 rounded transition"
                    x-text="theme.charAt(0).toUpperCase() + theme.slice(1)"
                >
                </button>
                
                <div 
                    x-show="open"
                    x-transition
                    style="background-color: var(--link); color: var(--bg); onHover: var(--link-bg);"
                    class="absolute right-0 mt-2 w-50 text-sm rounded shadow-lg border z-10"
                >
                    <button 
                        @click="setTheme('a true professional'); open = false"
                        class="block w-full text-left px-4 py-2 hover:bg-link"
                        :class="{ 'bg-bg': theme === 'a true professional' }"
                    >
                        A True Professional
                    </button>
                    <button 
                        @click="setTheme('a huge dweeb'); open = false"
                        class="block w-full text-left px-4 py-2 hover:bg-link"
                        :class="{ 'bg-bg': theme === 'a huge dweeb' }"
                    >
                        A Huge Dweeb
                    </button>

                    <button 
                        @click="setTheme('a pharmeteucial jingle writer'); open = false"
                        class="block w-full text-left px-4 py-2 hover:bg-link"
                        :class="{ 'bg-bg': theme === 'a pharmeteucial jingle writer' }"
                    >
                        A Pharmeteucial Jingle Writer
                    </button>   
                </div>
            </div>
        </span>

        <div class="flex flex-1 justify-end items-center gap-4">
            <!-- Theme Switcher Dropdown -->
        

            @include('_components.search')
            @include('_nav.menu')
            @include('_nav.menu-toggle')
        </div>
    </div>
</header>

        @include('_nav.menu-responsive')

        <main role="main" class="flex-auto w-full container max-w-4xl mx-auto py-8 px-8">
            @yield('body')
        </main>

        <footer class="bg-bg text-center text-sm mt-12 py-4" role="contentinfo">
            <ul class="flex flex-col md:flex-row justify-center list-none">
                <li class="md:mr-2">
                    &copy; <a href="https://tighten.co" title="Tighten website">Tighten</a> {{ date('Y') }}.
                </li>

                <li>
                    Built with <a href="http://jigsaw.tighten.co" title="Jigsaw by Tighten">Jigsaw</a>
                    and <a href="https://tailwindcss.com" title="Tailwind CSS, a utility-first CSS framework">Tailwind CSS</a>.
                </li>
            </ul>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/prismjs/prism.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/prismjs/plugins/autoloader/prism-autoloader.min.js"></script>
        @stack('scripts')
    </body>
</html>
