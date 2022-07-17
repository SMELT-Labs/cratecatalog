@pushonce('scripts')
    @vite(['resources/js/search.js'])
@endpushonce

<div id="searchbox" class="flex-grow">
    <div class="ais-SearchBox flex-grow">
        <form action="/search" role="search" class="ais-SearchBox-form flex items-center m-0 justify-end mr-6 md:mr-0 relative" novalidate="">

            <input
                name="q"
                class="ais-SearchBox-input w-64 transition-all duration-500 focus:w-full max-w-screen-md rounded-full px-5" type="search"
                placeholder="Search" autocomplete="off" autocorrect="off" autocapitalize="none"
                spellcheck="false" maxlength="512">

            <button class="ais-SearchBox-submit absolute right-5 hover:text-blue-600" type="submit"
                    title="Submit the search query.">
                <i class="far fa-magnifying-glass text-xl"></i>
{{--                <svg class="ais-SearchBox-submitIcon w-5 h-5 fill-current" width="10" height="10" viewBox="0 0 40 40">--}}
{{--                    <path--}}
{{--                        d="M26.804 29.01c-2.832 2.34-6.465 3.746-10.426 3.746C7.333 32.756 0 25.424 0 16.378 0 7.333 7.333 0 16.378 0c9.046 0 16.378 7.333 16.378 16.378 0 3.96-1.406 7.594-3.746 10.426l10.534 10.534c.607.607.61 1.59-.004 2.202-.61.61-1.597.61-2.202.004L26.804 29.01zm-10.426.627c7.323 0 13.26-5.936 13.26-13.26 0-7.32-5.937-13.257-13.26-13.257C9.056 3.12 3.12 9.056 3.12 16.378c0 7.323 5.936 13.26 13.258 13.26z"></path>--}}
{{--                </svg>--}}
            </button>


        </form>
    </div>
</div>
