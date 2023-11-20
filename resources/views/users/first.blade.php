<x-guest-layout>
    {{-- <x-auth-card> --}}
    {{-- <x-slot name="logo">
            <a href="/">S.A.S
                <p class="font-bold text-white text-5xl bg-gradient-to-r from-cyan-500 to-blue-500 py-2 px-3 rounded-md"></p>
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
    <main class="mt-0  transition-all duration-200 ease-in-out bg-white">
        <section>
            <div class="relative flex items-center min-h-screen p-0 overflow-hidden bg-center bg-cover">
                <div class="container z-1">
                    <div class="flex flex-col-reverse items-center justify-center flex-wrap -mx-3 z-full">
                        <div class="flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-10/12 ">
                            <div
                                class="relative  flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 dark:bg-gray-950 rounded-2xl bg-clip-border">
                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                <div class=" p-2 md:pl-6 pt-2 pb-0 mb-0  w-full text-center">
                                    <h4 class="font-bold">Création de Votre Compte Utilisateur</h4>
                                    <p class="mb-0">Veuillez Fournir ces Information pour Créer votre
                                        compte Utilisateur</p>
                                </div>
                                <div class="flex-auto p-2 md:p-5">
                                    <form method="POST" action="{{ route('ecole.store.first.user') }}">
                                        @csrf

                                        <!-- Name -->
                                        <div>
                                            <x-label for="matricule" :value="__('Matricule de L\'Employé')" />
                                            @if (isset($employer))
                                                <x-input id="matricule" class="block mt-1 w-full" type="text"
                                                    name="matricule" :value="$employer->matricule" readonly required />
                                            @else
                                                <x-input id="matricule" class="block mt-1 w-full" type="text"
                                                    name="matricule" :value="old('matricule')" required autofocus />
                                            @endif
                                        </div>

                                        <!-- Email Address -->
                                        <div class="mt-4">
                                            <x-label for="email" :value="__('Entrez votre Email')" />

                                            <x-input id="email" class="block mt-1 w-full" type="email"
                                                name="email" :value="old('email')" required />
                                        </div>

                                        <!-- Password -->
                                        <div class="mt-4">
                                            <x-label for="password" :value="__('Mot de Passe')" />

                                            <x-input id="password" class="block mt-1 w-full" type="password"
                                                name="password" required autocomplete="new-password" />
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="mt-4">
                                            <x-label for="password_confirmation" :value="__('Confirmer le Mot de Passe')" />

                                            <x-input id="password_confirmation" class="block mt-1 w-full"
                                                type="password" name="password_confirmation" required />
                                        </div>
                                        {{-- <x-label class="mb-2" for="nom_ecole" :value="__('Vous organisez :')" />
                                        <div
                                            class="flex flex-col md:flex-row justify-center items-center gap-2 md:gap-5">
                                            <div class="md:mb-4 w-full flex flex-row items-center gap-2">
                                                <x-input id="nom_pere" class=" h-4 w-4 p-2" type="checkbox"
                                                    name="maternelle" :notrequired="true" 
                                                    placeholder="" />
                                                <x-label for="nom_ecole" :value="__(': L\'Enseignement Maternelle')" />
                                            </div>
                                            <div class="md:mb-4 w-full flex flex-row items-center gap-2">
                                                <x-input id="nom_pere" class=" h-4 w-4 p-2" type="checkbox"
                                                    name="maternelle" :notrequired="true" 
                                                    placeholder="" />
                                                <x-label for="nom_ecole" :value="__(': L\'Enseignement Primaire')" />
                                            </div>
                                            <div class="md:mb-4 w-full flex flex-row items-center gap-2">
                                                <x-input id="nom_pere" class=" h-4 w-4 p-2" type="checkbox"
                                                    name="maternelle" :notrequired="true" 
                                                    placeholder="" />
                                                <x-label for="nom_ecole" :value="__(': L\'Enseignement Secondaire')" />
                                            </div>
                                            <div class="md:mb-4 w-full flex flex-row items-center gap-2">
                                                <x-input id="itm" class=" h-4 w-4 p-2" type="checkbox"
                                                    name="maternelle" :notrequired="true" 
                                                    placeholder="" />
                                                <x-label for="nom_ecole" :value="__(': L\'Enseignement Technique Medicale')" />
                                            </div>
                                        </div> --}}
                                        <div class="text-center">
                                            <button type="submit"
                                                class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-700 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-size-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                                {{-- <div class="border-black/12.5 rounded-b-2xl border-t-0 border-solid p-6 text-center pt-0 px-1 md:px-6">
                  <p class="mx-auto mb-6 leading-normal text-size-sm">Don't have an account? <a href="../pages/sign-up.html" class="font-semibold text-transparent bg-clip-text bg-gradient-to-tl from-blue-500 to-violet-500">Sign up</a></p>
                </div> --}}
                            </div>
                        </div>
                        <div
                            class="w-full flex-col justify-center h-full max-w-full px-3 pr-0 my-auto text-center flex-0 flex">
                            <div style="background-image: url('{{ asset('storage/students.png') }}')"
                                class=" py-14 relative flex flex-col justify-center items-center h-full bg-cover bg-center px-24 m-4 overflow-hidden rounded-xl ">
                                <div class="flex flex-col items-center justify-center p-10 w-full h-full">
                                    <h4 class="z-20 font-bold text-white">Bienvenue</h4>
                                    <span
                                        class=" relative font-bold w- text-white text-5xl bg-gradient-to-r from-cyan-500 to-blue-500 py-2 px-3 rounded-md z-100">{{ env('SIGLE') ? env('SIGLE') : env('APP_NAME') }}</span>
                                    {{-- <span class=" relative font-bold mt-30 w-50 text-white text-5xl bg-gradient-to-r from-cyan-500 to-blue-500 py-2 px-3 rounded-md z-100"><span class="p-1 bg-white rounded-full h-4">e</span>Chik</span> --}}
                                    <span
                                        class=" top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-black to-violet-500 opacity-40"></span>
                                    <p class="z-20 text-white ">The Solution for your School</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    {{-- </x-auth-card> --}}
</x-guest-layout>
