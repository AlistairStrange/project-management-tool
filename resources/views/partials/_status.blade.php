@if(session('status'))
    <div class="flex bg-green-300 -mt-5">
        <div class="flex-auto text-center py-4 text-green-700 text-md font-semibold">
            {{ session('status') }}
        </div>
    </div>
@elseif(session('error'))
    <div class="flex bg-red-300 -mt-5">
        <div class="flex-auto text-center py-4 text-red-700 text-md font-semibold">
            {{ session('error') }}
        </div>
    </div>
@elseif($errors->any())
    {{-- Request validator errors --}}
    <div class="flex bg-red-300 -mt-5">
        <div class="flex-auto py-4 text-red-700 text-md">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif