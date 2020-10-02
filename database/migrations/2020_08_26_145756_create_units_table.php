<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id');
            $table->char('ref_id',36);
            $table->string('ref_resource');
            $table->char('salesforce_id',36);
            $table->timestamp('last_sync_modify',0);
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('property_feature_id');
            $table->unsignedBigInteger('owner_id');
            $table->string('name');
            $table->double('width',18,2);
            $table->double('length',18,2);
            $table->double('area',18,2);
            $table->integer('completion_year')->default(11);
            $table->integer('useful_life')->default(11);
            $table->integer('effective_age')->default(11);
            $table->integer('cost_estimate')->default(11);
            $table->integer('stories')->default(11);
            $table->integer('bedroom')->default(11);
            $table->integer('bathroom')->default(11);
            $table->integer('livingroom')->default(11);
            $table->integer('dinningroom')->default(11);
            $table->integer('door')->default(11);
            $table->integer('floor')->default(11);
            $table->integer('parking')->default(11);
            $table->integer('car_parking')->default(11);
            $table->integer('motor_parking')->default(11);
            $table->unsignedBigInteger('contact_id');
            $table->string('design_appeal_type');
            $table->string('quality_type');
            $table->string('roofing_type');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->timestamp('deleted_at');
            $table->string('code');
            $table->string('building_type');
            $table->tinyInteger('status');
            $table->text('gallery');
            $table->string('style');
            $table->double('gross_floor_area',18,2);
            $table->double('net_floor_area',18,2);
            $table->string('main_walls');
            $table->string('ceiling');
            $table->string('flooring_materials');
            $table->string('window_frames');
            $table->tinyInteger('balcony');
            $table->tinyInteger('kitchen');
            $table->tinyInteger('swimming_pool');
            $table->tinyInteger('security');
            $table->tinyInteger('fitness_gym');
            $table->tinyInteger('lift');
            $table->string('neighborhood');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
