---
extends: _layouts.post
section: content
title: Setting up dynamic themes in Jigsaw
date: 2022-07-20
description: How to get multiple chances to make a first impression
cover_image: /assets/img/post-cover-image-2.png
---

- I want to learn best practices for styling in Tailwind
- I want to create dynamic themes that change the layout of the site based on the selection in a drop down menu.
- I'll need to use variables in Tailwind. I'll need to rely on a consistent schema for the themes so that themes can be swapped in seamlessly

## Step 1: Locate key files

```
## source/
  _assets/
    css/
      main.css          ← Start here (your theme definitions)
    js/
      main.js           ← Theme switching logic
```

# Step 2: Define Themes in `main.css`

Create the :root with a schema you'll reuse for each theme:

```
@layer base {
  :root {
    --bg: #ff0000;
    --text: #00ff00;
    --link: #0000ff;
    --link-hover: #00ffff;
    }
```

I want to change fonts too, so I'll install them `npm install @fontsource-variable/eb-garamond @fontsource/pixelify-sans @fontsource/league-gothic`, import them at the top of `main.css` and then add them to my schema with variables for `font-body` and `font-header`:

## In `main.css`.

```
css/* Import fonts at the very top */
@import "@fontsource-variable/eb-garamond";
@import "@fontsource-variable/pixelify-sans";
@import "@fontsource/league-gothic";

@import "tailwindcss/base";
@import "tailwindcss/components";
@import "tailwindcss/utilities";

@layer base {
  :root {
    --bg: #ff0000;
    --text: #00ff00;
    --link: #0000ff;
    --link-hover: #00ffff;
    --font-body: "Pixelfy Sans Variable", monospace`;
    --font-heading: "League Gothic", sans-serif;
```

Looking pretty good. Now let's update the body so that these elements will dynamically change. Add this to main.css. We'll add a transition for smooth switching between themes:

```
  body {
    background-color: var(--bg);
    color: var(--text);
    font-family: var(--font-body);
    transition: all 0.3s ease;
  }
}
```

Let's make sure we style our headings and links too:

```
h1, h2, h3, h4, h5, h6 {
    font-family: var(--font-heading);
  }

  /* Style all links */
  a {
    color: var(--link);
    transition: color 0.2s ease;
  }

  a:hover {
    color: var(--link-hover);
  }

And to test, let's set up a second theme to see if we can switch:
```

[data-theme="dark"] {
--bg: #0b010f;
--text: #87c987;
--link: #86efac;
--link-hover: #4ade80;
--font-body: "Pixelify Sans Variable", monospace;
--font-heading: "Pixelify Sans Variable", monospace;
}

```

Ok. Let's take a look at the full code for our `main.css`. It's got some extra elements that come pre-baked in with Jigsaw:
```

@import "@fontsource-variable/eb-garamond";
@import "@fontsource-variable/pixelify-sans";
@import "@fontsource/league-gothic";

@import "tailwindcss";

@import "./base.css" layer(components);
@import "./blog.css" layer(components);

@layer base {
:root {
--font-sans: "Nunito Sans", ui-sans-serif, system-ui, -apple-system,
BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial,
"Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji",
"Segoe UI Symbol", "Noto Color Emoji";

    --shadow-search: 0 -1px 27px 0 rgba(0, 0, 0, 0.04),
      0 4px 15px 0 rgba(0, 0, 0, 0.08);

    --bg: #ff0000;
    --text: #00ff00;
    --link: #0000ff;
    --link-hover: #00ffff;
    --font-body: "Pixelfy Sans Variable", monospace`;
    --font-heading: "League Gothic", sans-serif;

}

[data-theme="dark"] {
--bg: #0b010f;
--text: #87c987;
--link: #86efac;
--link-hover: #4ade80;
--font-body: "Pixelify Sans Variable", monospace;
--font-heading: "Pixelify Sans Variable", monospace;
}

\*,
::after,
::before,
::backdrop,
::file-selector-button {
border-color: var(--color-gray-200, currentcolor);
}

body {
background-color: var(--bg);
color: var(--text);
font-family: var(--font-body);
transition: all 0.3s ease;
}

h1,
h2,
h3,
h4,
h5,
h6 {
font-family: var(--font-heading);
}

/_ Style all links _/
a {
color: var(--link);
transition: color 0.2s ease;
}

a:hover {
color: var(--link-hover);
}

@layer utilities {
.shadow-search {
box-shadow: var(--shadow-search);
}
}

/_ Syntax Highlight by Prism _/
/_ https://prismjs.com/ _/

/_ You can customize the theme of the Prism syntax highlighter below. Adjust colors, backgrounds, and styles as needed for your site. _/

:not(pre) > code[class*="language-"],
pre[class*="language-"] {
background: #e5e7eb;
}

.token.operator,
.token.entity,
.token.url,
.language-css .token.string,
.style .token.string {
background: transparent;
}
}

```

# Update tailwind.config.js
Now we need to add in our theme switching logic:

```

module.exports = {
theme: {
extend: {
colors: {
bg: 'var(--bg)',
text: 'var(--text)',
link: 'var(--link)',
'link-hover': 'var(--link-hover)',
},
fontFamily: {
body: 'var(--font-body)',
heading: 'var(--font-heading)',
}
}
}
}

```

Ok. Now we need to add the theme switcher.

# Creating a theme switcher in Alpine.js

## Add Alpine.js to `<body>`
```

<body 
    x-data="{
        theme: localStorage.getItem('theme') || 'default',
        setTheme(value) {
            this.theme = value;
            document.documentElement.setAttribute('data-theme', value);
            localStorage.setItem('theme', value);
        }
    }"
    x-init="setTheme(theme)"
    :data-theme="theme"
>
```
What this does:

- `x-data`: Creates Alpine component with two things: -`theme` variable: Loads saved theme from browser storage, defaults to 'default'
- `setTheme()` function: Updates the theme everywhere when user selects one
  `x-init`: Runs `setTheme()` when page loads to apply saved theme
  `:data-theme`: Binds the current theme value to HTML attribute (so CSS can read it)

## Update `body` classes to reference dynamic variables from our theme

In a previous version to build this, I used inline variables (e.g. `bg(--bg)`). Claude helped clean this up to handle all the theme changes via CSS variables.

here's the updated `main.blade.php`

```
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
    :data-theme="theme"class="flex flex-col justify-between min-h-screen bg-bg text-text leading-normal font-text">
        <header class="flex items-center font-heading shadow bg-bg border-b h-24 py-4" role="banner">
            <div class="container flex items-center max-w-8xl mx-auto px-4 lg:px-8">
                <div class="flex items-center">
                    <a href="/" title="{{ $page->siteName }} home" class="inline-flex items-center">
                        <img class="h-8 md:h-10 mr-3" src="/assets/img/logo.svg" alt="{{ $page->siteName }} logo" />

                        <h1 class="text-lg md:text-2xl text-link font-semibold hover:text-link-hover my-0">{{ $page->siteName }}</h1>
                    </a>
                </div>

                <div id="vue-search" class="flex flex-1 justify-end items-center">
                <div class="relative" x-data="{ open: false }">
                <button
                    @click="open = !open"
                    @click.away="open = false"
                    class="px-3 py-2 text-sm rounded hover:bg-gray-100 transition"
                >
                    Theme ▼
                </button>

                <div
                    x-show="open"
                    x-transition
                    class="absolute right-0 mt-2 w-40 bg-white rounded shadow-lg border z-10"
                >
                    <button
                        @click="setTheme('default'); open = false"
                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                        :class="{ 'bg-gray-100': theme === 'default' }"
                    >
                        Default
                    </button>
                    <button
                        @click="setTheme('dark'); open = false"
                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                        :class="{ 'bg-gray-100': theme === 'dark' }"
                    >
                        Dark
                    </button>
                    <button
                        @click="setTheme('retro'); open = false"
                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                        :class="{ 'bg-gray-100': theme === 'retro' }"
                    >
                        Retro
                    </button>
                </div>
            </div>
                    @include('_components.search')

                    @include('_nav.menu')

                    @include('_nav.menu-toggle')
                </div>
            </div>
        </header>

        @include('_nav.menu-responsive')

        <main role="main" class="flex-auto w-full container max-w-4xl mx-auto py-16 px-6">
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

```

# Step 3: Build the drop down menu

We'll add the theme switcher into the header

```
<div class="relative" x-data="{ open: false }">
                <button
                    @click="open = !open"
                    @click.away="open = false"
                    class="px-3 py-2 text-sm rounded hover:bg-gray-100 transition"
                >
                    Theme ▼
                </button>

                <div
                    x-show="open"
                    x-transition
                    class="absolute right-0 mt-2 w-40 bg-white rounded shadow-lg border z-10"
                >
                    <button
                        @click="setTheme('default'); open = false"
                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                        :class="{ 'bg-gray-100': theme === 'default' }"
                    >
                        Default
                    </button>
                    <button
                        @click="setTheme('dark'); open = false"
                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                        :class="{ 'bg-gray-100': theme === 'dark' }"
                    >
                        Dark
                    </button>
                    <button
                        @click="setTheme('retro'); open = false"
                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                        :class="{ 'bg-gray-100': theme === 'retro' }"
                    >
                        Retro
                    </button>
                </div>
            </div>
```

last: create a `tailwind.config.js` file in the root:

```
module.exports = {
  content: [
    'source/**/*.blade.php',
    'source/**/*.md',
    'source/**/*.html',
  ],
  theme: {
    extend: {
      colors: {
        bg: 'var(--bg)',
        text: 'var(--text)',
        link: 'var(--link)',
        'link-hover': 'var(--link-hover)',
      },
      fontFamily: {
        body: 'var(--font-body)',
        heading: 'var(--font-heading)',
      }
    }
  }
}
```
