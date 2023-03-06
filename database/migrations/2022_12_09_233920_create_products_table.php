<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->integer('price');
            $table->integer('salePrice')->nullable();
            $table->string('type');
            $table->string('description_ar')->nullable();
            $table->string('description_en')->nullable();
            $table->string('mainGallery');
            $table->string('gallery1')->nullable();
            $table->string('gallery2')->nullable();
            $table->string('gallery3')->nullable();
            $table->integer('admin_id');

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
        Schema::dropIfExists('products');
    }
}
