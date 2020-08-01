<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiryDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::create('enquiry_documents', function (Blueprint $table) {
            
            $table->increments('id')->autoIncrement(); 
            $table->integer('enquiry_id')->unsigned();
            $table->integer('category_document_id')->unsigned();
            $table->foreign('enquiry_id')->references('id')->on('enquiries')->onDelete('cascade');
            $table->foreign('category_document_id')->references('id')->on('category_documents')->onDelete('cascade');
            $table->string('document_image')->nullable();
            $table->enum('status', [0,1])->default(1)->comment('0 for inactive and 1 for active')->default(1);
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

        Schema::dropIfExists('enquiry_documents');
    }
}
