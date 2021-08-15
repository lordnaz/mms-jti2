<x-app-layout>
    <x-slot name="header_content">
        <h1>JTI Details</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item">JTI Details</div>
        </div>
    </x-slot>

    <div>
        {{-- <x-dashboard-table :posts="$posts"></x-dashboard-table> --}}
        <x-jti-actual :jti="$jti_obj" :pack_inter="$pack_inter"></x-jti-actual>
    </div>
    
</x-app-layout>

<script>

    $(function() {

        // pack_interArr = pack_inter.split(",");

        // console.log(' array : ', pack_interArr)
    
        // initial state 
        $('#packing_panel, #shipment_panel, #destination_panel').hide();

        var packing_job = {!! json_encode($jti_obj->packing_job) !!};
        var trucking_job = {!! json_encode($jti_obj->trucking_job) !!};
        var shipment_job = {!! json_encode($jti_obj->shipment_job) !!};
        var destination_job = {!! json_encode($jti_obj->destination_job) !!};

        if(packing_job == 1){
            $('#packingSwitch').prop('checked', true);
            $('#packing_panel').show(500);
        }

        var trucking_job = (trucking_job == 1) ? $('#truckingSwitch').prop('checked', true) : $('#truckingSwitch').prop('checked', false);

        if(shipment_job == 1){
            $('#shipmentSwitch').prop('checked', true);
            $('#shipment_panel').show(500);
        }

        if(destination_job == 1){
            $('#destinationSwitch').prop('checked', true);
            $('#destination_panel').show(500);
        }
    
        $('.daterange-cus').daterangepicker({
            locale: {format: 'YYYY-MM-DD'},
            drops: 'down',
            opens: 'right'
        });
    
        $('#packingSwitch').change(function() {
            // this will contain a reference to the checkbox   
            if (this.checked) {
                $('#packing_panel').show(500);
            } else {
                $('#packing_panel').hide(500);
            }
        });
    
        $('#shipmentSwitch').change(function() {
            // this will contain a reference to the checkbox   
            if (this.checked) {
                $('#shipment_panel').show(500);
            } else {
                $('#shipment_panel').hide(500);
            }
        });
    
        $('#destinationSwitch').change(function() {
            // this will contain a reference to the checkbox   
            if (this.checked) {
                $('#destination_panel').show(500);
            } else {
                $('#destination_panel').hide(500);
            }
        });



        var material_list = {!! json_encode($jti_obj->material_list) !!};

        var materialArr = material_list.split(',');

        materialArr.forEach(material => {

            var quantityStr = material.substr(0, material.indexOf('x')); 
            var quantityNumber = parseInt(quantityStr);

            if(material.includes("Boxes - S [19 x 14 x 14']")){
                $('#m1').val(quantityNumber);
            }

            if(material.includes("Boxes - M [17 x 17 x 17']")){
                $('#m2').val(quantityNumber);
            }

            if(material.includes("Boxes - M [18 x 18 x 18']")){
                $('#m3').val(quantityNumber);
            }

            if(material.includes("Boxes - L [ 19 x 19 x 30']")){
                $('#m4').val(quantityNumber);
            }

            if(material.includes("Boxes - [21 x 20 x 20']")){
                $('#m5').val(quantityNumber);
            }

            if(material.includes("Empty Boxes (USED)")){
                $('#m6').val(quantityNumber);
            }

            if(material.includes("Corrugated Paper Roll")){
                $('#m7').val(quantityNumber);
            }

            if(material.includes("Wardrobe / Hanging Ctn")){
                $('#m8').val(quantityNumber);
            }

            if(material.includes("Air-Bubblepack")){
                $('#m9').val(quantityNumber);
            }

            if(material.includes("PE Foam")){
                $('#m10').val(quantityNumber);
            }

            if(material.includes("White Tape (Eco)")){
                $('#m11').val(quantityNumber);
            }

            if(material.includes("OPP Tape -'KLCCUH'")){
                $('#m12').val(quantityNumber);
            }

            if(material.includes("OPP Tape (Brown)")){
                $('#m13').val(quantityNumber);
            }

            if(material.includes("Masking Tape")){
                $('#m14').val(quantityNumber);
            }

            if(material.includes("Fragile Tape")){
                $('#m15').val(quantityNumber);
            }

            if(material.includes("Stretch Film")){
                $('#m16').val(quantityNumber);
            }

            if(material.includes("Newsprint Paper")){
                $('#m17').val(quantityNumber);
            }

            if(material.includes("Steel Strapping Rope")){
                $('#m18').val(quantityNumber);
            }

            if(material.includes("Sticker Color")){
                $('#m19').val(quantityNumber);
            }

        });



        var equipmentlist = {!! json_encode($jti_obj->equipment_list) !!};

        equipmentlist.includes("Two Wheel Trolley") ? $("#e1").prop('checked', true) : $("#e1").prop('checked', false);
        equipmentlist.includes("Four Wheel Trolley") ? $("#e2").prop('checked', true) : $("#e2").prop('checked', false);
        equipmentlist.includes("Tools Set / Hand Drill Set") ? $("#e3").prop('checked', true) : $("#e3").prop('checked', false);
        equipmentlist.includes("Weight Scale") ? $("#e4").prop('checked', true) : $("#e4").prop('checked', false);
        equipmentlist.includes("Tape Measure") ? $("#e5").prop('checked', true) : $("#e5").prop('checked', false);
        equipmentlist.includes("Pallet Jack") ? $("#e6").prop('checked', true) : $("#e6").prop('checked', false);
        equipmentlist.includes("Wooden / Plastic pallet") ? $("#e7").prop('checked', true) : $("#e7").prop('checked', false);
        equipmentlist.includes("Ramp [ Wooden / Steel ]") ? $("#e8").prop('checked', true) : $("#e8").prop('checked', false);
        equipmentlist.includes("Plywood Sheets") ? $("#e9").prop('checked', true) : $("#e9").prop('checked', false);
        equipmentlist.includes("Canvas") ? $("#e10").prop('checked', true) : $("#e10").prop('checked', false);
        equipmentlist.includes("Cutter Seal") ? $("#e11").prop('checked', true) : $("#e11").prop('checked', false);
        equipmentlist.includes("Wood (kocai / 2-3)") ? $("#e12").prop('checked', true) : $("#e12").prop('checked', false);
        equipmentlist.includes("Crane - 5 / 10 / 20 / 40 tonage") ? $("#e13").prop('checked', true) : $("#e13").prop('checked', false);
        equipmentlist.includes("Forklift") ? $("#e14").prop('checked', true) : $("#e14").prop('checked', false);
    
    });
    
    </script>