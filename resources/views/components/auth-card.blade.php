<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-700 sm:rounded-lg shadow-lg">
    <div class="logo-wrapper bg-gray-800">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border shadow-lg">
        {{ $slot }}
    </div>
</div>
