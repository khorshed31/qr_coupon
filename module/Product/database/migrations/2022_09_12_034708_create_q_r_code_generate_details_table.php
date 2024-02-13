<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQRCodeGenerateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_r_code_generate_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('qr_code_generate_id');

            $table->decimal('prize_amount',16,2);
            $table->string('qr_code')->unique();
            $table->timestamps();

            $table->foreign('qr_code_generate_id')->references('id')->on('q_r_code_generates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q_r_code_generate_details');
    }
}
