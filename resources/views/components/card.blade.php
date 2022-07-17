<div {{ $attributes->merge(["class" => "max-w-screen-md"]) }}>
    <div class="bg-white overflow-hidden relative
        {{ isset($flat) && $flat ? "" : "shadow-md" }}
        {{ isset($rounded) && !$rounded ? "": "rounded-xl" }}">
        <div class="{{ isset($flush) && $flush ? "" : "p-3" }}">
            {{ $slot }}
        </div>
    </div>
</div>

