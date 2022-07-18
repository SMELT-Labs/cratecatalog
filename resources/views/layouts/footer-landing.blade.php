<footer class="text-center my-8 select-none grid gap-4 grid-cols-1 justify-center font-mono sm:text-sm text-xs">
    <hr class="mx-auto w-16 border-stone-300 dark:border-slate-700">

    <div>
        <div>Powered by <i class="fas fa-heart text-red-500"></i> from the community.</div>
{{--        <div class="mt-2">Technology:</div>--}}
{{--        <div>--}}
{{--            <a class="text-red-500 underline" href="https://laravel.com">Laravel</a>--}}
{{--            | <a class="text-blue-500 underline" href="https://tailwindcss.com">TailwindCSS</a>--}}
{{--            | <a class="text-emerald-500 underline" href="https://vuejs.org">Vue.js</a>--}}
{{--        </div>--}}
    </div>

    <p>
        <a href="{{ env('APP_URL') }}" class="hover:underline">{{ env('APP_NAME') }}</a>
        <span>&copy; {{now()->year}} </span>
    </p>

    <hr class="mx-auto w-16 border-stone-300 dark:border-slate-700">

{{--    <form action="/locale" method="post">--}}
{{--        @csrf--}}
{{--        <select name="locale" id="locale" onchange="this.form.submit()" class="form-select relative appearance-none block w-full w-60 text-center py-2 px-3 mx-auto rounded transition ease-in-out bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-300">--}}
{{--            <option value="" disabled selected>Language: {{config('localization.supportedLocales')[app()->getLocale()]['native']}}</option>--}}

{{--            @foreach(config('localization.supportedLocales') as $key => $value)--}}
{{--                <option value="{{$key}}">{{$value['native']}}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--    </form>--}}

    <div class="text-sm max-w-xs mx-auto">
        @foreach(config('navigation.footer') as $nav)
            <a class="underline py-2" href="{{ route(str($nav)->lower()->toString()) }}">{{ __($nav) }}</a>
        @endforeach
    </div>

{{--    <div class="max-w-xs mx-auto p-3 flex items-center justify-between border-t border-gray-200 dark:border-gray-800">--}}
{{--        <a href="https://twitter.com/ioshavencom" style="color: #1da1f2;"><i class="fab fa-twitter mx-2 fa-2x"></i></a>--}}
{{--        <a href="https://www.reddit.com/r/iOSHaven/" style="color: #ff4500;"><i class="fab fa-reddit mx-2 fa-2x"></i></a>--}}
{{--        <a href="https://discord.gg/mTbwMyQ" style="color: #7289da;"><i class="fab fa-discord mx-2 fa-2x"></i></a>--}}
{{--        <a href="https://github.com/iOSHaven" style="color: #6cc644;"><i class="fab fa-github mx-2 fa-2x"></i></a>--}}
{{--        <a href="https://www.patreon.com/ioshaven" style="color: #f96854;"><i class="fab fa-patreon mx-2 fa-2x"></i></a>--}}
{{--    </div>--}}
</footer>


