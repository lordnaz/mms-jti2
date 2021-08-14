<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JtiJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jti_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('running_no');
            $table->timestamp('job_start');
            $table->timestamp('job_end');
            $table->string('job_type'); // packing, trucking, 
            $table->string('job_subtype'); // e.g storage_household, domw_office, inter_industry
            $table->longText('job_details')->nullable();  // text or commend
            $table->string('task_status')->default('Assigned');  // Assigned | Working-On | Finished 
            $table->integer('requested_by');  // marketing user id
            $table->integer('open_by');  // project uuid
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
        Schema::dropIfExists('jti_jobs');
    }
}
