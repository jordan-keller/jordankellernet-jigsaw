---
title: About
description: A little bit about the site
---
@extends('_layouts.main')

@section('body')
    <h1>About</h1>

    <template x-if="theme === 'a true professional'">
        @include('_about.about-professional')
    </template>
    
    <template x-if="theme === 'a huge dweeb'">
        @include('_about.about-dweeb')
    </template>
    
    <template x-if="theme === 'a pharmaceutical jingle writer'">
        @include('_about.about-pharma')
    </template>
@endsection