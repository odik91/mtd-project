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
            $table->bigInteger('suvenir_category_id')->unsigned();
            $table->string('first_text');
            $table->string('start_price');
            $table->string('thumnail');
            $table->string('image');
            $table->longText('description');
            $table->enum('is_active', ['active', 'inactive']);
            $table->timestamps();
            $table->softDeletes();
            // table relation
            // $table->foreign('suvenir_category_id')->references('id')->on('suvenir_categories')->onDelete('cascade');
            /** 
             * fix error manually
             * alter table `suvenirs` add constraint `suvenirs_suvenir_category_id_foreign` foreign key (`suvenir_category_id`) references `suvenir_categories` (`id`) on delete cascade
            */
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
