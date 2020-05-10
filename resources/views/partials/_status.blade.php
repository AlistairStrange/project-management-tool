<div class="flex bg-green-300">
    @if(session('status'))
        <div class="flex-auto text-center">
            {{ session('status') }}
        </div>
    @endif
</div>