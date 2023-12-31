<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Company ' . $company->nama) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto sm:rounded-lg my-5">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nama Perusahaan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Public
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created At
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Updated At
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        <img class="w-10 h-10 p-1 rounded-full ring-1 ring-gray-300 dark:ring-gray-500"
                                            src="{{ public_path('/storage/company' . $company->foto) }}"
                                            alt="{{ $company->nama }}">
                                        <div class="pl-3">
                                            <div class="text-base font-semibold">{{ $company->nama }}
                                            </div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $company->is_public ? 'Public' : 'Private' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $company->created_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $company->updated_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h1 class="text-center bold my-5 text-3xl">Users Belongs to This Company</h1>
                    @include('layouts.table-users', [
                        'users' => $company->users,
                    ])
                    <h1 class="text-center bold my-5 text-3xl">Reports Belongs to This Company</h1>
                    @include('layouts.report-accordion', [
                        'company' => $company,
                    ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
