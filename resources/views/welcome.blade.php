<x-app-layout>



{{--    <div id="searchbox" class="ais-SearchBox"></div>--}}
{{--    <div id="hits" class=""></div>--}}

    <x-spacer :gap="3" col-class="w-full sm:w-1/2 md:w-1/3 max-w-screen-sm"
              class="max-w-screen-lg mx-auto my-3" id="hits">
        @foreach($boxes as $box)
            @component('templates.box', $box->toArray())@endcomponent
        @endforeach
    </x-spacer>


</x-app-layout>
