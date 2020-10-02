<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->char('ref_id',36);
            $table->string('ref_resource');
            $table->char('salesforce_id',36);
            $table->timestamp('last_sync_modify');
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('is_vip');
            $table->string('type');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email');
            $table->string('phone');
            $table->string('phone_2');
            $table->string('phone_3');
            $table->string('phone_4');
            $table->string('street_no');
            $table->string('house_no');
            $table->string('address');
            $table->integer('zip_postalcode');
            $table->string('latitude');
            $table->string('longitude');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->timestamp('deleted_at');
            $table->string('identity_card');
            $table->text('identify_card_image');
            $table->string('profile');
            $table->string('salutation');
            $table->string('occupation');
            $table->dateTime('date_of_birth',0);
            $table->string('working_field');
            $table->string('relationship');
            $table->longText('remark');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
