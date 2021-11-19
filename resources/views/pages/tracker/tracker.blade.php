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

        <x-tracker-details :data="$data" :job="$job" :list="$list_user"></x-tracker-details>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

        $('#assignee_panel').hide();


        $('#assigneeSwitch').change(function() {
            // this will contain a reference to the checkbox   
            if (this.checked) {
                $('#assignee_panel').show(500);
            } else {
                $('#assignee_panel').hide(500);
            }
        });

    });
</script>
