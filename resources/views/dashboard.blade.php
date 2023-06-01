<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="text-gray-900 dark:text-gray-100 flex flex-1 justify-between flex-col p-16 pb-0">
                    <div class="container-fluid flex    justify-between">

                        <a href="{{ route('company.index') }}"
                            class="flex flex-col justify-center align-center max-w-sm p-12 border rounded-lg shadow dark:text-black bg-gradient-to-r from-orange-600 to-orange-500 text-white hover:from-pink-500 hover:via-red-500 hover:to-yellow-500 dark:from-gray-300 dark:via-gray-500 dark:to-gray-700 dark:hover:from-gray-400 dark:hover:via-gray-600 dark:hover:to-blue-800">
                            <h2 class="text-center">Total Company</h2>
                            <p class="text-center">{{ $companies->count() }} Company</p>
                        </a>
                        <a href="{{ route('user.index') }}"
                            class="flex flex-col justify-center align-center max-w-sm p-12 border rounded-lg shadow dark:text-black bg-gradient-to-r from-orange-600 to-orange-500 text-white hover:from-pink-500 hover:via-red-500 hover:to-yellow-500 dark:from-gray-300 dark:via-gray-500 dark:to-gray-700 dark:hover:from-gray-400 dark:hover:via-gray-600 dark:hover:to-blue-800">
                            <h2 class="text-center">Total User</h2>
                            <p class="text-center">{{ $users->count() }} User</p>
                        </a>
                        @can('viewAny', App\Models\Role::class)
                            <a href="{{ route('role.index') }}"
                                class="flex flex-col justify-center align-center max-w-sm p-12 border rounded-lg shadow dark:text-black bg-gradient-to-r from-orange-600 to-orange-500 text-white hover:from-pink-500 hover:via-red-500 hover:to-yellow-500 dark:from-gray-300 dark:via-gray-500 dark:to-gray-700 dark:hover:from-gray-400 dark:hover:via-gray-600 dark:hover:to-blue-800">
                                <h2 class="text-center">Total Role</h2>
                                <p class="text-center">{{ $roles->count() }} Role</p>
                            </a>
                        @endcan
                        <a href="{{ route('report.index') }}"
                            class="flex flex-col justify-center align-center max-w-sm p-12 border rounded-lg shadow dark:text-black bg-gradient-to-r from-orange-600 to-orange-500 text-white hover:from-pink-500 hover:via-red-500 hover:to-yellow-500 dark:from-gray-300 dark:via-gray-500 dark:to-gray-700 dark:hover:from-gray-400 dark:hover:via-gray-600 dark:hover:to-blue-800">
                            <h2 class="text-center">Total Report</h2>
                            <p class="text-center">{{ $reports->count() }} Report</p>
                        </a>
                    </div>
                    <div class="container-fluid flex flex-col justify-center md:flex-row items-center mt-9">
                        <div
                            class="container-fluid flex flex-col gap-8 justify-center w-1/2 h-1/2     rounded min-w-full">
                            @include('layouts.report-accordion', [
                                'reports' => $reports->take(5),
                                'heading' => 'Latest Report',
                            ])
                        </div>
                    </div>
                    <div class="container-fluid my-10 p-10 dark:bg-slate-300 rounded">
                        {!! $chartLine->renderHtml() !!}
                    </div>
                    <div class="container-fluid my-10 p-10 dark:bg-slate-300 rounded">
                        {!! $chartBar->renderHtml() !!}
                    </div>
                    <div class="container-fluid flex flex-col gap-8 justify-center md:flex-row items-center">
                        <div class="container-fluid my-10 flex flex-col gap-8 justify-center w-1/2 h-1/2     rounded">
                            <h1 class="text-center bold my-5 text-3xl mt-10">{{ $chartReport->options['chart_title'] }}
                            </h1>
                            {!! $chartReport->renderHtml() !!}
                        </div>
                        @isset($chartCompany)
                            <div class="container-fluid my-10 flex flex-col gap-8 justify-center w-1/2 h-1/2     rounded">
                                <h1 class="text-center bold my-5 text-3xl mt-10">
                                    {{ $chartCompany->options['chart_title'] }}</h1>
                                {!! $chartCompany->renderHtml() !!}
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
    @section('script')
        {!! $chartBar->renderChartJsLibrary() !!}
        {!! $chartBar->renderJs() !!}
        {!! $chartReport->renderJs() !!}
        {!! $chartLine->renderJs() !!}
        @isset($chartCompany)
            {!! $chartCompany->renderJs() !!}
        @endisset
    @endsection
</x-app-layout>
