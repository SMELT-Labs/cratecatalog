<div {{ $attributes }} >



    <x-spacer :gap="3" wrapper-class="justify-center" class="mt-5">
        @foreach(config("socialite") as $providerName => $provider)
            @php
                $colorClass = implode(" ", array_merge(
                    explode(" ", "w-12 rounded-full " . aspect(1,1)->format() . " relative flex items-center justify-center shadow-lg")
                , $provider['colorClass'] ?? []));
            @endphp
            <a href="/oauth/redirect/{{$providerName}}" class="{{ $colorClass }}" title="Login with {{ $providerName }}">
                <i class="fa-brands text-2xl fa-{{$providerName}} absolute flex items-center justify-center"></i>
            </a>
        @endforeach
    </x-spacer>

    @isset($showLogin)
        <a href="/login" class="px-5 py-2 rounded-lg bg-black text-white flex items-center justify-between mt-5 relative mx-auto w-64" title="Login">
            <span class="flex-grow text-center uppercase text-sm">Login</span>
            <i class="far text-xl fa-arrow-right-to-arc absolute right-3"></i>
        </a>
    @endisset

</div>
