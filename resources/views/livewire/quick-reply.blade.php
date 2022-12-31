<div>
    <button 
        class="px-4 rounded-md bg-primary-200 hover:bg-secondary-300 hover:text-primary-100"
        wire:click="toggleShow"
    >Quick Reply</button>

    @if ($show)
    <div class="absolute flex p-2 rounded-md bg-primary-300 outline-primary-900">
        <form 
            wire:submit.prevent="submit" 
            class="space-y-2"
        >
            @csrf
            <p>Body: <input class="rounded-md bg-primary-100 px-2" type="text" name="body" wire:model="body" value="{{ old('body') }}"></p>
            <button
                wire:click="toggleShow" 
                class="px-4 rounded-md bg-primary-200 hover:bg-secondary-300 hover:text-primary-100"
                type="submit"
            >
            Submit
            </button>
        </form>
    </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p style="color: red;">{{ $error }}</p>
        @endforeach
    @endif
</div>

