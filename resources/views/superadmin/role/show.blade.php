<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Role ' . $role->jabatan) }}
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
                                        ID Role
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Jabatan
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Deskripsi
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
                                        {{ $role->id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $role->jabatan }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $role->deskripsi }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $role->created_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $role->updated_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h1 class="text-center bold my-5 text-3xl">Users Belongs to This Role</h1>
                        @include('layouts.table-users', [
                            'users' => $role->users,
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
