<a href="{{ route($to) }}" class="w-full max-w-full px-3">
    <div
        class="relative flex flex-col min-w-0 break-words bg-white hover:bg-slate-200 dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border mb-4 shadow-xs">
        <div class="flex-auto p-4">
            <div class="flex flex-row items-center -mx-3">
                <div class="flex flex-row gap-2 max-w-full px-3">
                    @if (str_contains($title, "Frais"))
                    <span class="fa fa-solid fa-money-bill rounded-full p-5 bg-zinc-100 text-8 shadow-xxs"></span>
                    @else
                    <span class="fa fa-solid fa-chart-line rounded-full p-5 bg-zinc-100 text-8 shadow-xxs"></span>
                    @endif
                    <div class="flex flex-col justify-center">
                        <span
                            class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                            Rapport</span>
                        <span
                            class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                            {{$title}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
