---
title: About
description: I’m Jordan Keller. I’m a writer, producer, and multimedia artist. I explore why and how art, technology, culture, and the human condition work. I write about any subject or question that interests me. I publish for people (not algorithms), so that you might explore with me.
---
@extends('_layouts.main')

@section('body')
    <h1 class="mb-4">About</h1>

   <img src="/assets/img/about.jpg" class="h-120 w-full object-cover mix-blend-luminosity mb-8" alt="A photo of Jordan Keller, the author of this site.">

   <div class="text-xl whitespace-pre-wrap">

I’m Jordan Keller. I’m a writer, producer, and multimedia artist. 

I explore why and how things work. I write about art, technology, culture, the human condition, and any subject that interests me. 

I publish for people (not algorithms), so that you might explore with me.

<b>Email:</b> <a href="mailto:hi@jordan-keller.com">hi@jordan-keller.com</a>
</div>


    <template x-if="theme === 'a human'">
        @include('_about.human')
    </template>

@endsection