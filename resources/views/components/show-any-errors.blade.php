@if ($errors->any())
    <div class="mb-4 text-red-600">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <hr class="my-4">
    </div>
@endif
