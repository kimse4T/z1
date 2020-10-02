<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyTitleDeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_title_deeds', function (Blueprint $table) {
            $table->id();
            $table->char('ref_id',36);
            $table->string('ref_resource');
            $table->char('salesforce_id',36);
            $table->timestamp('last_sync_modify',0);
            $table->unsignedBigInteger('property_id');
            $table->string('title_deed_type');
            $table->string('title_deed_no');
            $table->double('issued_year',0,0);
            $table->string('parcel_no');
            $table->string('image');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamp('created_at',0);
            $table->timestamp('updated_at',0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_title_deeds');
    }
}
