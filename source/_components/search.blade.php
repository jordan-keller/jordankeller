<div x-data="{
        init(){
            fetch('/index.json')
                .then(response => response.json())
                .then(data => {
                    this.fuse = new window.Fuse(data, {
                        minMatchCharLength: 6,
                        keys: ['title', 'snippet', 'categories'],
                    });
                });
        },
        get results() {
            return this.query ? this.fuse.search(this.query) : [];
        },
        get isQuerying() {
            return Boolean( this.query );
        },
        fuse: null,
        searching: false,
        query: '',
        showInput() {
            this.searching = true;
            this.$nextTick(() => {
                this.$refs.search.focus();
            })
        },
        reset() {
            this.query = '';
            this.searching = false;
        },
    }"
    x-cloak
    class="flex flex-1 justify-end items-center text-right px-4"
>
    <div
        class="absolute md:relative w-full justify-center bg-transparent left-0 top-0 z-10 mt-7 md:mt-0 px-4 md:px-0"
        :class="{'hidden md:flex': ! searching}"
    >
        <label for="search" class="hidden">Search</label>

        <input
            id="search"
            x-model="query"
            x-ref="search"
            class="relative block h-8 w-1/2 lg:w-1/2 lg:focus:w-3/4 bg-transparent border-b border-[var(--text)] focus:border-[var(--link)] outline-none cursor-pointer text-[var(--link)] px-4 pb-0 pt-px transition-all duration-200 ease-out bg-no-repeat bg-[0.8rem] indent-[1.2em]"
            :class="{ '': query, '': !query }"
            style="background-image: url('/assets/img/magnifying-glass.svg')"
            autocomplete="off"
            name="search"
            placeholder="Search"
            type="text"
            @keyup.esc="reset"
            @blur="reset"
        >

        <button
            x-show="query || searching"
            class="absolute top-0 right-0 font-400 text-xl text-[var(--link)] hover:text-[var(--link-hover)] focus:outline-none pr-7 md:pr-3 my-auto"
            @click="reset"
        >&times;</button>

        <div
            x-show="isQuerying"
            x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-none"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute left-0 right-0 md:inset-auto w-full lg:w-3/4 text-left mb-4 md:mt-10"
        >
            <div class="flex flex-col bg-transparent border-b-1 border-[var(--text)] shadow-search mx-4 md:mx-0">
                <template x-for="(result, index) in results">
                    <a
                        class="bg-[var(--bg)] hover:bg-[var(--link)] border-b border-[var(--text)] text-xl cursor-pointer p-4 hover:text-[var(--bg)]"
                        :class="{ '': (index === results.length - 1) }"
                        :href="result.item.link"
                        :title="result.item.title"
                        :key="result.link"
                        @mousedown.prevent
                    >
                        <span x-html="result.item.title"></span>

                        <span class="block font-normal text-[var(--bg)] text-sm my-1" x-html="result.item.snippet"></span>
                    </a>
                </template>
                <div
                    x-show="! results.length"
                    class="bg-[var(--bg)] w-full hover:bg-[var(--link)] border-b border-[var(--text)] shadow cursor-pointer p-4 hover:text-[var(--bg)]"
                >
                    <p class="my-0">No results for <strong x-html="query"></strong></p>
                </div>
            </div>
        </div>
    </div>

    <button
        title="Start searching"
        type="button"
        class="flex md:hidden bg-gray-100 hover:bg-blue-100 justify-center items-center border border-gray-500  focus:outline-none h-10 px-3"
        @click.prevent="showInput"
    >
        <img src="/assets/img/magnifying-glass.svg" alt="search icon" class="h-4 w-4 max-w-none">
    </button>
</div>
