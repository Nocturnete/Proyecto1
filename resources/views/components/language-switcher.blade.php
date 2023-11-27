@php
    $availableLocales = config('app.available_locales');
    $currentLocale = app()->getLocale();
@endphp

<div class="relative mb-8 ml-5">
    <x-dropdown>
        <x-slot name="trigger" class="origin-top-right absolute right-0 mt-2 z-10">
            <button class="flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-500 bg-white focus:outline-none transition ease-in-out duration-150 hover:text-gray-700 dark:text-gray-400 dark:bg-gray-800 dark:hover:text-gray-300">
                <div class="mr-2">
                    <img src="{{ asset("img/{$currentLocale}.png") }}" class="w-5" alt="{{ $currentLocale }}">
                </div>
                <p class="hidden md:inline">{{ $availableLocales[$currentLocale] }} ({{ $currentLocale }})</p>
            </button>
        </x-slot>
        <x-slot name="content" class="origin-top-right absolute right-0 mt-2">
            @foreach($availableLocales as $locale => $localeName)
                @if($locale !== $currentLocale)
                    <x-dropdown-link :href="route('language', $locale)" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 dark:text-gray-400 dark:hover:text-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <img src="{{ asset("img/{$locale}.png") }}" class="w-5" alt="{{ $locale }}">
                        <p class="hidden md:inline pl-2">{{ $localeName }} ({{ $locale }})</p>
                    </x-dropdown-link>
                @endif
            @endforeach
        </x-slot>
    </x-dropdown>
</div>
<script>
   const currentLocale = {{ Js::from($currentLocale) }};
</script>
