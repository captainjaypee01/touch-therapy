<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string("name")->nullable(); 
            $table->string("type")->nullable(); 
            $table->double("price")->nullable(); 
            $table->double("member_price")->nullable(); 
            $table->double("female_price")->nullable(); 
            $table->double("male_price")->nullable(); 
            $table->text("description")->nullable();
            $table->string("filename")->nullable();
            $table->string("image_location")->nullable();
            $table->string("type")->nullable();
            $table->integer("size")->nullable();
            $table->string("hash")->nullable();
            $table->string("ip_address")->nullable();
            $table->tinyInteger("status")->nullable()->default(1); 
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
        Schema::dropIfExists('services');
    }
}
