<div>
    @if ($editing)
        <br>
        <div class="bg-primary-200 rounded-md">
            <div class="bg-primary-300 rounded-t-md">
                <p class="px-2 text-primary-600">Editing</p>
            </div>
            <div class="p-2 space-y-2">
                    <div>
                        <textarea 
                            class="rounded-md w-full bg-primary-100 px-2" 
                            type="text" 
                            name="editing_body" 
                            wire:model="editing_body" 
                            value="{{ old('editing_body') }}"
                        >
                        </textarea>
                    </div>
                    <button
                        wire:click="update()"
                        class="px-4 rounded-md bg-primary-300 hover:bg-secondary-300 hover:text-primary-100"
                        type="submit"
                    > Submit</button>
                    <button 
                        class="px-4 bg-primary-300 rounded-md hover:bg-secondary-300 hover:text-primary-100" 
                        wire:click="closeEdit"
                    >Close</button>
            </div>
        </div>
        <br>
    @endif

    @if ($show)
        <br>
        <div class="rounded-md bg-primary-200 outline-primary-900">
            <div class="bg-primary-300 rounded-t-md">
                <p class="px-2 text-primary-600">New Reply</p>
            </div>
            <div class="p-2 space-y-2">
                <form 
                    wire:submit.prevent="submit" 
                    class="space-y-2"
                >
                    <div>
                        <textarea 
                            class="w-full rounded-md bg-primary-100 px-2" 
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
                    > Submit</button>
                </form>
                <button 
                    class="px-4 bg-primary-300 rounded-md hover:bg-secondary-300 hover:text-primary-100" 
                    wire:click="toggleShow"
                >Close</button>
            </div>
        </div>
        <br>
    @endif

    <div 
        class="pt-2 space-x-2 flex w-full"
    >
        <a 
            class="px-2 rounded-md bg-primary-200 hover:bg-secondary-300 hover:text-primary-100" 
            href="{{ route('forum.show', ['sub_forum' => $sub_forum]) }}">back
        </a>
        <button 
            class="px-4 rounded-md bg-primary-200 hover:bg-secondary-300 hover:text-primary-100"
            wire:click="toggleShow"
        >Quick Reply</button>
    </div>

    <div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p style="color: red;">{{ $error }}</p>
            @endforeach
        @endif
    </div>


    <div class="pl-8 pt-2 space-y-2">
        @foreach($paginated_replies as $reply)
            <div 
                @if (Auth::user())
                    @if (Auth::user()->id == $reply->user_id)
                        class="p-2 bg-primary-300 rounded-md space-y-2"
                    @else
                        class="p-2 bg-primary-200 rounded-md space-y-2"
                    @endif
                @else
                    class="p-2 bg-primary-200 rounded-md space-y-2"
                @endif
            >
                <div 
                    class="flex justify-between text-lg w-full"
                >
                    <p class="text-base">
                        {{ $reply->body }}
                    </p>
                    @if (Auth::user())
                        @if (Auth::user()->id == $reply->user_id)
                            <div 
                                class="order-last flex space-x-2 text-sm text-secondary-700"
                            >
                                <div>
                                    <button 
                                        class="hover:underline hover:text-secondary-500" 
                                        wire:click="edit({{ $reply }})"
                                    >edit</button>
                                </div>
                                <div>
                                    <button 
                                        class="hover:underline hover:text-secondary-500" 
                                        wire:click="remove({{ $reply }})"
                                    >remove</button>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
                <div 
                    class="flex flex-row-reverse"
                >
                    <p 
                        class="text-sm text-primary-500"
                    >
                        Posted By: <a class="hover:underline hover:text-primary-700" href="{{ route('profile.show', ['user'=>$reply->User]) }}">{{ $reply->User->name }}</a> | Posted On: {{ $reply->created_at }}
                    </p>
                </div>
            </div>
        @endforeach
        @if (!empty($paginated_replies))
            {{ $paginated_replies->links() }}
        @endif
    </div>
</div>
