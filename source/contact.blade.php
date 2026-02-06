---
title: Contact
description: This is how to get ahold of me, Jordan Keller
---
@extends('_layouts.main')

@section('body')
<h1>Contact</h1>

<ul class="mb-8 ml-4 list-disc space-y-2">
<li>Skeet at me on <a href="https://bsky.app/profile/jordan-keller.com" target="_blank" class="text-blue-500 hover:text-blue-700 underline">Bluesky</a></li>
<li>Connect on <a href="https://www.linkedin.com/in/jordan-m-keller/" target="_blank" class="text-blue-500 hover:text-blue-700 underline">LinkedIn</a></li>
<li>Find me on <a href="https://github.com/jordan-keller" target="_blank" class="text-blue-500 hover:text-blue-700 underline">GitHub</a></li>
<li>EXPERIENCE my album: <a href="https://www.theokaylakes.com" target="_blank" class="text-blue-500 hover:text-blue-700 underline">"Redshift" by The Okay Lakes</a><br>
- (or just listen to it)</li>
<li>Find me on YouTube</li>
<li>Instagram</li>

</ul>
{{-- 
<form action="/contact" class="mb-12">
    <div class="flex flex-wrap mb-6 -mx-3">
        <div class="w-full md:w-1/2 mb-6 md:mb-0 px-3">
            <label class="block mb-2 text-gray-800 text-sm font-semibold" for="contact-name">
                Name
            </label>

            <input
                type="text"
                id="contact-name"
                placeholder="Jane Doe"
                name="name"
                class="bg-white block w-full border shadow-sm rounded-lg outline-hidden mb-2 px-4 py-3"
                required
            >
        </div>

        <div class="w-full px-3 md:w-1/2">
            <label class="block text-gray-800 text-sm font-semibold mb-2" for="contact-email">
                Email Address
            </label>

            <input
                type="email"
                id="contact-email"
                placeholder="email@domain.com"
                name="email"
                class="bg-white block w-full border shadow-sm rounded-lg outline-hidden mb-2 px-4 py-3"
                required
            >
        </div>
    </div>

    <div class="w-full mb-12">
        <label class="block text-gray-800 text-sm font-semibold mb-2" for="contact-message">
            Message
        </label>

        <textarea
            id="contact-message"
            rows="4"
            name="message"
            class="bg-white block w-full border shadow-sm rounded-lg outline-hidden appearance-none mb-2 px-4 py-3"
            placeholder="A lovely message here."
            required
        ></textarea>
    </div>

    <div class="flex justify-end w-full">
        <input
            type="submit"
            value="Submit"
            class="block bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold leading-snug tracking-wide uppercase shadow-sm rounded-lg cursor-pointer px-6 py-3"
        >
    </div>
</form> --}}
@stop
