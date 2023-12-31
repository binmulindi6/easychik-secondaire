<x-guest-layout>
    {{-- <x-auth-card> --}}
        {{--<x-slot name="logo">
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
          <div class="flex flex-wrap -mx-3">
            <div class="flex flex-col w-full max-w-full px-3 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
                <div class="relative  flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 dark:bg-gray-950 rounded-2xl bg-clip-border">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <div class="w-full lg:hidden flex justify-center">
                        <span class="font-bold text-center text-transparent text-5xl sm:text-6xl bg-clip-text bg-gradient-to-r from-cyan-500 to-blue-500 p-2 rounded-md">{{env("SIGLE") ? env("SIGLE") : env('APP_NAME')}}</span>
                    </div>
                <div class=" p-2 md:pl-6 pt-2 pb-0 mb-0 lg-max:text-center">
                  <h4 class="font-bold">Authentification</h4>
                  <p class="mb-0">Entrer votre Email et votre Mot de Passe </p>
                </div>
                <div class="flex-auto p-2 md:p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <input name="email" type="email" placeholder="Email" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" />
                        </div>
                        <div class="mb-4">
                            <input name="password" type="password" placeholder="Mot de Passe" class="focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-size-sm leading-5.6 ease block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" />
                        </div>
                        <div class="flex items-center pl-12 mb-0.5 text-left min-h-6">
                            <input name="remember" id="rememberMe" class="mt-0.5 rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5-em relative float-left -ml-12 w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-zinc-700/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-blue-500/95 checked:bg-blue-500/95 checked:bg-none checked:bg-right" type="checkbox" />
                            <label class="ml-2 font-normal cursor-pointer select-none text-size-sm text-slate-700" for="rememberMe">Se Souvenir de moi</label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="inline-block w-full px-16 py-3.5 mt-6 mb-0 font-bold leading-normal text-center text-white align-middle transition-all bg-blue-700 border-0 rounded-lg cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs text-size-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25">Connexion</button>
                        </div>
                  </form>
                </div>
                {{-- <div class="border-black/12.5 rounded-b-2xl border-t-0 border-solid p-6 text-center pt-0 px-1 sm:px-6">
                  <p class="mx-auto mb-6 leading-normal text-size-sm">Don't have an account? <a href="../pages/sign-up.html" class="font-semibold text-transparent bg-clip-text bg-gradient-to-tl from-blue-500 to-violet-500">Sign up</a></p>
                </div> --}}
              </div>
            </div>
            <div class="absolute top-0 right-0 flex-col justify-center hidden w-6/12 h-full max-w-full px-3 pr-0 my-auto text-center flex-0 lg:flex">
              <div style="background-image: url('{{asset('storage/students.png')}}')" class="relative flex flex-col justify-center items-center h-full bg-cover px-24 m-4 overflow-hidden rounded-xl ">
                <span class=" relative font-bold mt-30 w- text-white text-5xl bg-gradient-to-r from-cyan-500 to-blue-500 py-2 px-3 rounded-md z-100">{{env("SIGLE") ? env("SIGLE") : env('APP_NAME')}}</span>
                {{-- <span class=" relative font-bold mt-30 w-50 text-white text-5xl bg-gradient-to-r from-cyan-500 to-blue-500 py-2 px-3 rounded-md z-100"><span class="p-1 bg-white rounded-full h-4">e</span>Chik</span> --}}
                <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-black to-violet-500 opacity-40"></span>
                <h4 class="z-20 font-bold text-white">"School Management System"</h4>
                <p class="z-20 text-white ">The Solution for your School</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
{{-- </x-auth-card> --}}
</x-guest-layout>