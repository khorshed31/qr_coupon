<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('transections');
        Schema::create('transections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('qr_code_id')->nullable();
            $table->string('type');
            $table->decimal('amount',16,2)->default(0);
//            $table->unsignedBigInteger('withdraw_id')->nullable();

            $table->timestamps();

//            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('qr_code_id')->references('id')->on('q_r_code_generate_details');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transections');
    }
}
