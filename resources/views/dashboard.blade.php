<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100 flex flex-1 justify-between flex-col p-16">
                    <div class="container-fluid flex    justify-between">

                        <a href="{{ route('company.index') }}"
                            class="flex flex-col justify-center align-center max-w-sm p-12 bg-green-200 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-white-800 dark:border-white-700 dark:hover:bg-green-700 dark:text-black">
                            <h2 class="text-center">Total Company</h2>
                            <p class="text-center">{{ $companies->count() }} Company</p>
                        </a>
                        <a href="{{ route('user.index') }}"
                            class="flex flex-col justify-center align-center max-w-sm p-12 bg-green-200 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-white-800 dark:border-white-700 dark:hover:bg-green-700 dark:text-black">
                            <h2 class="text-center">Total User</h2>
                            <p class="text-center">{{ $users->count() }} User</p>
                        </a>
                        @can('viewAny', Role::class)
                            <a href="{{ route('role.index') }}"
                                class="flex flex-col justify-center align-center max-w-sm p-12 bg-green-200 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-white-800 dark:border-white-700 dark:hover:bg-green-700 dark:text-black">
                                <h2 class="text-center">Total Role</h2>
                                <p class="text-center">{{ $roles->count() }} Role</p>
                            </a>
                        @endcan
                        <a href="{{ route('report.index') }}"
                            class="flex flex-col justify-center align-center max-w-sm p-12 bg-green-200 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-white-800 dark:border-white-700 dark:hover:bg-green-700 dark:text-black">
                            <h2 class="text-center">Total Report</h2>
                            <p class="text-center">{{ $reports->count() }} Report</p>
                        </a>
                    </div>
                    <div class="container-fluid my-10 p-10 dark:text-white">
                        {!! $chart->renderHtml() !!}
                    </div>
                    <div class="container-fluid flex flex-row gap-8 justify-center">
                        <div class="container-fluid my-10 flex flex-col gap-8 justify-center w-1/2 h-1/2">
                            <h1 class="text-center">{{ $chart2->options['chart_title'] }}</h1>
                            {!! $chart2->renderHtml() !!}
                        </div>
                        <div class="container-fluid my-10 flex flex-col gap-8 justify-center w-1/2 h-1/2">
                            <h1 class="text-center">{{ $chart3->options['chart_title'] }}</h1>
                            {!! $chart3->renderHtml() !!}
                        </div>
                    </div>
                </div>
                <p class="my-10 text-sm text-center text-gray-500 dark:text-white">
                    &copy; 2023 - {{ now()->year }} —
                    <a href="https://github.com/krisna31" class="hover:underline" target="_blank">LaporKelah</a>. All
                    rights
                    reserved.
                </p>
            </div>
        </div>
    </div>
    @section('script')
        {!! $chart->renderChartJsLibrary() !!}
        {!! $chart->renderJs() !!}
        {!! $chart2->renderJs() !!}
        {!! $chart3->renderJs() !!}
    @endsection
</x-app-layout>
