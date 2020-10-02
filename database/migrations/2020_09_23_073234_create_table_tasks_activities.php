<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTasksActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_tasks_activities', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->nullable();
            $table->bigInteger('parent_id')->unsigned()->nullable()->index();
            $table->bigInteger('property_id')->unsigned()->nullable()->index();
            $table->bigInteger('account_id')->unsigned()->nullable()->index();
            $table->bigInteger('campaign_id')->unsigned()->nullable()->index();
            $table->bigInteger('lead_id')->unsigned()->nullable()->index();
            $table->bigInteger('opportunity_id')->unsigned()->nullable()->index();
            $table->bigInteger('case_id')->unsigned()->nullable()->index();
            $table->bigInteger('contract_id')->unsigned()->nullable()->index();
            $table->bigInteger('listing_id')->unsigned()->nullable()->index();
            $table->bigInteger('contact_id')->unsigned()->nullable()->index();
            $table->bigInteger('owner_id')->unsigned()->nullable()->index();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->string('task_subtype')->nullable();
            $table->text('files')->nullable();
            $table->integer('call_duration_in_seconds')->nullable();
            $table->string('call_object')->nullable();
            $table->string('call_disposition')->nullable();
            $table->string('call_type')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('is_recurrence')->default(0)->nullable();
            $table->boolean('is_reminder_set')->default(0)->nullable();
            $table->integer('recurrence_interval')->nullable();
            $table->string('recurrence_regenerated_type')->nullable();
            $table->timestamp('date')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_tasks_activities');
    }
}
