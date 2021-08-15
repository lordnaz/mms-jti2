<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit Manpower') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Operation</a></div>
        <div class="breadcrumb-item"><a href="{{ route('manpower.new') }}">Edit Manpower</a></div>
        </div>
    </x-slot>

    <div>
        {{-- <livewire:create-manpower/> --}}
        <x-edit-manpower :data="$data"></x-edit-manpower>
    </div>
</x-app-layout>
