<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name -->
                        <div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="nama" id="nama" autofocus autocomplete="nama"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required value="{{ old('nama') }}" />
                                <label for="nama"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('Masukkan Nama User') }}</label>
                            </div>
                            <x-input-error :messages="$errors->get('name')" />
                        </div>

                        <!-- Email -->
                        <div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="email" id="email" autofocus autocomplete="email"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required value="{{ old('email') }}" />
                                <label for="email"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('Masukkan Email User') }}</label>
                            </div>
                            <x-input-error :messages="$errors->get('email')" />
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="password" id="password" autofocus autocomplete="password"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required value="{{ old('password') ?? 'password' }}" />
                                <label for="password"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('Masukkan Password User') }}</label>
                            </div>
                            <x-input-error :messages="$errors->get('email')" />
                        </div>

                        <!-- logo -->
                        <div class="mt-4">
                            <x-input-label for="img" :value="__('Foto User')" class="mb-4" />
                            <x-input-error :messages="$errors->get('img')" />
                            <input type="file" name="img" id="img" required>
                        </div>

                        <!-- role -->
                        <div class="mt-4">
                            <x-input-label for="role" :value="__('Choose Role')" class="mb-4" />
                            <fieldset>
                                <legend class="sr-only">Role</legend>
                                <select id="role" name="role"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach ($roles as $role)
                                        @if ($loop->last)
                                            <option selected value="{{ $role->id }}">{{ $role->jabatan }}</option>
                                        @else
                                            <option value="{{ $role->id }}">{{ $role->jabatan }}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </fieldset>
                        </div>

                        <!-- company -->
                        <div class="mt-4">
                            <x-input-label for="company" :value="__('Choose company')" class="mb-4" />
                            <fieldset>
                                <legend class="sr-only">company</legend>
                                <select id="company" name="company"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach ($companies as $company)
                                        @if ($loop->last)
                                            <option selected value="{{ $company->id }}">{{ $company->nama }}</option>
                                        @else
                                            <option value="{{ $company->id }}">{{ $company->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </fieldset>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create user') }}
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
