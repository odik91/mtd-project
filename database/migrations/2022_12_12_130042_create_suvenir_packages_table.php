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
        Schema::create('suvenir_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('suvenir_id');
            $table->string('package_name');
            $table->string('price');
            $table->longText('description');
            $table->enum('is_active', ['active', 'inactive']);
            $table->timestamps();
            $table->softDeletes();
            // table relation
            $table->foreign('suvenir_id')->references('id')->on('suvenirs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suvenir_packages');
    }
};
