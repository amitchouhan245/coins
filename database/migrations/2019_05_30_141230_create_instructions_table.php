<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::create('instructions', function (Blueprint $table) {
           
            $table->bigIncrements('id');
            $table->integer('category_id')->unsigned();
            $table->string('title', 100);
            $table->enum('status', [0,1])->default(1)->comment('0 for inactive and 1 for active')->default(1);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('instructions');
    }
}
