@if (isset($state) && $state === 0)
    <div class="px-2 py-2 flex flex-row gap-2 items-center rounded-2xl bg-zinc-700/10 hover:bg-slate-100 cursor-pointer">
    @else
        <div class="px-2 py-2 flex flex-row gap-2 items-center rounded-2xl hover:bg-slate-100 cursor-pointer">
@endif
@if (isset($state) && $state === 0)
    <span
        class="flex  justify-center-items-center p-3 sm:p-4   rounded-full fa fa-solid fa-message text-blue-700 bg-white"></span>
@else
    <span class="flex  justify-center-items-center p-3 sm:p-4 text-white rounded-full fa fa-solid fa-check bg-blue-700"></span>
@endif
<div class="flex flex-col">
    <div class="flex flex-col sm:flex-row justify-between sm:items-center pl-3">
        <span class="font-semibold text-4 text-black">
            {{ $from }} : {{ $object }}
        </span>
        <span class=" text-3 text-slate-400">
            {{ $time }}
        </span>
    </div>
    <span class="pl-3 w-full h-6 overflow-hidden">
        {{ $message }}
    </span>
</div>
</div>
