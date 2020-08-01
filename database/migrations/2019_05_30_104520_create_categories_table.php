<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::create('categories', function (Blueprint $table) {

            $table->increments('id');
            $table->string('title', 55);
            $table->string('description', 5000);
            $table->string('charge', 100);
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
    public function down() {
        
        Schema::dropIfExists('categories');
    }
}
