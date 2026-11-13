<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
    <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-[40%_60%] lg:px-0">

        {{-- LEFT SIDE: Authentication Form --}}
        <div class="w-full lg:p-8">
            <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">

                <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden" wire:navigate>
                    <span class="flex h-9 w-9 items-center justify-center rounded-md">
                        <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                    </span>

                    <span class="sr-only">{{ config('app.name', 'EzraCare') }}</span>
                </a>
                <div class="flex justify-center">
                    <img
                        src="{{ asset('assets/ezracare_logo.png') }}"
                        alt="EzraCare Logo"
                        class="h-12 w-auto object-contain" />
                </div>
                {{ $slot }}
            </div>
        </div>

        {{-- RIGHT SIDE: Branding and Quote --}}
        <div class="bg-muted relative hidden h-full flex-col p-10 text-white lg:flex dark:border-s dark:border-neutral-800">

            {{-- Background Image --}}
            <div
                class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                style="background-image: url('{{ asset('assets/auth_background.jpg') }}');">
            </div>

            {{-- Dark Overlay --}}
            <div class="absolute inset-0 bg-neutral-900/30"></div>

            <a href="{{ route('home') }}" class="relative z-20 flex items-center text-lg font-medium" wire:navigate>


                {{ config('app.name', 'EzraCare') }}
            </a>

            @php
            [$message, $author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
            @endphp

            <div class="relative z-20 mt-auto">
                <blockquote class="space-y-2 text-right">
                    <flux:heading size="lg" class="text-white!">
                        Mortuary Fund Assistance Management System
                    </flux:heading>
                    <footer>
                        <flux:heading class="text-white! text-right">Davao Mission of the Seventh-day Adventists</flux:heading>
                    </footer>
                </blockquote>
            </div>
        </div>

    </div>

    @persist('toast')
    <flux:toast.group>
        <flux:toast />
    </flux:toast.group>
    @endpersist

    @fluxScripts
</body>

</html>