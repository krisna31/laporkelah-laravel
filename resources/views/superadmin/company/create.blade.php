<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Company') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('company.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="nama" id="nama" autofocus autocomplete="nama"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required value="{{ old('nama') }}" />
                                <label for="nama"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('Masukkan Nama Perusahaan') }}</label>
                            </div>
                            <x-input-error :messages="$errors->get('name')" />
                        </div>

                        <!-- logo -->
                        <div class="mt-4">
                            <x-input-label for="img" :value="__('Logo Perusahaan')" class="mb-4" />
                            <x-input-error :messages="$errors->get('img')" />
                            <input type="file" name="img" id="img" required>
                        </div>

                        <!-- is_public -->
                        <div class="mt-4">
                            <x-input-label for="is_public" :value="__('Untuk Umum?')" class="mb-4" />
                            <fieldset>
                                <legend class="sr-only">Untuk Umum?</legend>

                                <div class="flex items-center mb-4">
                                    <input id="public-option" type="radio" name="is_public" value=1
                                        class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                        checked>
                                    <label for="public-option"
                                        class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        Public
                                    </label>
                                </div>
                                <div class="flex items-center mb-4">
                                    <input id="private-option" type="radio" name="is_public" value=0
                                        class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="private-option"
                                        class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        Private
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create Company') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script type="module">
            const inputElement = document.querySelector('input[type="file"]');
            const pond = FilePond.create(inputElement, {
                acceptedFileTypes: ['image/*'],
                imageValidateSizeMaxWidth: 1440,
                imageValidateSizeMaxHeight: 1440,
                maxTotalFileSize: 2097152
            });

            FilePond.setOptions({
                server: {
                    url: '/upload',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            })
        </script>
    @endsection
</x-app-layout>
