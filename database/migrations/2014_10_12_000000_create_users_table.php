<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('image_id')->index()->unsigned()->nullable();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->integer('is_active')->default(0);
            $table->string('fname');
            $table->string('lname');
            $table->string('email', 250)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile');
            $table->string('dob');
            $table->string('gender');
            $table->text('address');
            $table->string('country');
            $table->string('state');
            $table->string('accnum')->unique();
            $table->string('acctype');
            $table->integer('accbal')->default(0);
            $table->string('pin');
            $table->boolean('payment_status');

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
