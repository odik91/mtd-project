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
        Schema::create('travel', function (Blueprint $table) {
            $table->id();
            $table->string('travel_name');
            $table->string('first_text');
            $table->string('second_text');
            $table->string('third_text');
            $table->string('start_price');
            $table->string('country');
            $table->string('region');
            $table->string('thumbnail');
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
        Schema::dropIfExists('travel');
    }
};
