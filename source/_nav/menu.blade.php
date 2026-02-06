<nav class="hidden lg:flex items-center justify-end text-lg">
    <a title="{{ $page->siteName }} Blog" href="/blog"
        class="ml-6 {{ $page->isActive('/blog') ? 'active underline underline-offset-9' : '' }}">
        Blog
    </a>

    <a title="{{ $page->siteName }} About" href="/about"
        class="ml-6 {{ $page->isActive('/about') ? 'active underline underline-offset-9' : '' }}">
        About
    </a>

    <a title="{{ $page->siteName }} Contact" href="/contact"
        class="ml-6 {{ $page->isActive('/contact') ? 'active underline underline-offset-9' : '' }}">
        Contact
    </a>
</nav>
