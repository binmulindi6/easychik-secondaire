<div id="{{$theId.'joker'}}" class="hidden fixed top-0 left-0  justify-center items-center w-screen h-screen bg-slate-500 bg-opacity-30 z-100">
    <div class=" bg-white rounded-5 shadow-2xl container p-5 lg:w-5/12">
        <p class="font-bold text-base"> {{$title}} </p>
        <form method="POST" action="{{$link}}">
            @method('POST')
            @csrf
            <!-- Email Address -->
            {{-- <div class="mt-4">
                <x-label for="nom" :value="__('Nom')" />

                <x-input id="nom" class="block mt-1 w-full" type="text" name="nom" :value="old('nom')"
                    required />
            </div> --}}
            @if (isset($datas))
                @foreach ($datas as $name => $label)
                <div class="mt-4">
                    <x-label for="nom" :value="__($label)" />
    
                    <x-input id="nom" class="block mt-1 w-full" type="text" name="{{$name}}" :value="old($label)"
                        required />
                </div>
                @endforeach
            @endif
            <div class="flex gap-10">
                <div class="mt-4">
                    <x-button>ajouter</x-button>
                </div>
                <div class="mt-4">
                    <x-button-annuler id="{{$theId.'btn'}}" type='reset' class="bg-red-500"></x-button-annuler>
                </div>
            </div>
        </form>
    </div>
</div>
