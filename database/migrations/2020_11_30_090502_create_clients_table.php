<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->text('vat_number');
            $table->text('city');
            $table->text('address');
            $table->text('phone');
            $table->text('email');
            $table->text('web');
            $table->boolean('is_active')->default(true);
            $table->text('account_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function ($table)
        {
//        $table->dropColumn(array('id_number', 'checking_account'));
        });
    }
}
