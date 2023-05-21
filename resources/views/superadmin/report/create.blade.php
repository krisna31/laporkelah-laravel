<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Report') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                        <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('report.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        <!-- title -->
                        <div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="title" id="title" autofocus autocomplete="title"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required value="{{ old('title') }}" />
                                <label for="title"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">{{ __('Masukkan Title Report') }}</label>
                            </div>
                            <x-input-error :messages="$errors->get('title')" />
                        </div>

                        <!-- keterangan -->
                        <div>
                            <div class="relative z-0 w-full mb-6 group">
                                <label for="keterangan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                                <textarea id="keterangan" rows="4" name="keterangan"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Tulis Keterangan Laporan"></textarea>
                            </div>
                            <x-input-error :messages="$errors->get('title')" />
                        </div>

                        <!-- logo -->
                        <div class="mt-4">
                            <x-input-label for="img" :value="__('Foto Laporan')" class="mb-4" />
                            <x-input-error :messages="$errors->get('img')" />
                            <input type="file" name="img" id="img" required>
                        </div>

                        <!-- company -->
                        <div class="mt-4">
                            <x-input-label for="company" :value="__('Choose company')" class="mb-4" />
                            <fieldset>
                                <select id="company" name="company_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->nama }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('company_id')" />
                            </fieldset>
                        </div>

                        <!-- status -->
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Status Laporan')" class="mb-4" />
                            <fieldset>
                                <div class="flex items-center mb-4">
                                    <input id="open-option" type="radio" name="status" value=1
                                        class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600"
                                        checked>
                                    <label for="open-option"
                                        class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                        Open
                                    </label>
                                </div>
                            </fieldset>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create Report') }}
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
