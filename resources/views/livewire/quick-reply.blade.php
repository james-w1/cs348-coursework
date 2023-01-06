<div>
    @if (Auth::user())
        {{ dd(Auth::user()); }}
        <button 
            class="px-4 rounded-md bg-primary-200 hover:bg-secondary-300 hover:text-primary-100"
            wire:click="toggleShow"
        >Quick Reply</button>
    @endif

    @if ($show)
    <div class="absolute flex p-2 rounded-md bg-primary-200 outline-primary-900 opacity-85">
        <form 
            wire:submit.prevent="submit" 
            class="space-y-2"
        >
            @csrf
            <div>
                <p class="text-primary-600">Body</p>
                <textarea 
                    class="rounded-md bg-primary-100 px-2" 
                    type="text" 
                    name="body" 
                    wire:model="body" 
                    value="{{ old('body') }}"
                >
                </textarea>
            </div>
            <button
                wire:click="toggleShow" 
                class="px-4 rounded-md bg-primary-300 hover:bg-secondary-300 hover:text-primary-100"
                type="submit"
            >
                Submit
            </button>
        </form>
    </div>
    @endif

    <div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p style="color: red;">{{ $error }}</p>
            @endforeach
        @endif
    </div>
</div>

