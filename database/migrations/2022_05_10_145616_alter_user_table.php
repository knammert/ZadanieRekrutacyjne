<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('address_id');
            $table->string('login');
            $table->string('surname');
            $table->string('phone');
            $table->boolean('newsletter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->dropColumn('login');
            //$table->dropColumn('surname');
            // $table->dropColumn('country');
            // $table->dropColumn('address');
            // $table->dropColumn('zipcode');
            // $table->dropColumn('city');
            // $table->dropColumn('phone');
            // $table->dropColumn('newsletter');
        });
    }
};
