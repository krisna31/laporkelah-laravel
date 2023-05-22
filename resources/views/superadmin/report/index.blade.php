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
                        @if (session()->has('success'))
                            <div id="alert-border-3"
                                class="flex p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800"
                                report="alert">
                                <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div class="ml-3 text-sm font-medium">
                                    {{ session('success') }}
                                </div>
                                <button type="button"
                                    class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                                    data-dismiss-target="#alert-border-3" aria-label="Close">
                                    <span class="sr-only">Dismiss</span>
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        @elseif (session()->has('failed'))
                            <div id="alert-border-3"
                                class="flex p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800"
                                report="alert">
                                <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div class="ml-3 text-sm font-medium">
                                    {{ session('failed') }}
                                </div>
                                <button type="button"
                                    class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                                    data-dismiss-target="#alert-border-3" aria-label="Close">
                                    <span class="sr-only">Dismiss</span>
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        @endif
                        <div class="flex items-center justify-between py-4 bg-white dark:bg-gray-800">
                            <div>
                                <a href="{{ route('report.create') }}"
                                    class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Add
                                    report</a>
                            </div>
                        </div>
                        @forelse ($companies as $company)
                            <div id="accordion-open" data-accordion="open"
                                data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white">
                                <h2 id="accordion-open-heading-{{ $loop->index }}">
                                    <button type="button"
                                        class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
                                        data-accordion-target="#accordion-open-body-{{ $loop->index }}"
                                        aria-expanded="false" aria-controls="accordion-open-body-{{ $loop->index }}">
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
                                <div id="accordion-open-body-{{ $loop->index }}" class="hidden"
                                    aria-labelledby="accordion-open-heading-{{ $loop->index }}">
                                    <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
                                        <div
                                            class="p-5 mb-4 border border-gray-100 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                            <ol class="mt-3 divide-y divider-gray-200 dark:divide-gray-700">
                                                @forelse ($company->reports as $report)
                                                    <li>
                                                        <a href="{{ route('report.show', $report) }}"
                                                            class="items-center block p-3 sm:flex hover:bg-gray-100 dark:hover:bg-gray-700">
                                                            <img class="w-12 h-12 mb-3 mr-3 rounded-full sm:mb-0"
                                                                src="{{ file_exists(asset('storage/report/' . $report->foto)) ? asset('storage/report/' . $report->foto) : asset('logo.jpg') }}"
                                                                alt="{{ $report->title }}" />
                                                            <div class="text-gray-600 dark:text-gray-400">
                                                                <div class="text-base font-bold">
                                                                    {{ $report->title . '  |  ' . $report->created_at->diffForHumans() }}
                                                                </div>
                                                                <div
                                                                    class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                                                    {{ $report->user->name }}
                                                                </div>
                                                                <div class="text-sm font-normal">
                                                                    {!! Str::limit($report->keterangan, 100, '...') !!}
                                                                </div>
                                                                <div class="text-sm font-normal">
                                                                    @if ($report->status)
                                                                        <span
                                                                            class="flex items-center text-sm font-medium text-gray-900 dark:text-white"><span
                                                                                class="flex w-2.5 h-2.5 bg-green-600 rounded-full mr-1.5 flex-shrink-0">
                                                                            </span>
                                                                            Open
                                                                        </span>
                                                                    @else
                                                                        <span
                                                                            class="flex items-center text-sm font-medium text-gray-900 dark:text-white"><span
                                                                                class="flex w-2.5 h-2.5 bg-red-600 rounded-full mr-1.5 flex-shrink-0">
                                                                            </span>
                                                                            Close
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                @empty
                                                    <li>
                                                        <h1>Empty Report</h1>
                                                    </li>
                                                @endforelse
                                            </ol>
                                        </div>
                                    </div>
                                </div>
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
