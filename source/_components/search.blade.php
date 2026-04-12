{{--
    <div
    x-data="{
    init() {
    fetch('/index.json')
    .then((response) => response.json())
    .then((data) => {
    this.fuse = new window.Fuse(data, {
    minMatchCharLength: 6,
    keys: ['title', 'snippet', 'categories'],
    })
    })
    },
    get results() {
    return this.query ? this.fuse.search(this.query) : []
    },
    get isQuerying() {
    return Boolean(this.query)
    },
    fuse: null,
    searching: false,
    query: '',
    showInput() {
    this.searching = true
    this.$nextTick(() => {
    this.$refs.search.focus()
    })
    },
    reset() {
    this.query = ''
    this.searching = false
    },
    }"
    x-cloak
    class="relative flex flex-1 items-center justify-end px-4 text-right sm:justify-center sm:text-center"
    >
    <div
    class="absolute top-5 left-0 z-10 mb-7 w-full justify-center bg-transparent px-4 md:mb-0 md:px-0"
    :class="{'hidden md:flex': ! searching}"
    >
    <label for="search" class="hidden">Search</label>
    
    <input
    id="search"
    x-model="query"
    x-ref="search"
    class="relative block h-8 w-1/2 cursor-pointer border-b border-[var(--text)] bg-transparent bg-[0.8rem] bg-no-repeat px-4 pt-px pb-0 indent-[1.2em] text-[var(--link)] transition-all duration-200 ease-out outline-none focus:border-[var(--link)] lg:w-1/2 lg:focus:w-3/4"
    :class="{ '': query, '': !query }"
    style="background-image: url('/assets/img/magnifying-glass.svg')"
    autocomplete="off"
    name="search"
    placeholder="Search"
    type="text"
    @keyup.esc="reset"
    @blur="reset"
    />
    
    <button
    x-show="query || searching"
    class="font-400 absolute top-0 right-0 my-auto pr-7 text-xl text-[var(--link)] hover:text-[var(--link-hover)] focus:outline-none md:pr-3"
    @click="reset"
    >
    &times;
    </button>
    
    <div
    x-show="isQuerying"
    x-cloak
    x-transition:enter="transition duration-300 ease-out"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-none"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="absolute right-0 bottom-10 left-0 mb-4 w-full text-left md:inset-auto md:mb-10 lg:w-3/4"
    >
    <div class="shadow-search mx-4 flex flex-col border-b-1 border-[var(--text)] bg-transparent md:mx-0">
    <template x-for="(result, index) in results">
    <a
    class="cursor-pointer border-b border-[var(--text)] bg-[var(--bg)] p-4 text-xl hover:bg-[var(--link)] hover:text-[var(--bg)]"
    :class="{ '': (index === results.length - 1) }"
    :href="result.item.link"
    :title="result.item.title"
    :key="result.link"
    @mousedown.prevent
    >
    <span x-html="result.item.title"></span>
    
    <span
    class="my-1 block text-sm font-normal text-[var(--bg)]"
    x-html="result.item.snippet"
    ></span>
    </a>
    </template>
    <div
    x-show="! results.length"
    class="w-full cursor-pointer border-b border-[var(--text)] bg-[var(--bg)] p-4 shadow hover:bg-[var(--link)] hover:text-[var(--bg)]"
    >
    <p class="my-0">
    No results for
    <strong x-html="query"></strong>
    </p>
    </div>
    </div>
    </div>
    </div>
    
    <button
    title="Start searching"
    type="button"
    class="flex h-10 items-center justify-center border border-white bg-[var(--link)]/80 px-3 hover:bg-[var(--link)]/100 focus:outline-none md:hidden"
    @click.prevent="showInput"
    >
    <img src="/assets/img/magnifying-glass.svg" alt="search icon" class="h-4 w-4 max-w-none invert" />
    </button>
    </div>
--}}
