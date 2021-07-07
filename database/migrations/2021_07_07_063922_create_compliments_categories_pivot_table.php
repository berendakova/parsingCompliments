<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplimentsCategoriesPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compliments_categories_pivot', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('compliment_id');
            $table->unsignedInteger('category_id');
            $table->timestamps();
        });

        Schema::table('compliments_categories_pivot', function (Blueprint $table) {
            $table->foreign('compliment_id')->references('id')
                ->on('compliments')->onDelete('cascade');
            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compliments_categories_pivot');
    }
}
