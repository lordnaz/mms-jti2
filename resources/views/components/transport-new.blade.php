<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('New Transport') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Operation</a></div>
        <div class="breadcrumb-item"><a href="{{ route('manpower.new') }}">New Transport</a></div>
        </div>
    </x-slot>

    <div>
        {{-- <livewire:create-manpower/> --}}
        <x-create-transport></x-create-transport>
    </div>
</x-app-layout>
