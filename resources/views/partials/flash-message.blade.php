@php
$tailwindClass = [
    'success' => 'text-green-800 border-green-300 bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800',
    'danger'  => 'text-red-800 border-red-300 bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800',
    'warning' => 'text-yellow-800 border-yellow-300bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800',
    'info'    => 'text-blue-800 border-blue-300 bg-blue-50 dark:bg-gray-800 dark:text-blue-300 dark:border-blue-600',
]
@endphp

<div x-data="{ show: true }" x-show="show" class="{{ $tailwindClass[$type] }} flex p-4 mb-4 mt-5 text-sm border rounded-lg" role="alert">
    <i class="fi-sr-comment-info pr-3"></i>
    <div class="flex justify-between w-full">
        <p class="font-medium">{{ $message }}</p>
        <button @click="show = false" class="ml-auto">x</button>
    </div>
</div>