{{--@if(collect(app('view')->getShared())->has('template'))--}}
{{--    @dd(collect(app('view')->getShared()))--}}
{{--@endif--}}
{{--@dd(get_defined_vars())--}}
{{--@render($header)--}}
<x-image-card :flat="false" :rounded="true" :src="\App\Providers\TemplateServiceProvider::render('header')">

    <div class="py-3">
        <div class="-translate-y-1/2 absolute -my-3 ml-3">
            <div class="w-24">
                <div class="@aspect(1,1) bg-gray-200 rounded-full overflow-hidden shadow-lg">
                    <img class="object-cover"
                         src="@render($logo)" alt="">
                </div>
            </div>
        </div>

        @renderif($minPrice)
            <div class="absolute right-0 uppercase">
                <div class="bg-yellow-200 rounded-l ribbon-sm text-amber-700 shadow flex items-center">
                    <span class="text-xs mr-2 -mb-[2px]">from</span>
                    <span class="uppercase tracking-wide">@render($minPrice)</span>
                </div>
            </div>
        @endrenderif($minPrice)

        <div class="px-3 mt-12">
            <div class="text-2xl font-bold">
                @highlight($name)
            </div>
            <div>@highlight($short)</div>
        </div>

        <div class="mt-5 text-right">
            <a href="@render($detail)" class="pl-3 pr-1 py-1 rounded bg-sky-700 uppercase text-sm font-bold text-white inline-flex items-center hover:bg-sky-900">
                Learn More
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
        </div>
    </div>

</x-image-card>
