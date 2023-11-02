@extends('layouts.admin')

@section('content')
    <div class=" container flex flex-col justify-between gap-5">
        <x-nav-horaire :pagename="$page_name"> </x-nav-horaire>
        <div class="display shadow-2xl container p-4 bg-white rounded-5">
            <div class="flex flex-wrap w-full justify-center">
                <a href="{{ route('presences-eleves.index') }}"
                    class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white hover:bg-slate-200 shadow-2xl dark:bg-slate-850 rounded-2xl bg-clip-border mb-4">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row items-center -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div class="flex flex-col justify-center">
                                        <span
                                            class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                            Présences : </span>
                                        <span
                                            class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                            Elèves</span>
                                        {{-- <span
                                            class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                            Non Classés : {{ count($data['non_classe']) }}</span> --}}
                                    </div>
                                </div>
                                <div class="px-3 flex justify-center items-center basis-1/3">
                                    <div
                                        class="w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-teal-400 flex justify-center items-center">
                                        <span class="font-bold text-white fa fa-solid fa-chalkboard-user"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @if (!Auth::user()->isParent())
                    <a href="{{ route('presences.employers.index') }}"
                        class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                        <div
                            class="relative flex flex-col min-w-0 break-words bg-white hover:bg-slate-200 shadow-2xl dark:bg-slate-850 rounded-2xl bg-clip-border mb-4">
                            <div class="flex-auto p-4">
                                <div class="flex flex-row items-center -mx-3">
                                    <div class="flex-none w-2/3 max-w-full px-3">
                                        <div class="flex flex-col justify-center">
                                            <span
                                                class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                                Présences : </span>
                                            <span
                                                class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                                Personnel</span>
                                            {{-- <span
                                        class="mb-0 font-sans font-semibold leading-normal uppercase dark:text-white dark:opacity-60 text-size-sm">
                                        Non Classés : {{ count($data['non_classe']) }}</span> --}}
                                        </div>
                                    </div>
                                    <div class="px-3 flex justify-center items-center basis-1/3">
                                        <div
                                            class="w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-teal-400 flex justify-center items-center">
                                            <span class="font-bold text-white fa fa-solid fa-user"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
