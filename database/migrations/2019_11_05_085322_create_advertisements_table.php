<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        
        Schema::create('advertisements', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('title',55)->nullable();
            $table->string('type',55)->nullable();
            $table->string('url', 500)->nullable();
            $table->string('description', 5000)->nullable();
            $table->string('image')->nullable();
            $table->enum('status', [0,1])->comment('0 for inactive and 1 for active')->default(1);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
