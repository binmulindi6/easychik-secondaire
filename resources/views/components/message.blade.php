@if(isset($state) && $state === 0)
<div class="px-2 py-2 flex flex-row gap-2 items-center rounded-2xl bg-zinc-100 hover:bg-slate-100 cursor-pointer">
@else
<div class="px-2 py-2 flex flex-row gap-2 items-center rounded-2xl hover:bg-slate-100 cursor-pointer">
@endif
    <span class="flex justify-center-items-center p-4 text-white rounded-full fa fa-solid fa-message bg-slate-400"></span>
    <div class="flex flex-col">
        <div class="flex flex-row justify-between items-center pl-3">
            <span class="font-semibold text-4">
                {{$from}}
            </span>
            <span class=" text-3 text-slate-400">
                {{$time}}
            </span>
        </div>
        <span class="w-full h-6 overflow-hidden">
            {{$message}}
        </span>
    </div>
</div>