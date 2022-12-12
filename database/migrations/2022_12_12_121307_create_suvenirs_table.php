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
        Schema::create('suvenirs', function (Blueprint $table) {
            $table->id();
            $table->string('suvenir_name');
            $table->string('first_text');
            $table->string('start_price');
            $table->string('thumnail');
            $table->string('image');
            $table->longText('description');
            $table->enum('is_active', ['active', 'inactive']);
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
        Schema::dropIfExists('suvenirs');
    }
};
