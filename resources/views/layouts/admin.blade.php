<!DOCTYPE html>
<html class="h-full w-full bg-salte-100">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" /-->
    <!--link rel="icon" type="image/png" href="../assets/img/favicon.png" /-->
    <title> {{ config('app.name', 'SAS') }} - {{ $page_name }} </title>
    <!--     Fonts and icons     -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" /> --}}
    <!-- Font Awesome Icons -->
    <!--script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script-->
    <!-- Popper -->
    <!--script src="https://unpkg.com/@popperjs/core@2"></script-->



    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="m-0 font-sans antialiased font-normal dark:bg-slate-900 text-size-base leading-default bg-gray-50 text-slate-500">
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
    <!-- sidenav  -->
    <aside
        class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-2xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
        aria-expanded="false">
        <div class="h-19 mt-3 flex justify-center">
            <a class="flex flex-col justify-center items-center px- py- m-0 text-size-sm whitespace-nowrap dark:text-white text-slate-700" href="{{ route('dashboard') }}">
                <span class="font-bold text-blue-500 text-3xl  py-2 px-4 rounded-md">S.A.S</span>
                @if (Auth::user()->isAdmin())
                    <span class="font-bold text-blue-500 uppercase">Admin</span>
                @endif
                @if (Auth::user()->isDirecteur())
                    <span class="font-bold text-blue-500 uppercase">Direction</span>
                @endif
                @if (Auth::user()->isParent())
                    <span class="font-bold text-blue-500 uppercase">Parent</span>
                @endif
                @if (Auth::user()->isSecretaire())
                    <span class="font-bold text-blue-500  uppercase">Secretariat</span>
                @endif
                @if (Auth::user()->isEnseignant())
                    <span class="font-bold text-blue-500  uppercase">
                        @if (Auth::user()->classe())
                            {{Auth::user()->classe->niveau->nom . ' ' . Auth::user()->classe->nom}}
                        @else
                            Enseignant
                        @endif
                    </span>
                @endif
            </a>
        </div>

        <hr
            class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

        <div class="items-center block w-auto max-h-screen overflow-auto  grow basis-full">
            <!--h-sidenav-->
            <ul class="flex flex-col pl-0 mb-0">

                <li class="mt-0.5 w-full">
                    @if (str_contains($page_name, 'Dashboard'))
                        <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                            href="{{ route('dashboard') }}">
                        @else
                            <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                href="{{ route('dashboard') }}">
                    @endif
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class="relative top-0 leading-normal text-blue-500 fa fa-solid fa-television text-size-sm"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
                    </a>
                </li>

                @if (Auth::user()->isAdmin() || Auth::user()->isDirecteur())
                    <li class="mt-0.5 w-full">
                        @if (str_contains($page_name, 'Ecole') ||
                                str_contains($page_name, 'Annees Scolaires') ||
                                str_contains($page_name, 'Trimestres') ||
                                str_contains($page_name, 'Conduites') ||
                                str_contains($page_name, 'Periodes'))
                            <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                                href="{{ route('ecole.index') }}">
                            @else
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    href="{{ route('ecole.index') }}">
                        @endif
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 leading-normal text-black fa fa-solid fa-school text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ecole</span>
                        </a>
                    </li>

                    <li class="mt-0.5 w-full">
                        @if (str_contains($page_name, 'Classes') ||
                                str_contains($page_name, 'Niveaux'))
                            <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                                href="{{ route('classes.index') }}">
                            @else
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    href="{{ route('classes.index') }}">
                        @endif
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i
                                class="relative top-0 leading-normal text-green-500 fa fa-solid fa-chalkboard text-size-sm">
                            </i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Classes</span>
                        </a>
                    </li>

                    <li class="mt-0.5 w-full">
                        @if (str_contains($page_name, 'Frais'))
                            <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                                href="{{ route('frais.index') }}">
                            @else
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    href="{{ route('frais.index') }}">
                        @endif
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i
                                class="relative top-0 leading-normal text-black fa fa-solid fa-money-bill text-size-sm">
                            </i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Frais</span>
                        </a>
                    </li>
                    
                    <li class="mt-0.5 w-full">
                        @if (
                                str_contains($page_name, 'Categories Cours') ||
                                str_contains($page_name, 'Cours'))
                            <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                                href="{{ route('categorie-cours.index') }}">
                            @else
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    href="{{ route('categorie-cours.index') }}">
                        @endif
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i
                                class="relative top-0 leading-normal text-blue-500 fa fa-solid fa-book text-size-sm">
                            </i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Enseignement</span>
                        </a>
                    </li>

                @endif
                    <li class="mt-0.5 w-full">
                        @if (str_contains($page_name, 'Eleves') || str_contains($page_name, 'Frequentations'))
                            <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                                href="{{ route('eleves.index') }}">
                            @else
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    href="{{ route('eleves.index') }}">
                        @endif
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i
                                class="relative top-0 leading-normal text-red-500 fa fa-solid fa-chalkboard-user text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Eleves</span>
                        </a>
                    </li>
                    {{-- @if (Auth::user()->isParent())
                        <li class="mt-0.5 w-full">
                            @if (str_contains($page_name, 'Frais'))
                                <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                                    href="{{ route('eleves.paiements.show') }}">
                                @else
                                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                        href="{{ route('eleves.paiements.show') }}">
                            @endif
                            <div
                                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                <i
                                    class="relative top-0 leading-normal text-black fa fa-solid fa-money-bill text-size-sm">
                                </i>
                            </div>
                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Frais</span>
                            </a>
                        </li>
                    @endif --}}
                @if( Auth::user()->isSecretaire())
                    <li class="mt-0.5 w-full">
                        @if (str_contains($page_name, 'Paiements'))
                            <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                                href="{{ route('paiements.index') }}">
                            @else
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    href="{{ route('paiements.index') }}">
                        @endif
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i
                                class="relative top-0 leading-normal text-black fa fa-solid fa-money-bill text-size-sm">
                            </i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Paiements</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->isAdmin() || Auth::user()->isEnseignant())
                    <li class="mt-0.5 w-full">
                        @if (str_contains($page_name, 'Travails') ||
                                str_contains($page_name, 'Evaluations') ||
                                str_contains($page_name, 'Examens')
                                )
                            <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                                href="{{ route('travails.index') }}">
                            @else
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    href="{{ route('travails.index') }}">
                        @endif
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i
                                class="relative top-0 leading-normal text-blue-500 fa fa-regular fa-clipboard text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Traveaux</span>
                        </a>
                    </li>

                    <li class="mt-0.5 w-full">
                        @if (str_contains($page_name, 'Classes') ||
                                str_contains($page_name, 'Niveaux'))
                            <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                                href="{{ route('classes.show', Auth::user()->classe->id) }}">
                            @else
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    href="{{ route('classes.show', Auth::user()->classe->id) }}">
                        @endif
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i
                                class="relative top-0 leading-normal text-black fa fa-solid fa-chalkboard text-size-sm">
                            </i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Ma Classe</span>
                        </a>
                    </li>
                    {{-- <li class="mt-0.5 w-full">
                        @if (str_contains($page_name, 'Eleves / Evaluations') || str_contains($page_name, 'Eleves / Examens'))
                            <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                                href="{{ route('cotations.index') }}">
                            @else
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    href="{{ route('cotations.index') }}">
                        @endif
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i
                                class="relative top-0 leading-normal text-black fa fa-solid fa-pen-to-square text-size-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Cotations </span>
                        </a>
                    </li> --}}
                @endif
                @if (Auth::user()->isAdmin())
                    <li class="mt-0.5 w-full">
                        @if (str_contains($page_name, 'Employers'))
                            <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                                href="{{ route('employers.index') }}">
                            @else
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    href="{{ route('employers.index') }}">
                        @endif
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 leading-normal text-emerald-500 text-size-sm fa fa-solid fa-user"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Employers</span>
                        </a>
                    </li>

                    <li class="mt-0.5 w-full">
                        @if (str_contains($page_name, 'Utilisateurs') || str_contains($page_name, 'Encadrements') || str_contains($page_name, 'Parents'))
                            <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                                href="{{ route('users.index') }}">
                            @else
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    href="{{ route('users.index') }}">
                        @endif
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 leading-normal text-black text-size-sm fa fa-solid fa-user"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Utilisateurs</span>
                        </a>
                    </li>
                @endif
                
                @if (Auth::user()->isSecretaire() || Auth::user()->isDirecteur())
                    <li class="mt-0.5 w-full">
                        @if (str_contains($page_name, 'Parents'))
                            <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                                href="{{ route('parents.index') }}">
                            @else
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    href="{{ route('parents.index') }}">
                        @endif
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 leading-normal text-black text-size-sm fa fa-solid fa-user"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Parents</span>
                        </a>
                    </li>
                @endif

                @if(Auth::user()->isDirecteur() || Auth::user()->isParent())
                    <li class="mt-0.5 w-full">
                        @if (str_contains($page_name, 'Messages'))
                            <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
                                href="{{ route('messages.index') }}">
                            @else
                                <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                                    href="{{ route('messages.index') }}">
                        @endif
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 leading-normal text-black text-size-sm fa fa-solid fa-message"></i>
                        </div>
                            <div class="w-full flex flex-row items-center gap-5">
                                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Messages</span>
                                <span class="p-flex justify-center font-bold text-4 text-red-500">{{Auth::unread()}}</span>
                            </div>
                        </a>
                    </li>
                @endif

                <li class="w-full mt-4">
                    <h6 class="pl-6 ml-2 font-bold leading-tight uppercase dark:text-white text-size-xs opacity-60">
                        Gestion Compte</h6>
                </li>

                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{route('profile.index')}}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 leading-normal text-blue-700 text-size-sm fa fa-solid fa-user"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Profile</span>
                    </a>
                </li>
                <li class="mt-0.5 w-full">
                    <a class=" dark:text-white dark:opacity-80 py-2.7 text-size-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                        href="{{route('profile.index')}}">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 leading-normal text-blue-700 text-size-sm fa fa-solid fa-cog"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Parametres</span>
                    </a>
                </li>


            </ul>
        </div>

    </aside>

    <!-- end sidenav -->

    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        <!-- Navbar -->
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
            navbar-main navbar-scroll="false">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <nav>
                    <!-- breadcrumb -->
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="leading-normal text-size-sm">
                            <a class="text-white opacity-50" href="javascript:;">Pages</a>
                        </li>
                        <li class="text-size-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
                            aria-current="page">{{ $page_name }}</li>
                    </ol>
                    <h6 class="mb-0 font-bold text-white capitalize">{{ $page_name }}</h6>
                </nav>

                <div class="flex items-center justify-end mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                    <!--div class="flex items-center md:ml-auto md:pr-4">
              <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">
                <span class="text-size-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                  <i class="fas fa-search"></i>
                </span>
                <input type="text" class="pl-9 text-size-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 dark:bg-slate-850 dark:text-white bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow" placeholder="Type here..." />
              </div>
            </div-->
                    <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full gap-2">
                        <!-- online builder btn  -->
                        <!-- <li class="flex items-center">
                <a class="inline-block px-8 py-2 mb-0 mr-4 font-bold text-center text-blue-500 uppercase align-middle transition-all ease-in bg-transparent border border-blue-500 border-solid rounded-lg shadow-none cursor-pointer leading-pro text-size-xs hover:-translate-y-px active:shadow-xs hover:border-blue-500 active:bg-blue-500 active:hover:text-blue-500 hover:text-blue-500 tracking-tight-rem hover:bg-transparent hover:opacity-75 hover:shadow-none active:text-white active:hover:bg-transparent" target="_blank" href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard&amp;_ga=2.76518741.1192788655.1647724933-1242940210.1644448053">Online Builder</a>
              </li> -->


                        <li id="profile" class="flex items-center">
                            <div
                                class=" p-0 text-white font-semibold transition-all text-size-sm ease-nav-brand cursor-pointer hover:bg-slate-300 rounded-2 px-2 py-1">
                                <i fixed-plugin-button-nav class="cursor-pointer fa fa-user" title="logout"></i>
                                @if (Auth::user()->parrain_id === null)
                                    <span class="hidden sm:inline">Bienvenu, {{ Auth::user()->employer->prenom }}</span>
                                @else
                                    <span class="hidden sm:inline">Bienvenu, {{ Auth::user()->parrain->prenom }}</span>
                                @endif
                            </div>
                        </li>

                        <div id="profile-popper" class="opacity-0 bg-white rounded p-2 shadow-2xl">
                            <li class="relative">
                                <a class=" cursor-pointer flex justify-center dkr:hover:bg-slate-900 ease py-2 clear-both  w-full whitespace-nowrap rounded-lg bg-transparent px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors"
                                    href="{{ url('profile') }}">
                                    <div
                                        class="p-0 text-black font-semibold transition-all text-size-sm ease-nav-brand">
                                        <i class="text-blue-500 fa fa-user sm:mr-1"></i>
                                        <span class="hidden sm:inline">Profile</span>
                                    </div>
                                </a>

                                <div
                                    class=" cursor-pointer flex justify-center dkr:hover:bg-slate-900 ease py-2 clear-both  w-full whitespace-nowrap rounded-lg bg-transparent px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors">
                                    <form id="profile" class="flex items-center px-4"
                                        action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit"
                                            class="p-0 text-black font-semibold transition-all text-size-sm ease-nav-brand ">
                                            <i fixed-plugin-button-nav class=" text-red-500 fa fa-lock"
                                                title="logout"></i>
                                            <span class="hidden sm:inline">Deconnexion</span>
                                        </button title="logout">
                                    </form>
                                </div>

                            </li>
                        </div>

                        <li id="notify" class="flex items-center">
                            <div
                                class="block font-semibold text-white transition-all ease-nav-brand text-size-sm hover:bg-slate-300 rounded-2 px-2 py-1">
                                <i class="fa fa-bell sm:mr-1"></i>
                                <span class="hidden sm:inline"></span>
                            </div>
                        </li>

                        <li class="flex items-center xl:hidden">
                            <a href="javascript:;"
                                class="block  text-white font-semibold transition-all ease-nav-brand text-size-sm hover:bg-slate-300 rounded-2 px-2 py-2"
                                sidenav-trigger>
                                <div class="w-4.5 overflow-hidden">
                                    <i
                                        class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                    <i
                                        class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                    <i class="ease relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                </div>
                            </a>
                        </li>

                        <div id="notify-popper" class="opacity-0 bg-white rounded-2 p-2 shadow-2xl">
                            <li class="relative">
                                <div
                                    class="dark:hover:bg-slate-900 ease py-1.2 clear-both block w-full whitespace-nowrap rounded-lg bg-transparent px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors">
                                    <div class="flex py-1">
                                        <div class="my-auto">
                                            <span
                                                class=" bg-blue-300 inline-flex items-center justify-center mr-4 text-white text-size-sm h-9 w-9 max-w-none rounded-xl">
                                            </span>
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-1 font-normal leading-normal dark:text-white text-size-sm">
                                                <span class="font-semibold">New message</span> from Laur
                                            </h6>
                                            <p
                                                class="mb-0 leading-tight text-size-xs text-slate-400 dark:text-white/80">
                                                <i class="mr-1 fa fa-clock"></i>
                                                13 minutes ago
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- end Navbar -->

        <!-- cards -->
        <div class="w-full px-6 py-6 mx-auto">
            @yield('content')
        </div>
        <!-- end cards -->



    </main>
    </div>
</body>

</html>
