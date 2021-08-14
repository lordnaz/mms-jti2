<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JtiWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jti_workers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_id');
            $table->integer('asset_id');   // asset_id can be transport_id or worker_id
            $table->string('asset_type');  // can be worker type or transport type
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
        Schema::dropIfExists('jti_workers');
    }
}
