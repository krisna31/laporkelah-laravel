<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-1 justify-between">
                    <a href="{{ route('company.index') }}"
                        class="flex flex-col justify-center align-center max-w-sm p-12 bg-green-200 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h2 class="text-center">Total Registered Company</h2>
                        <p class="text-center">0 Company</p>
                    </a>
                    <a href="{{ route('user.index') }}"
                        class="flex flex-col justify-center align-center max-w-sm p-12 bg-green-200 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h2 class="text-center">Total Registered User</h2>
                        <p class="text-center">0 User</p>
                    </a>
                    <a href="{{ route('role.index') }}"
                        class="flex flex-col justify-center align-center max-w-sm p-12 bg-green-200 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h2 class="text-center">Total Role</h2>
                        <p class="text-center">0 Role</p>
                    </a>
                    <a href="{{ route('report.index') }}"
                        class="flex flex-col justify-center align-center max-w-sm p-12 bg-green-200 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h2 class="text-center">Total Report</h2>
                        <p class="text-center">0 Report</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
