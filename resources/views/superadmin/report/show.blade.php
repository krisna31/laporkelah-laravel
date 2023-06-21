<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Report : ' . $report->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @include('components.success-failed-alert')

                    <div class="relative overflow-x-auto sm:rounded-lg flex justify-center items-center flex-col gap-4">

                        <h1
                            class="text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white flex flex-row gap-5">
                            {{ $report->title }}
                            @can('update', $report)
                                <a href="{{ route('report.edit', $report) }}"
                                    class="text-orange-500 hover:text-orange-700"><svg class="w-10 h-10 inline" fill="none"
                                        stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10">
                                        </path>
                                    </svg></a>
                                <button type="button" data-modal-target="popup-modal-{{ $report->id }}"
                                    data-modal-toggle="popup-modal-{{ $report->id }}"
                                    class="text-red-500 hover:text-red-700">
                                    <svg class="w-10 h-10 inline" fill="none" stroke="currentColor" stroke-width="1.5"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                        </path>
                                    </svg>
                                    <span class="sr-only">Icon description</span>
                                </button>
                                <div id="popup-modal-{{ $report->id }}" tabindex="-1"
                                    class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button"
                                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                                                data-modal-hide="popup-modal-{{ $report->id }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6 text-center">
                                                <svg aria-hidden="true"
                                                    class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                    Are you sure you want to delete this
                                                    {{ $report->title }}?</h3>
                                                <form method="POST" action="{{ route('report.destroy', $report) }}"
                                                    type="button"
                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                        Yes, I'm sure
                                                        <span class="sr-only">Icon description</span>
                                                    </button>
                                                </form>
                                                <button data-modal-hide="popup-modal-{{ $report->id }}" type="button"
                                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                                    cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </h1>
                        <img class="h-auto max-w-xl rounded-lg shadow-xl dark:shadow-gray-800 text-center"
                            src="{{ file_exists(public_path('storage/report/' . $report->foto)) ? asset('storage/report/' . $report->foto) : asset('logo.png') }}"
                            alt="{{ $report->title }}">
                        <small class="ml-2 font-semibold text-gray-500 dark:text-gray-400">Created by :
                            {{ $report->user->name }}</small>
                        <small class="ml-2 font-semibold text-gray-500 dark:text-gray-400">Belongs to Company :
                            {{ $report->company->nama }}</small>
                        <p class="text-gray-500 dark:text-gray-400">Keterangan : {{ $report->keterangan }}</p>
                        @isset($report->updated_by)
                            <p class="text-gray-500 dark:text-gray-400">Closed By : {{ $report->updatedBy->name }}</p>
                        @endisset
                        @isset($report->alasan_close)
                            <p class="text-gray-500 dark:text-gray-400">Alasan Close : {{ $report->alasan_close }}</p>
                        @endisset

                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto sm:rounded-lg flex justify-center items-center flex-col gap-4">
                        @include('layouts.comments', ['report' => $report])
                        @if (!isset($report->alasan_close) || auth()->user()->role_id < 3)
                            <form action="{{ route('comment.store') }}" method="POST" class="w-1/2">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="report_id" value="{{ $report->id }}">
                                <div
                                    class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                    <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                        <label for="comment" class="sr-only">Your comment</label>
                                        <textarea id="comment" rows="4" name="isi"
                                            class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                            placeholder="Write a comment..." required></textarea>
                                    </div>
                                    <div
                                        class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                                        <button type="submit"
                                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                            Post comment
                                        </button>
                                    </div>
                                </div>
                                <p class="ml-auto text-xs text-gray-500 dark:text-gray-400">Remember, contributions to
                                    this
                                    topic should follow our <a href="#"
                                        class="text-blue-600 dark:text-blue-500 hover:underline">Community
                                        Guidelines</a>.
                                </p>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
