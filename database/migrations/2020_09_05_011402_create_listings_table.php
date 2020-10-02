<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->char('ref_id',36)->nullable();
            $table->string('ref_resource',191)->nullable();
            $table->char('salesforce_id',36)->nullable();
            $table->timestamp('last_sync_modify',0)->nullable();
            $table->unsignedBigInteger('property_id')->nullable();
            $table->unsignedBigInteger('property_price_history_id')->nullable();
            $table->unsignedBigInteger('submitcase_id')->nullable();
            $table->date('exclusive_date')->nullable();
            $table->date('exclusive_expires_date')->nullable();
            $table->string('agreement_type',191)->nullable();
            $table->text('agreement_file')->nullable();
            $table->string('sale_commission',191)->nullable();
            $table->string('rental_commission',191)->nullable();
            $table->string('exclusive_listing',191)->nullable();
            $table->datetime('published_at')->nullable();
            $table->unsignedBigInteger('published_by')->nullable();
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('sale_land_specialist_id')->nullable();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->double('sale_list_price',18,2)->nullable();
            $table->double('sold_price')->nullable();
            $table->timestamp('sold_price_date')->nullable();
            $table->double('rent_list_price',18,2)->nullable();
            $table->double('rented_price')->nullable();
            $table->timestamp('rented_price_date')->nullable();
            $table->tinyInteger('show_on_map')->nullable();
            $table->tinyInteger('display_on_first_page')->nullable();
            $table->string('status',191)->nullable();
            $table->tinyInteger('show_agent_on_website')->nullable();
            $table->tinyInteger('show_price_per_square_meter')->nullable();
            $table->longText('additional_items')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('renew_date')->nullable();
            $table->tinyInteger('is_rent')->nullable();
            $table->tinyInteger('is_sale')->nullable();
            $table->tinyInteger('is_close')->nullable();
            $table->string('close_reason',191)->nullable();
            $table->integer('views')->nullable();
            $table->string('code',191)->nullable();
            $table->bigInteger('total_rates')->nullable();
            $table->bigInteger('total_user_rates')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
}
