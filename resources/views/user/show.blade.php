<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Company ' . $user->nama) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID User
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Foto Profil
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama User
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email User
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Role User
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Company
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
                                    <td class="px-6 py-4">
                                        {{ $user->id }}
                                    </td>
                                    <td>
                                        <img class="w-10 h-10 p-1 rounded-full ring-1 ring-gray-300 dark:ring-gray-500"
                                            src="{{ asset('/storage/user/' . $user->foto) }}" alt="{{ $user->name }}">
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->role->jabatan }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->company->nama ?? 'superadmin' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->created_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->updated_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h1 class="text-center bold my-5 text-3xl mt-10">Reports Belongs to This User</h1>
                        @include('layouts.report-accordion', [
                            'reports' => $user->reports,
                        ])
                        <h1 class="text-center bold my-5 text-3xl mt-10">Comments Belongs to This User</h1>
                        @include('layouts.comments', [
                            'comments' => $user->comments,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
