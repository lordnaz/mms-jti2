<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Add New Manpower') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Operation</a></div>
        <div class="breadcrumb-item"><a href="{{ route('manpower.new') }}">Add New Manpower</a></div>
        </div>
    </x-slot>

    <div>
        {{-- <livewire:create-manpower/> --}}
        <x-create-manpower></x-create-manpower>
    </div>
</x-app-layout>
