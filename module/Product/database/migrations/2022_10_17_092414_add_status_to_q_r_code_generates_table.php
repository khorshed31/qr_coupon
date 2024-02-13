<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToQRCodeGeneratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('q_r_code_generates', function (Blueprint $table) {
            $table->unsignedTinyInteger('status')->default(0)->after('total_quantity');
            $table->unsignedBigInteger('approved_by')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('q_r_code_generates', function (Blueprint $table) {
            //
        });
    }
}
