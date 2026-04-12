<section class="py-12 sm:py-20 max-w-2xl mx-auto px-6">

  <p class="text-xs tracking-widest text-gray-400 uppercase mb-3">Hi.</p>

  <h1 class="text-3xl sm:text-4xl font-medium dark:text-gray-100 leading-tight mb-2">
    I'm Jordan, <span id="ja-subtitle" class="text-red-300">a multifaceted human</span>
  </h1>

  <div id="ja-chooser" class="transition-all duration-200">
    <p class="text-base text-text mb-8 mt-4 mb-15">
      Choose which me you'd like to meet, or
      <a href="#"
         id="random-post-link"
         data-posts='@json($posts->map(fn($p) => $p->getPath()))'>
        roll for a random encounter
      </a>.
    </p>
    

    <div class="flex flex-col gap-2">

      {{-- Card 1: float image left --}}
      <div onclick="jaShow('seo')" class="ja-card group cursor-pointer overflow-hidden">
        <img src="assets/img/about_thumb.jpg" alt="The Business Boy"
             class="ja-copy-image w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover object-top float-left mr-5 mb-2" />
        <div>
          <h2 class="font-semibold mb-1 group-hover:text-red-300 transition-colors duration-150">The Business Boy</h1>
          <p class="text-sm text-gray-400 leading-relaxed">A pleasantly dry introduction that finishes with a note of SEO optimization</p>
        </div>
        <div class="clear-both"></div>
      </div>
<hr>
      <div onclick="jaShow('ebert')" class="ja-card group cursor-pointer overflow-hidden">
        <img src="" alt="The Story Dweeb"
             class="ja-copy-image w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover object-top float-right ml-5 mb-2" />
        <div>
          <h2 class="font-semibold mb-1 group-hover:text-red-300 transition-colors duration-150">The Story Dweeb</h2>
          <p class="text-sm text-gray-400 leading-relaxed">A review by Roger Ebert<sup>*</sup> introducing me as DIY filmmaker</p>
        </div>
        <div class="clear-both"></div>
      </div>
<hr>
      <div onclick="jaShow('redshift')" class="ja-card group cursor-pointer overflow-hidden">
        <img src="assets/img/artist_thumb.jpeg" alt="The Tortured Artist"
             class="ja-copy-image w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover object-top float-left mr-5 mb-2" />
        <div>
          <h2 class="font-semibold mb-1 group-hover:text-red-300 transition-colors duration-150">The Tortured Artist</h2>
          <p class="text-sm text-gray-400 leading-relaxed">Get to know me through the most visceral excretions of my soul via my album, <em>Redshift</em></p>
        </div>
        <div class="clear-both"></div>
      </div>
<hr>
    </div>
  </div>

  <div id="ja-copy" class="hidden">
    <p id="ja-copy-headline" class="text-xs tracking-widest text-gray-400 uppercase mb-3"></p>
    <img id="ja-copy-image" src="" alt="" class="w-48 h-48 rounded-full object-cover object-top mb-6 float-right mr-6 hidden" />
    <p id="ja-copy-text" class="text-base sm:text-lg text-text leading-relaxed"></p>
    <button onclick="jaBack()" class="mt-6 text-sm text-gray-500 hover:text-gray-200 transition-colors duration-150 bg-transparent border-none cursor-pointer p-0 clear-both block">
      ← let's meet again
    </button>
  </div>

</section>