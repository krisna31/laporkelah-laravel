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
                    <div class="relative overflow-x-auto sm:rounded-lg flex justify-center items-center flex-col gap-4">
                        <h1
                            class="text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                            {{ $report->title }}</h1>
                        <img class="h-auto max-w-xl rounded-lg shadow-xl dark:shadow-gray-800 text-center"
                            src="{{ file_exists(asset('storage/report/' . $report->foto)) ? asset('storage/report/' . $report->foto) : asset('logo.jpg') }}"
                            alt="{{ $report->title }}">
                        <small class="ml-2 font-semibold text-gray-500 dark:text-gray-400">Created by :
                            {{ $report->user->name }}</small>
                        <small class="ml-2 font-semibold text-gray-500 dark:text-gray-400">Belongs to Company :
                            {{ $report->company->nama }}</small>
                        <p class="text-gray-500 dark:text-gray-400">Keterangan : {{ $report->keterangan }}</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto sm:rounded-lg flex justify-center items-center flex-col gap-4">
                        @forelse ($report->comments as $comment)
                            <div class="flex flex-row gap-5 w-1/2">
                                <img src="{{ file_exists(asset('storage/user/' . $comment->user->foto)) ? asset('storage/user/' . $comment->user->foto) : asset('default.png') }}"
                                    alt="{{ $comment->user->name }}" class="w-10 h-10 rounded-full me-4">
                                <div class="flex flex-col justify-between">
                                    <div>{{ $comment->user->name }} | {{ $comment->created_at->diffForHumans() }}
                                    </div>
                                    <p class="text-gray-400 text-sm">{{ $comment->isi }}</p>
                                </div>
                            </div>
                        @empty
                            <h1>No Comments Yet</h1>
                        @endforelse
                        <form action="{{ route('comment.store') }}" method="POST" class="w-1/2">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="report_id" value="{{ $report->id }}">
                            {{-- show any error --}}
                            @if ($errors->any())
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            @endif
                            <div
                                class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                    <label for="comment" class="sr-only">Your comment</label>
                                    <textarea id="comment" rows="4" name="isi"
                                        class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                        placeholder="Write a comment..." required></textarea>
                                </div>
                                <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600">
                                    <button type="submit"
                                        class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                        Post comment
                                    </button>
                                </div>
                            </div>
                            <p class="ml-auto text-xs text-gray-500 dark:text-gray-400">Remember, contributions to this
                                topic should follow our <a href="#"
                                    class="text-blue-600 dark:text-blue-500 hover:underline">Community Guidelines</a>.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
