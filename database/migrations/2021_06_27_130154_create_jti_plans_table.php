<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJtiPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jti_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quotation_no')->unique();
            $table->string('running_no')->unique();
            $table->string('po_no')->unique();
            $table->longText('po_path');
            $table->string('issued_by');
            $table->integer('assign_to');
            $table->string('company_name');
            $table->string('pic_name');
            $table->string('company_address');
            $table->string('contact');
            $table->string('volume');
            $table->string('mode');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
            $table->string('period');
            $table->string('from_destination');
            $table->string('to_destination');
            $table->longText('job_details');
            $table->integer('manpower');
            $table->integer('trucks');
            $table->boolean('packing_job')->default(false);
            $table->boolean('trucking_job')->default(false);
            $table->boolean('shipment_job')->default(false);
            $table->boolean('destination_job')->default(false);
            $table->longText('pack_inter');
            $table->longText('pack_dome');
            $table->longText('pack_domw');
            $table->longText('pack_storage');
            $table->longText('pack_other');
            $table->longText('ship_export');
            $table->longText('ship_import');
            $table->longText('destination');
            $table->longText('material_list');
            $table->longText('equipment_list');
            $table->longText('special_instruction');
            $table->boolean('new_flag')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jti_plans');
    }
}
