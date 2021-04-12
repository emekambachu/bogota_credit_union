<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', static function (Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('user_id')->index()->unsigned()->nullable();
            $table->string('recbank');
            $table->string('recaccname');
            $table->string('recaccnum');
            $table->string('cost_of_transfer')->nullable();
            $table->string('cost_of_transfer_charge')->nullable();
            $table->string('otp')->nullable();
            $table->integer('amt');
            $table->string('currency_conversion')->nullable();
            $table->string('currency_conversion_charge')->nullable();
            $table->string('description')->nullable();
            $table->string('ref');
            $table->string('tax_revenue')->nullable();
            $table->string('tax_revenue_charge')->nullable();
            $table->string('status')->default('incomplete');
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
        Schema::dropIfExists('transfers');
    }
}
