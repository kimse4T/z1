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
            $table->char('ref_id',36)->nullable();
            $table->string('ref_resource')->nullable();
            $table->char('salesforce_id',36)->nullable();
            $table->timestamp('last_sync_modify')->nullable();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('is_vip')->nullable();
            $table->string('type')->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('phone_3')->nullable();
            $table->string('phone_4')->nullable();
            $table->string('street_no')->nullable();
            $table->string('house_no')->nullable();
            $table->string('address')->nullable();
            $table->integer('zip_postalcode')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('identity_card')->nullable();
            $table->text('identify_card_image')->nullable();
            $table->string('profile')->nullable();
            $table->string('salutation')->nullable();
            $table->string('occupation')->nullable();
            $table->dateTime('date_of_birth',0)->nullable();
            $table->string('working_field')->nullable();
            $table->string('relationship')->nullable();
            $table->longText('remark')->nullable();
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
