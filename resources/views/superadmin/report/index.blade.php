<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        @include('components.success-failed-alert')
                        <div class="flex items-center justify-between py-4 bg-white dark:bg-gray-800">
                            <div>
                                <a href="{{ route('report.create') }}"
                                    class="text-white bg-gradient-to-r from-orange-500 to-orange-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Add
                                    report</a>
                            </div>
                        </div>
                        @forelse ($companies as $company)
                            <div id="accordion-open" data-accordion="open"
                                data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white">
                                <h2 id="accordion-open-heading-{{ $company->id }}">
                                    <button type="button"
                                        class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
                                        data-accordion-target="#accordion-open-body-{{ $company->id }}"
                                        aria-expanded="false" aria-controls="accordion-open-body-{{ $company->id }}">
                                        <span class="text-gray-900 dark:text-gray-100">{{ $company->nama }}
                                            @if ($company->is_public)
                                                <span
                                                    class="flex items-center text-sm font-medium text-gray-900 dark:text-white"><span
                                                        class="flex w-2.5 h-2.5 bg-green-600 rounded-full mr-1.5 flex-shrink-0">
                                                    </span>
                                                    Public
                                                </span>
                                            @else
                                                <span
                                                    class="flex items-center text-sm font-medium text-gray-900 dark:text-white"><span
                                                        class="flex w-2.5 h-2.5 bg-red-600 rounded-full mr-1.5 flex-shrink-0">
                                                    </span>
                                                    Private
                                                </span>
                                            @endif
                                        </span>
                                        <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </h2>
                                @include('layouts.report-accordion', [
                                    'company' => $company,
                                ])
                            </div>
                        @empty
                            <h1>Empty</h1>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
