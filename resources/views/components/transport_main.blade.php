<x-app-layout>
    <x-slot name="header_content">
        <h1>Transportion</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">Transport</div>
        </div>
    </x-slot>

    <div>
        {{-- <x-dashboard-table :posts="$posts"></x-dashboard-table> --}}
        <x-transport-details :datas="$datas"></x-transport-details>
    </div>
    
</x-app-layout>

<script>
    $(function() {
        $("#transport_table").dataTable({
            "columnDefs": [
                { "sortable": false, "targets": [2,3] }
            ]
        });
    });
</script>