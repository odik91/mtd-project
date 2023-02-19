<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('subcategory');
            $table->unsignedBigInteger('category_id');
            $table->string('first_text');
            $table->string('second_text');
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('thumbnail');
            $table->string('image');
            $table->longText('description');
            $table->enum('is_active', ['active', 'inactive']);
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
            // table relation
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    // ALTER TABLE `subcategories` ADD `country` VARCHAR(255) NULL AFTER `second_text`, ADD `region` VARCHAR(255) NULL AFTER `country`; 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcategories');
    }
};
