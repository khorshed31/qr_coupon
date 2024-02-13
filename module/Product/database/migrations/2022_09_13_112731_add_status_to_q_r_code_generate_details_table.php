<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToQRCodeGenerateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('q_r_code_generate_details', function (Blueprint $table) {
            $table->unsignedTinyInteger('status')->default(0)->after('qr_code');
            $table->string('source')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('q_r_code_generate_details', function (Blueprint $table) {
            //
        });
    }
}
