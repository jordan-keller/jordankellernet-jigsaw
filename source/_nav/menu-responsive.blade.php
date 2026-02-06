<nav id="js-nav-menu" class="w-auto px-2 bg-bg shadow lg:hidden overflow-hidden transition-all duration-300 ease-in-out max-h-0 opacity-0">
    <ul class="my-0">
        <li class="pl-4">
            <a
                title="{{ $page->siteName }} Blog"
                href="/blog"
                class="block mt-0 mb-4 text-sm no-underline {{ $page->isActive('/blog') ? 'active text-link' : 'text-link hover:text-hover' }}"
            >Blog</a>
        </li>
        <li class="pl-4">
            <a
                title="{{ $page->siteName }} About"
                href="/about"
                class="block mt-0 mb-4 text-sm no-underline {{ $page->isActive('/about') ? 'active text-link' : 'text-link hover:text-hover' }}"
            >About</a>
        </li>
        <li class="pl-4">
            <a
                title="{{ $page->siteName }} Contact"
                href="/contact"
                class="block mt-0 mb-4 text-sm no-underline {{ $page->isActive('/contact') ? 'active link' : 'text-link hover:text-hover' }}"
            >Contact</a>
        </li>
    </ul>
</nav>
