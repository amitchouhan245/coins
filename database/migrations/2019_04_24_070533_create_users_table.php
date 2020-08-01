<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up() {

        Schema::create('users', function (Blueprint $table) {
           
           
            $table->increments('id')->autoIncrement(); 

            $table->string('first_name', 30); 
            $table->string('last_name', 30);                       
            $table->string('email', 100)->nullable();
            $table->string('country_code', 4);
            $table->string('mobile_number', 55);
            $table->string('address', 255)->nullable();
            $table->string('social_id', 255)->nullable();
            $table->string('password')->nullable();
            $table->string('verification_code', 10)->nullable();              
            $table->enum('user_type', [1,2])->comment('1 for Admin, 2 for Users');
            $table->enum('is_mobile_verified', [0, 1])->comment('0 for not verified and 1 for verified, ')->default(0);
            $table->enum('is_email_verified', [0, 1])->comment('0 for not verified and 1 for verified, ')->default(0);
            $table->string('notification_id')->nullable();               
            $table->enum('status', [0,1])->comment('0 for inactive, 1 Active')->default(1);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    public function down() {

        Schema::dropIfExists('users');
    }
}
