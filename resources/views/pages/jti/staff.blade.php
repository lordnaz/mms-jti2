<x-app-layout>
    <x-slot name="header_content">
        <h1>Manpower</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Manpower</div>
        </div>
    </x-slot>

    <div>
        {{-- <x-dashboard-table :posts="$posts"></x-dashboard-table> --}}
        <x-staff-table :posts="$posts"></x-staff-table>
    </div>
    
</x-app-layout>

<script>
    $(function() {
        $("#table-1").dataTable({
            "columnDefs": [
                { "sortable": false, "targets": [2,3] }
            ]
        });
    });
</script>