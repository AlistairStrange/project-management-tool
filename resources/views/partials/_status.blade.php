<div class="flex bg-green-300 -mt-5">
    @if(session('status'))
        <div class="flex-auto text-center py-4 text-green-700 text-lg font-semibold">
            {{ session('status') }}
        </div>
    @endif
</div>