---
title: Hi.
description: I’m Jordan Keller. I’m a writer, producer, and artist. 
---

@extends('_layouts.main')

@section('body')
    <div class="container-full flex flex-col items-center gap-4 lg:flex-row">
        <img
            src="/assets/img/about.jpg"
            class="w-48 h-48 lg:w-10 lg:h-10 [mask-image:radial-gradient(ellipse_at_center,black_10%,transparent_100%)] object-cover sm:w-full md:max-w-full"
            alt="Jordan Keller: Writer, Producer, Songwriter, and multimedia artist."
        />

        
        

        <p class="text-md font-mono text-white sm:px-2 md:px-4 lg:px-4">
            
            <br />
            <br />
            I work for people, not algorithms.
            <br />
            <br />
            I’m a writer, producer, musician, and artist.
            <br />
            <br />
            Like you, I experience, feel, think, and make things.
            <br />
            <br />
            This website is where I share my experiences, etc.
            <br />
            <br />
            I value curiosity, and love to explore why and how things work. I write the human condition, cinematic
            storytelling, songwriting, music production, technology, creativity, and more.
            <br />
            <br />

            I release music under the name
            <!-- prettier-ignore-start -->
            <a href="https://www.theokaylakes.com" target="_blank">The Okay Lakes.</a>
            I do strategy, brand, creative, and content work for clients of all sizes. Check out my client-facing work
            <a href="http://www.jordankeller.work" target="_blank">here.</a>
            <!-- prettier-ignore-end -->
        </p>
    </div>

    <template x-if="theme === 'a human'">
        @include('_about.human')
    </template>
@endsection
