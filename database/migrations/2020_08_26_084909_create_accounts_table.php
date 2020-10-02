<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->char('ref_id',36);
            $table->string('ref_resource');
            $table->char('salesforce_id',36);
            $table->timestamp('last_sync_modify');
            $table->string('account_number');
            $table->string('bank_branch');
            $table->string('billing_address');
            $table->date('valid_until');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('industry');
            $table->string('rating');
            $table->string('website');
            $table->text('description');
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
