

<x-card {{ $attributes }} :flush="false" >
    <div class="@aspect(4,2) bg-gray-200 relative {{ isset($rounded) && !$rounded ? "": "rounded-lg overflow-hidden" }}">
        <img class="object-cover"
            src="{{ $src ?? "https://picsum.photos/200" }}" alt="">
        <div class="absolute inset-0 bg-gradient-to-t from-[rgba(0,0,0,0.25)] to-transparent"></div>
    </div>

    {{ $slot }}

</x-card>

