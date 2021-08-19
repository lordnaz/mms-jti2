<x-app-layout>
    <x-slot name="header_content">
        <h1>{{ __('job Tracker') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">JTI</a></div>
        <div class="breadcrumb-item"><a href="{{ route('manpower.new') }}">Tracker</a></div>
        </div>
    </x-slot>

    <div>
        {{-- <livewire:create-manpower/> --}}
        {{-- <x-edit-manpower :data="$data"></x-edit-manpower> --}}
        <x-tracker></x-tracker>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

    });
</script>
