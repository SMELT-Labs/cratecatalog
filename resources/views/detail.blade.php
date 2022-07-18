@push('head')
    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <livewire:styles />
    <x-comments::styles />

@endpush

@push('scripts')
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
    <livewire:scripts />
    <x-comments::scripts />
@endpush


<x-app-layout>


    <div class="w-full max-w-[65ch] p-3 mx-auto">

{{--        <div class="text-3xl font-bold mb-3">--}}
{{--            {{ $box->name }}--}}
{{--        </div>--}}

        <div class="mt-8 lg:prose-xl prose text-center">
            <h1 class=" font-bold">
                {{ $box->name }}
            </h1>
            <div class="-mt-12">
                <h2 class="text-gray-500">{{ $box->short }}</h2>
            </div>
        </div>

        <div class="lg:-mx-16 mx-0">
            <div class="mt-16 w-full rounded-[2rem] overflow-hidden @aspect(4,2) bg-gray-200 relative">
                <img class="object-cover" src="{{ $box->header }}" alt="">
                <div class="absolute inset-0 bg-gradient-to-t from-[rgba(0,0,0,0.5)] to-transparent"></div>
            </div>
        </div>


        <div class="-translate-y-1/2 absolute lg:ml-0 ml-8 -mt-3">
            <div class="w-32 rounded-full outline-4 outline-gray-100 outline">
                <div class="@aspect(1,1) bg-gray-200 rounded-full overflow-hidden ">
                    <img class="object-cover"
                         src="{{ $box->logo }}" alt="">
                </div>
            </div>
        </div>

        <div class="mt-24">

            @if(count($prices) > 1)
                <div class="text-right text-gray-400 font-bold mb-3">
                    Subscriptions range {{ $box->priceRange }}
                </div>
            @endif

            <div class="divide-y">
                @foreach($prices as $price)

                    <div class="flex items-center justify-between py-3">
                        <div>
                            <div class="font-bold">
                                {{ $price->name }}
                            </div>
                            <div>
                                {{ $price->short }}
                            </div>
                        </div>

                        <div class="font-bold">
                            {{ $price->formatted }}
                        </div>
                    </div>

                @endforeach
            </div>
        </div>


        <hr class="border-t-[10px] border-dotted w-16 mx-auto mt-16">


        {{--            <a href="{{ $box->website }}" class="pl-3 pr-1 py-1 rounded bg-emerald-700 uppercase text-sm font-bold text-white inline-flex items-center hover:bg-emerald-900">--}}
        {{--                Visit Website--}}
        {{--                <div>--}}
        {{--                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">--}}
        {{--                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />--}}
        {{--                    </svg>--}}
        {{--                </div>--}}
        {{--            </a>--}}

        <article class="prose mt-16">
            {!! \Illuminate\Support\Str::markdown($box->description) !!}
        </article>


        <hr class="border-t-[10px] border-dotted w-16 mx-auto my-16">

        <div class="text-2xl font-bold">Comments</div>

        @auth
            <livewire:comments :model="$box" hide-notification-options />
        @endauth

        @guest
            <p class="comments-no-comment-yet mb-3">
                Log in to make a comment...
            </p>

            <x-inline-login show-login="true"></x-inline-login>

            <livewire:comments :model="$box" read-only />
        @endguest

    </div>
</x-app-layout>
