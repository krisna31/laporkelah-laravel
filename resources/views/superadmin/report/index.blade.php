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
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <form method="GET">
                                    <input type="text" id="table-search-users" name="search"
                                        class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 w-48 md:w-80 lg:w-96"
                                        placeholder="Search...">
                                </form>
                            </div>
                        </div>
                        @forelse ($companies as $company)
                            <div id="accordion-open" data-accordion="open">
                                <h2 id="accordion-open-heading-1">
                                    <button type="button"
                                        class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
                                        data-accordion-target="#accordion-open-body-{{ $loop->index }}" aria-expanded="true"
                                        aria-controls="accordion-open-body-{{ $loop->index }}">
                                        <span class="flex items-center"><svg class="w-5 h-5 mr-2 shrink-0"
                                                fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                                    clip-rule="evenodd"></path>
                                            </svg>{{ $company->nama }}</span>
                                        <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </h2>
                                <div id="accordion-open-body-{{ $loop->index }}" class="hidden"
                                    aria-labelledby="accordion-open-heading-1">

                                    <div
                                        class="p-5 mb-4 border border-gray-100 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                        <time class="text-lg font-semibold text-gray-900 dark:text-white">January 13th,
                                            2022</time>
                                        <ol class="mt-3 divide-y divider-gray-200 dark:divide-gray-700">
                                            <li>
                                                <a href="#"
                                                    class="items-center block p-3 sm:flex hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <img class="w-12 h-12 mb-3 mr-3 rounded-full sm:mb-0"
                                                        src="/docs/images/people/profile-picture-1.jpg"
                                                        alt="Jese Leos image" />
                                                    <div class="text-gray-600 dark:text-gray-400">
                                                        <div class="text-base font-normal"><span
                                                                class="font-medium text-gray-900 dark:text-white">Jese
                                                                Leos</span> likes <span
                                                                class="font-medium text-gray-900 dark:text-white">Bonnie
                                                                Green's</span> post in <span
                                                                class="font-medium text-gray-900 dark:text-white"> How
                                                                to
                                                                start with Flowbite library</span></div>
                                                        <div class="text-sm font-normal">"I wanted to share a webinar
                                                            zeroheight."</div>
                                                        <span
                                                            class="inline-flex items-center text-xs font-normal text-gray-500 dark:text-gray-400">
                                                            <svg aria-hidden="true" class="w-3 h-3 mr-1"
                                                                fill="currentColor" viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            Public
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="items-center block p-3 sm:flex hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <img class="w-12 h-12 mb-3 mr-3 rounded-full sm:mb-0"
                                                        src="/docs/images/people/profile-picture-3.jpg"
                                                        alt="Bonnie Green image" />
                                                    <div>
                                                        <div
                                                            class="text-base font-normal text-gray-600 dark:text-gray-400">
                                                            <span
                                                                class="font-medium text-gray-900 dark:text-white">Bonnie
                                                                Green</span> react to <span
                                                                class="font-medium text-gray-900 dark:text-white">Thomas
                                                                Lean's</span> comment
                                                        </div>
                                                        <span
                                                            class="inline-flex items-center text-xs font-normal text-gray-500 dark:text-gray-400">
                                                            <svg aria-hidden="true" class="w-3 h-3 mr-1"
                                                                fill="currentColor" viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                                                    clip-rule="evenodd"></path>
                                                                <path
                                                                    d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z">
                                                                </path>
                                                            </svg>
                                                            Private
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ol>
                                    </div>
                                    <div
                                        class="p-5 border border-gray-100 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                                        <time class="text-lg font-semibold text-gray-900 dark:text-white">January 12th,
                                            2022</time>
                                        <ol class="mt-3 divide-y divider-gray-200 dark:divide-gray-700">
                                            <li>
                                                <a href="#"
                                                    class="items-center block p-3 sm:flex hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <img class="w-12 h-12 mb-3 mr-3 rounded-full sm:mb-0"
                                                        src="/docs/images/people/profile-picture-4.jpg"
                                                        alt="Laura Romeros image" />
                                                    <div class="text-gray-600 dark:text-gray-400">
                                                        <div class="text-base font-normal"><span
                                                                class="font-medium text-gray-900 dark:text-white">Laura
                                                                Romeros</span> likes <span
                                                                class="font-medium text-gray-900 dark:text-white">Bonnie
                                                                Green's</span> post in <span
                                                                class="font-medium text-gray-900 dark:text-white"> How
                                                                to
                                                                start with Flowbite library</span></div>
                                                        <div class="text-sm font-normal">"I wanted to share a webinar
                                                            zeroheight."</div>
                                                        <span
                                                            class="inline-flex items-center text-xs font-normal text-gray-500 dark:text-gray-400">
                                                            <svg aria-hidden="true" class="w-3 h-3 mr-1"
                                                                fill="currentColor" viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                                                    clip-rule="evenodd"></path>
                                                                <path
                                                                    d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z">
                                                                </path>
                                                            </svg>
                                                            Private
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="items-center block p-3 sm:flex hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <img class="w-12 h-12 mb-3 mr-3 rounded-full sm:mb-0"
                                                        src="/docs/images/people/profile-picture-2.jpg"
                                                        alt="Mike Willi image" />
                                                    <div>
                                                        <div
                                                            class="text-base font-normal text-gray-600 dark:text-gray-400">
                                                            <span
                                                                class="font-medium text-gray-900 dark:text-white">Mike
                                                                Willi</span> react to <span
                                                                class="font-medium text-gray-900 dark:text-white">Thomas
                                                                Lean's</span> comment
                                                        </div>
                                                        <span
                                                            class="inline-flex items-center text-xs font-normal text-gray-500 dark:text-gray-400">
                                                            <svg aria-hidden="true" class="w-3 h-3 mr-1"
                                                                fill="currentColor" viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            Public
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="items-center block p-3 sm:flex hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <img class="w-12 h-12 mb-3 mr-3 rounded-full sm:mb-0"
                                                        src="/docs/images/people/profile-picture-5.jpg"
                                                        alt="Jese Leos image" />
                                                    <div class="text-gray-600 dark:text-gray-400">
                                                        <div class="text-base font-normal"><span
                                                                class="font-medium text-gray-900 dark:text-white">Jese
                                                                Leos</span> likes <span
                                                                class="font-medium text-gray-900 dark:text-white">Bonnie
                                                                Green's</span> post in <span
                                                                class="font-medium text-gray-900 dark:text-white"> How
                                                                to
                                                                start with Flowbite library</span></div>
                                                        <div class="text-sm font-normal">"I wanted to share a webinar
                                                            zeroheight."</div>
                                                        <span
                                                            class="inline-flex items-center text-xs font-normal text-gray-500 dark:text-gray-400">
                                                            <svg aria-hidden="true" class="w-3 h-3 mr-1"
                                                                fill="currentColor" viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            Public
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="items-center block p-3 sm:flex hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    <img class="w-12 h-12 mb-3 mr-3 rounded-full sm:mb-0"
                                                        src="/docs/images/people/profile-picture-3.jpg"
                                                        alt="Bonnie Green image" />
                                                    <div class="text-gray-600 dark:text-gray-400">
                                                        <div class="text-base font-normal"><span
                                                                class="font-medium text-gray-900 dark:text-white">Bonnie
                                                                Green</span> likes <span
                                                                class="font-medium text-gray-900 dark:text-white">Bonnie
                                                                Green's</span> post in <span
                                                                class="font-medium text-gray-900 dark:text-white"> Top
                                                                figma designs</span></div>
                                                        <div class="text-sm font-normal">"I wanted to share a webinar
                                                            zeroheight."</div>
                                                        <span
                                                            class="inline-flex items-center text-xs font-normal text-gray-500 dark:text-gray-400">
                                                            <svg aria-hidden="true" class="w-3 h-3 mr-1"
                                                                fill="currentColor" viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                                                    clip-rule="evenodd"></path>
                                                                <path
                                                                    d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z">
                                                                </path>
                                                            </svg>
                                                            Private
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ol>
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
