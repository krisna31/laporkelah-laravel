@isset($company)
    <div id="accordion-open-body-{{ $company->id }}" @if (Str::contains(request()->fullUrl(), 'report')) class="hidden" @endif
        aria-labelledby="accordion-open-heading-{{ $company->id }}">
    @endisset
    <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
        <div class="p-5 mb-4 border border-gray-100 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
            <ol class="mt-3 divide-y divider-gray-200 dark:divide-gray-700">
                @forelse ($company->reports ?? $reports as $report)
                    <li>
                        <a href="{{ route('report.show', $report) }}"
                            class="items-center block p-3 sm:flex hover:bg-gray-100 dark:hover:bg-gray-700">
                            <img class="w-12 h-12 mb-3 mr-3 rounded-full sm:mb-0"
                                src="{{ file_exists(asset('storage/report/' . $report->foto)) ? asset('storage/report/' . $report->foto) : asset('logo.png') }}"
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
